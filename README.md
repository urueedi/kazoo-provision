# kazoo-provision
provision integration in monster-ui

feel free to add more of ip-phones, because i don't have all the devices

THIS IS BETA CODE IT WORKS BUT WAIT UNTIL IS VERSION 1 OUT, THEN INTEGRATION FINISHED WITH MONSTER-UI

Install procedure
-----------------
1. INSTALL kazoo-platform
2. INSTALL monster-ui (from this repository because of adds in ui) AND php for webserver
4. INSTALL THIS in a WEBFOLDER where the monster-ui is
5. INSTALL with setup.php the database and add some brands on couchdb
6. set in config.php your couochdb nodes in $hosts="localhost.. "
7. To use https we use lets-encrypt after 27 of july 2015
8. To use Plug&Play for ip-phones you need openwrt and luci with dnsmasq from this github site
9. If you need Quality of Service (No chrrr in line) there is also in OpenWRT included (qos-luci) 

Add a New Phones to provision Panasonic or ...
----------------------------------------------
Add first by handsetting your phone to work, then export it from phone (most of that kind have this function..?)

1. ADD some nice pictures for your phones in the directory on monster-ui css/assets/brands and css/assents/models in named snom_3xx_300.jpg must be in order! {brand}_{family}_{model}.jpg
2. Now you can go to monster-ui you can see if you select to add a SIP-Phone you see the brands and you can select it
3. ADD a Template for new phones you have maybe. You have already a ip-phone set and it works correct?
4. Download you settings from your phones and split and change some Settings like so "{PROV_SERVER}" (Example on ***)
5. Split Templates in 5 kinds of Template 1. base, 2. behavior, 3. account, 4. tone  5. keys.
6. Split it as you can see we have done already (really need is only (3. account) must be in the this order)

XML based config files    => use upload_template_xml.php to generate templates
PLAIN based config files  => use upload_template_plain.php to generate templates 

7. set config (brand={snom}, family={3xx}, model={300}) in upload_template...php and run
8. After run one of script is tree updated and template is uploaded

If you pull new brand in, i must also update settings.php in eg. panasonic directory
PLEASE GIVE ALSO YOUR TEMPLATES TO THIS GITHUB SITE (ON ISSUES maybe!) to finished this....

Brandtree Example
-----------------
{
   "snom": {
       "id": "snom",
       "name": "snom",
       "families": {
           "3xx": {
               "id": "snom_3xx",
               "name": "3xx",
               "models": {
                   "300": {
                       "id": "snom_300",
                       "name": "300"
                   },

Template Example
----------------
{
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
}
