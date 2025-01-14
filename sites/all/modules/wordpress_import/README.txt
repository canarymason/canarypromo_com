DESCRIPTION
-----------

This Drupal module imports a Wordpress blog from a Wordpress eXtended RSS (WXR) 
format file.


AUTHORS
-------

Jerome Charaoui, aka lavamind (http://www.koumbit.org/)
Yann Rocq (http://www.rocq.net/yann/)


SYSTEM REQUIREMENTS
-------------------

* PHP 5.1+
* Drupal 6
* Required modules: ctools
* Optional modules: comment, path, og, taxonomy, trackbacks
* Wordpress 2.1+


USAGE
-----

In Wordpress :

 * Go to the administration zone of your blog

 * In the "Tools" menu, click "Export"

 * Using the drop-down menu, choose which authors to export

 * Click the button "Download Export File"

 * Save the generated *.xml file on your computer

If you have difficulty obtaining the WXR file from your Wordpress installation, 
please refer to the Wordpress documentation.

In Drupal :

 * Before installing this module it is very strongly recommended to make a 
   backup of your Drupal database. You can use the "Backup and Migrate" module 
   to do this quickly and easily.

 * Unzip the archive of the module and copy the directory wordpress_import 
   obtained in the directory sites/all/modules of your Drupal installation.

 * Log in to your site as super user (first user created in Drupal)

 * Activate the module in the administration page

 * Click on the new menu "Administer / Content management / Wordpress Import"

 * Click "Browse..." then select the file WXR previously downloaded from 
   Wordpress

 * Click "Next"

 * Choose the desired options to configure the import process

 * Click "Next"

 * Depending on the options chosen, there may be other option forms presented 
   to you

 * When the import process is fully configured, review your options and click 
   "Finish"

 * Sit back and relax while your Wordpress site is being imported into Drupal
 
 * Posts that were previously imported will not be imported again, but new
   comments on old posts will be imported

 * A summary of the imported objects is displayed at the end of the process


UGLY WORDPRESS PERMALINKS
-------------------------

If your Wordpress site was configured with 'ugly' permalinks (ie. links ending 
with ?p=<number>), and you wish to maintain these links after migrating to 
Drupal, you will need to modify your Drupal ".htaccess" file, normally located
at the root of your Drupal installation, as follows :

-> Locate the following paragraph :

  # If your site is running in a VirtualDocumentRoot at http://example.com/,
  # uncomment the following line:
  # RewriteBase /

-> Immediately after, add this paragraph :

  # Map Wordpress ugly-style permalinks to Drupal aliases
  RewriteCond %{QUERY_STRING} ^(p|page_id)=(\d+)$
  RewriteRule ^$ /%1/%2? [L,R=301]

After completing this step, your old permalinks will redirect to the new Drupal
alias. Note that if you change or delete the alias created by Wordpress Import,
your permalinks will no longer work and will return a 404 error.


KNOWN ISSUES
------------

 * No rollback if something wrong happens. You must make a backup of your 
   database before importing a blog. You can use an extra module such as "Backup
   and Migrate" to easily backup your Wordpress database.
   
 * User passwords aren't transferred from Wordpress, a password for new users 
   must be set after importing. This is a limitation of the Wordpress WXR export
   format.
   
 * Blogroll isn't imported because it isn't included in the WXR export file 
   created by WordPress. However, you can find instructions on how to export 
   your site's blogroll as an OPML file : http://codex.wordpress.org/FAQ_Working_with_WordPress#How_do_I_import_links_.28blogroll.29_from_another_WordPress_blog.3F
   
   This OPML file can then be imported into Drupal through a module such as
   Feeds : http://drupal.org/project/feeds
   
 * Special Wordpress tags such as [video] and [caption] are not automatically
   translated into HTML

 * Password-protected posts are imported as unpublished nodes. This function can
   be replicated using this module : http://drupal.org/project/protected_node

 * WordPress redirects, attachments and custom fields are not imported, patches
   welcome.


Thanks to the following contibutors for their patches and feedback : Henriette, 
Andrew Turner, VladSavitsky, Irina Zaks, kmonty
