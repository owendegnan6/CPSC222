#!/usr/bin/perl
use strict;
use warnings;

my $count = 0;

open(my $fh, '<', '/var/log/auth.log') or exit 1;

while (my $line = <$fh>) {
    if ($line =~ /sudo:.*session opened/) {
        $count++;
    }
}

close($fh);

print $count;
