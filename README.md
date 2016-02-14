# kazoo-provision
Provision integration for monster-ui and old kazoo-ui

![screenshot1](https://raw.githubusercontent.com/urueedi/kazoo-provision/master/DEVELOP/screenshot1.png)
![screenshot2](https://raw.githubusercontent.com/urueedi/kazoo-provision/master/DEVELOP/screenshot2.png)
![screenshot3](https://raw.githubusercontent.com/urueedi/kazoo-provision/master/DEVELOP/screenshot3.png)
![screenshot4](https://raw.githubusercontent.com/urueedi/kazoo-provision/master/DEVELOP/screenshot4.png)

Additional Support
------------------
Open Phone Net AG infos@openent.ch Switzerland

Provisioner implement structure
-------------------------------
1. Network settings will be local from router and never be part of this provision-solution.
2. There no cache-solution, if this provisioner will fail
3. Feel free to add more of ip-phones, or ask for support us

Supported phones (Feb 2016)
---------------------------
snom, mitel, aastra, zoiper, yealink

Install info
------------
1. INSTALL kazoo-platform (from this repository because of changes: use 3.22)
   If not install kazoo-urueedi, change files application/crossbar/priv/devices.json and users.json
   from this DEVELEOP directory and recompile and restart crossbar and (sup whapps_maintenance migrate) to renew couchdb!
2. Install monster-ui (from this repository because of adds in ui) and fping, php-cli, php, php-xml
4. Install THIS in a WEBFOLDER where the monster-ui is, or on sep. domain
5. INSTALL and UPDATE with on console in dir ./setup.php the database and add brand_provisioner to couchdb
6. Setting in this folder config.php your couchdb nodes in $hosts="localhost" and $dbport = "5984"
7. Then restart kazoo with: service kz-whistle_app restart or flush coucdb cache of kazoo
8. Set in monster-ui /js/config.js the provisioner: "http://yourdomain.com/your_path_installed/"
   - check this by using the add sip-phone-button in (monster-ui)->voip->devices or (kazoo-ui)
9. Go to your account settings and enable (Automatic Devicesettings) in monster-ui
    - URL-Password => [your_pass] is used in GET-string of phones snom and yealink now only
    - Domainrestriction => [customer_home_domain] e.g. customer.domain.com (dyndns) only this domain will be able to get provisiondata if putin
    - Phone Admin Password => [your_pass] password to access your proved phones
    - Zoiper Token => [zoiperproviderid] This is used for autoprovision with soft- and smartphone with account from (oem.zoiper.com)
    - Automatic Devicesetting => enable to allow this autoprovision features on this account for all his phones
    - User devicesetting => enable to allow devicesettings in the userportal
10. If you need plug&play support for ip-phones you need openwrt from this github site. To add for VoIP-Phones use e.g.
   - snom:  00:04:13:*:*:* http://[prov_domain]/prov/snom/settings.php?mac={mac}&pass=[PROVPASS_ACCOUT_UI]
   - mitel: 00:08:5d:*:*:* http://[prov_domain]/prov/mitel
   - yealink: 00:15:65:*:*:* http://[prov_domain]/prov/yealink
11. If you need Quality of Service (clean line) there is also in OpenWRT 13.10 included (qos-luci) add for QoS-Settings
   - 1. priority src=all dst=[your_mediaserver] service=all proto=udp
   - 2. priority src=[your_mediaserver] dst=all service=all proto=udp
   - 3. normal src=all dst=all service=all proto=all

This QoS implementation is a professional phone and fax solution!
I have transmitted hundreds of fax docs with full load traffic on router and not one is failed!

Add a New Phones to provision Panasonic or ...
----------------------------------------------
Add first by handsetting your phone to work, then export it from phone (most of that kind have this function..?)

1. Add some nice pictures for your phones in the directory on monster-ui css/assets/brands and css/assents/models in named snom_3xx_300.jpg must be in order! {brand}_{family}_{model}.jpg or if phone with a expansions_module {brand}_{family}_{model}-{ext_module}.jpg.
2. Now you can go to monster-ui you can see if you select to add a SIP-Phone you see the brands and you can select it
3. Setting up you phone with if possible (2 accounts-, key-, tone-, time-settings) that it works correct!
4. Download you settings from your phone, it have to be in cleartext format.
5. Split your template in 5 kinds 1. base, 2. behavior, 3. account, 4. tone  5. keys. (really need is only (3. account) must be in the this order) and put in (DEVELOP/{file plain or xml as you phone need}.php)

DEVELOP Directory
-----------------
XML based config files    => use upload_template_xml.php to generate templates
PLAIN based config files  => use upload_template_plain.php to generate templates 

6. Settings up all this settings as you can see in file.php TEMPLATE EXAMPLE and run this file to upload template to your couchdb
7. If you have new brand setting up, you have to add some php file: functions_{brand}.php and dir prov/{brand} also as is there
8. OK test all things and send it back to this repository, to share it with others also. Thank you back!

PLEASE GIVE ALSO YOUR TEMPLATES TO THIS GITHUB SITE..

Template Example
----------------
```json{
   "_id": "ui/mitel/67xx/6753-1",   <--- Id must be ui/{BRANDNAME}/{FAMILYNAME}/{MODELNAME}-{EXTENSION-MODULE <- COUNT}
   "pvt_type": "provisioner",       <--- pvt_type must so
   "endpoint_brand": "mitel",       <--- brand must be so
   "endpoint_family": "67xx",       <--- family must be so
   "endpoint_model": "6753-1",      <--- model must be so
   "cfg_base": {                1.  <--- cfg_base shoud be so ()
...
...
  },
   "cfg_account": {             2.  <--- cfg_account MUST BE!! THERE (kind of account) (PUT ALL RELEVANT SETTINGS LIKE USER, PASS, LINE in it)

       "sip line{ACCOUNT} user name": { (***) YOU CAN see {ACCOUNT} AND {SIPUSERNAME} you can see in db allready there!!
           "value": " {SIPUSERNAME}"
       },
...
  },
   "cfg_tone": {                3.  <--- cfg_tone shoud be so (kind of tone settings)
...
...
  },
   "cfg_keys": {                4.  <--- cfg_keys shoud be so ()
...
...
  },
  "usr_keys": {
       "setable_phone_keys": "6",           <-- count of programmable keys on main phone
       "setable_phone_key_counter": "1",    <-- counter keys start at 0 or 1 or ...
       "setable_phone_key_value": "prgkey", <-- value of template for programmable keys on the phone
       "setable_module_keys": "36",         <-- extension-module counts of programmable keys
       "setable_module_key_counter": "1",   <-- extensions-module counter keys start at 0 or 1 or ...
       "setable_module_key_value": "extkey" <-- value of template for programmable keys on the extension-module
  }
}```
