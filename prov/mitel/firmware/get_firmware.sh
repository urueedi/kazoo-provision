#!/bin/sh

# Copyright (C) 2009 FreePBX-Swiss Urs Rueedi

for name in `ls ./`
do
if echo $name|grep -q "_FC\|Lang" ; then
    rm $name &>/dev/null
fi
done

# set max. downloadspeed
RATE=25000k

if [ "$1" = "quiet" ] ; then
    CMD="wget --limit-rate=$RATE -N -q -c -T 3"
else
    CMD_C="wget --limit-rate=$RATE -N -c -T 3"
    CMD="wget --limit-rate=$RATE -N -T 3"
fi
	    
# Download & Unpack Firmware
echo "Download and unpack Firmware Aastra (PLEASE WAIT)...<br>"
src="http://miteldocs.com/cps/rde/aareddownload?file_id=6274-17656-_P06_XML&dsproject=aastra&mtype=zip"
to="."

$CMD_C $src -O $to &>/dev/null

for name in `ls ./`
do
    if echo $name|grep -q ".zip" ; then
        unzip -o -d ../ $name &>/dev/null
    fi
done

echo "Firmware Aastra komplett<br>"
