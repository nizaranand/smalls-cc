#!/bin/sh

git reset	--hard
rsync		-rzu	*	jsmalls@sdf.org:~/html/smalls.cc/
