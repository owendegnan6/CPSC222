#!/usr/bin/perl

use strict;
use warnings;

my $logfile = "";

if (-f "/var/log/auth.log") {
$logfile = "/var/log/auth.log";
} elsif (-f "/var/log/secure") {
$logfile = "/var/log/secure";
} else {
print "0";
exit;
}

my $count = 0;

open (my $fh, '<' , $logfile) or die "Cannot open log file";

while (my $line = <$fh>) {
if ($line =~ /sudo/ && $line =~ /COMMAND=/) {
$count++;
}
}

close($fh);

print $count; 
