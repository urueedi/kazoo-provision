# kazoo-provision
Provision integration in monster-ui-voip

1. network settings will be local and never be part of this provision-solution.
2. cache-solution will be there, if this provisioner will fail
3. feel free to add more of ip-phones, because i don't have all the devices!

Install procedure
-----------------
1. INSTALL kazoo-platform (from this repository because of changes: use 3.20)
2. INSTALL monster-ui (from this repository because of adds in ui) AND php for webserver
4. INSTALL THIS in a WEBFOLDER where the monster-ui is, or on sep. domain
5. INSTALL with on console ./setup.php the database and add brand_provisioner to couchdb
6. set in this folder config.php your cochdb nodes in $hosts="localhost domain2.com ..."
7. set in monster-ui /js/config.js provisioner: "http://yourdomain.com/your_path_installed..."
   - check this by using the add sip-phone-button in monster-ui->voip->devices 
8. If you need plug&play support for ip-phones you need openwrt from this github site. To add for VoIP-Phones use e.g.
   - snom:  00:04:13:*:*:* http://[prov_domain]/prov/snom/settings.php?mac={mac}&pass=[PROVPASS_ACCOUT_UI]
   - mitel: 00:08:5d:*:*:* http://[prov_domain]/prov/mitel
9. If you need Quality of Service (No chrrr in line) there is also in OpenWRT included (qos-luci) add for QoS-Settings
   - 1. priority src=all dst=[your_mediaserver] service=all proto=udp
   - 2. priority src=[your_mediaserver] dst=all service=all proto=udp
   - 3. normal src=all dst=all service=all proto=all

This QoS implementation is a professional phone and fax solution!
I have transmitted hundreds of fax docs with full load traffic on router and not one is failed!

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
```json{
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
                   },`
```
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
