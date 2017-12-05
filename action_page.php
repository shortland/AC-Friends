<?php

if(isset($_GET['method']) && $_GET['method'] == "timestamp") {
	echo "{\"time\": " . time() . "}";
	exit;
}

$privateFileName = "/usersPrivate.json";

if(isset($_GET['id'])) $id = $_GET['id'];

if(strlen($id) != 11 || !is_numeric($id)) {
	echo "Your ID should be 11 numbers long.";
	exit;
}

$marketType = "unverified";

if (!file_exists($marketType . $privateFileName)) {
	$fh = fopen($marketType . $privateFileName, 'w');
	chmod($marketType . $privateFileName, 0777);
	fwrite($fh, "{\"users\": []}");
	fclose($fh);
}

$workWith = file_get_contents($marketType . $privateFileName);

$tempHash = json_decode($workWith, true);

$tempHashClean = $tempHash;

$newJsonObj->id = $id;
$newJsonObj->randIDN = generateRandomString();
$newJsonObj->timestamp = time();
$newJsonObj->ip = $_SERVER['REMOTE_ADDR'];
$newJsonObj->uas = $_SERVER['HTTP_USER_AGENT'];

$newJsonObjClean->id = $id;
$newJsonObjClean->randIDN = generateRandomString();
$newJsonObjClean->timestamp = time();

array_push($tempHashClean['users'], $newJsonObjClean);
$tempHashClean = json_encode($tempHashClean);

array_push($tempHash['users'], $newJsonObj);
$tempHash = json_encode($tempHash);

$fh = fopen($marketType . $privateFileName, 'w');
chmod($marketType . $privateFileName, 0777);
fwrite($fh, $tempHash);
fclose($fh);

$fh = fopen($marketType . "/public.json", 'w');
chmod($marketType . "/public.json", 0777);
fwrite($fh, $tempHashClean);
fclose($fh);

function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

echo "submitted!";

?>