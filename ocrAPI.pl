#!/usr/bin/perl

use strict;
use warnings;
use CGI;
use HTTP::Request;
use LWP::UserAgent;

BEGIN {
	my $cgi = new CGI;
	print $cgi->header(-type => 'text');
	open(STDERR, ">&STDOUT");
	
}

sub requestData {
	my ($url, $) = @_;

	$param = "query=blablabla";
	$req = HTTP::Request->new(POST => $url);
	$req->content($param);

	$ua = LWP::UserAgent->new;
	$res = $ua->request($req);
	Also you can add headers to your request like this:

	$req->header('Accept-Encoding' => "gzip,deflate");
	$req->header('Accept-Charset' => "ISO-8859-1,utf-8;q=0.7,*;q=0.7");
}