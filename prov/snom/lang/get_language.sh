#!/bin/sh

# set max downloadspeed 
RATE=2500k
RELEASE="8.7.5"

if [ "$1" = "quiet" ] ; then
    CMD="wget --limit-rate=$RATE -N -q -T 3"
    CMD_C="wget --limit-rate=$RATE -N -T 3"
else
    CMD_C="wget --limit-rate=$RATE -N -c -T 3"
    CMD="wget --limit-rate=$RATE -N -T 3"
fi
	    
# Download & Unpack Languages

echo "Download &amp; Unpack Languages Snom...<br>"

packages="DE EN FR IT"
from="http://fox.snom.com/config/snomlang-$RELEASE"
to="./"
	    
for pack in $packages
do
    $CMD $from/gui_lang_$pack.xml -P $to/
    $CMD $from/web_lang_$pack.xml -P $to/
done

rm $to/.htaccess 2>/dev/null

#for name in `ls ./`
#do
#if echo $name|grep -q ".zip" ; then
#    unzip -o -d ../ $name &>/dev/null
#fi
#done

echo "Languages Snom komplett<br>"
