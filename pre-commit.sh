#!/bin/sh

sass	--update	.
cp	-ru		../wordpress/*	.
wait
git add	-A	
	
#my $remote_filename = '/var/log/nginx/smalls.cc-error_log';
#my $remote_host = 'ec2-user@smalls.cc';
#my $cmd = "ssh $remote_host tail -f $remote_filename |";
#open my $remote_tail, $cmd
#    or die "COuldn't spawn [$cmd]: $!/$?";
# 
#while (<$remote_tail>) {
#    print "Remote: $_";
#};
