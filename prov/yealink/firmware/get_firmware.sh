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
echo "Download and unpack Firmware Aastra 67xx (PLEASE WAIT)...<br>"
prefix="http://www.aastra.de/cps/rde/aareddownload?file_id={{ID}}&dsproject=www-aastra-de&mtype=zip"
packages="6167-15148-_P02_XML 6354-15156-_P02_XML 6848-15158-_P02_XML 6950-15160-_P02_XML 7041-15162-_P02_XML 6354-14804-_P02_XML"
to="."

for pack in $packages
do
	src=`echo $prefix|sed -e s/\{\{ID\}\}/$pack/g`
	$CMD_C $src -O $to/$pack.zip &>/dev/null
done

for name in `ls ./`
do
if echo $name|grep -q ".zip" ; then
    unzip -o -d ../ $name &>/dev/null
fi
done

echo "Download and unpack Firmware Aastra 67xx (PLEASE WAIT)...<br>"

prefix="http://www.aastra.ch/cps/rde/aareddownload?file_id=15256-17752-_P04_XML&dsproject=www-aastra-ch-de&mtype=zip"
packages="FC-001363-01-REV07_6737i_3_3_1_8106_SP4 FC-001415-00-REV02_6863i_3_3_1_8106_SP4 PC-001416-00-REV02_6865i_3_3_1_8106_SP4 FC-001417-00-REV02_6867i_3_3_1_8106_SP4"
to="."

for pack in $packages
do
	src=`echo $prefix|sed -e s/\{\{ID\}\}/$pack/g`
	$CMD_C $src -O $to/$pack.zip &>/dev/null
done

for name in `ls ./`
do
if echo $name|grep -q ".zip" ; then
    unzip -o -d ../ $name &>/dev/null
fi
done

echo "Firmware Aastra 68xx komplett<br>"
