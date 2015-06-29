#!/bin/sh

# Copyright (C) 2009 FreePBX-Swiss Urs Rueedi

# set max downloadspeed
RATE=9950k

if [ "$1" = "quiet" ] ; then
    CMD="wget --limit-rate=$RATE -N -q -c -T 5"
    CMD_C="wget --limit-rate=$RATE -N -q -T 5"
else
    CMD="wget --limit-rate=$RATE -N -T 5"
    CMD_C="wget --limit-rate=$RATE -N -c -q -T 5"
fi
	    
# Remove old Firmware, download & unpack new Firmware
echo "remove old Firmware, download &amp; Unpack new Firmware from Snom (PLEASE WAIT)...<br>"

# if new download firmware of all snoms and remove old file
loadprefix="provisioning.snom.com"
add="download/fw"
files="m9-9.5.14-a.bin snom300-8.4.32-SIP-f.bin snom320-8.4.32-SIP-f.bin snom360-8.4.32-SIP-f.bin snom370-8.4.32-SIP-f.bin snom820-8.2.29-SIP-r.bin snom820-8.4.32-SIP-r.bin snom821-8.4.32-SIP-r.bin snom870-8.4.32-SIP-r.bin snomMP-8.4.32-SIP-r.bin snom720-8.7.2.9-SIP-r.bin snom760-8.7.2.9-SIP-r.bin"
to="."

echo -n "download new Firmware Snom... "
for pack in $files
do
    if [ ! -e $to/$pack ] ; then
	IFS="-"
	set -- $pack
	name=$1
	IFS=" "
	rm -f $to/$name* &>/dev/null

	$CMD_C http://$loadprefix/$add/$pack -P $to/
        echo -n "$name.. " 
    fi
done
echo " successfull<br>"

# download update 6to7
echo -n "download Snom Firmware update 6to7 ... "
prefix="http://fox.snom.com"
packages="update6to7/snom300-6.5.20-SIP-j.bin download/fw/snom320-6.5.20-SIP-j.bin update6to7/snom300-3.38-l.bin update6to7/snom320-3.38-l.bin update6to7/snom360-3.38-l.bin update6to7/snom300-from6to7-7.3.14-bf.bin update6to7/snom320-from6to7-7.3.14-bf.bin update6to7/snom360-from6to7-7.3.14-bf.bin"
to="."
for pack in $packages
do
    $CMD $prefix/$pack -P $to/
    echo -n "." 
done
echo "successfull<br>"


# update tftpboot links if tftpboot exist
to="/tftpboot"
if [ -d /${to} ] ; then
    echo -n "Update TFTP Firmware links ceate links... "

    for file in $files
    do
    if [ -e ./$file ] ; then
	IFS="-"
	set -- $file
	tftpname=$1
	IFS=" "
	rm -f $to/$tftpname* &>/dev/null
	# stupid name changes for this snom firmware images!!
	if echo $tftpname|grep -q -i "snom370" ; then
	    endfix="-j.bin"
	elif echo $tftpname|grep -q -i "snom8" ; then
	    endfix="-r.bin"
	else
	    endfix=".bin"
	fi
        ln /var/www/pbx/htdocs/prov/snom/firmware/$file $to/$tftpname$endfix
        echo -n "$tftpname " 
    fi
    done
echo " successfull<br>"
fi
