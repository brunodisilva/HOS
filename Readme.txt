#########################################
#					#
#	Login Manager, Version 3.0	#
#					#
#  	 Member Management System	#
#					#
#					#
#					#
#     Designed by Easebay Resources	#
#	All Rights Reserved, 2004	#	
#					#
#    Website: www.easebayresources.com	#
#					#
#########################################


Login Manager V3.0 is designed for web administrator to easily manage user accounts, create membership protected areas on the website, and provide capability to effortlessly limit user's access to secured areas. See our demo at: www.easebayresources.com for more features.

Login Manger V3.0(LM3.0) uses PHP and MySQL for lightning fast processing. LM3.0 comes with an admin control panel where administrator can create new user account, new secured access area, activate/deactivate user account, send mass email etc. There are two types of member accounts: administrator-created member and registered(signup) member, LM3.0 can assist administrator easily handle these two types of member accounts.


------------------------------
Contents:
  * Overview
  * Requirements
  * Installation
  * Administration
  * Usage
  * Terms and Conditions
------------------------------



==============================
Overview
==============================
Login Manager V3.0(LM3.0) is an authentication system which can integrate with any existing website that meets the requirements. LM3.0 provides a gatekeeper where user must be authorized before entering the membership secured areas.

Features:
1. Flexibility
LM3.0 allows administrator to integrate it with the current unprotected website. This is especially useful if major changes are going to be painful. With LM3.0, you're just one step towards getting the security you needed most.
    

2. Speed
LM3.0 uses PHP and MySQL which enables fast data transactions.
    

3. Security
LM3.0 uses .htaccess to protect member areas, it also uses HTML login form, instead of htaccess default login prompt box, unauthorized user cannot access until providing the correct login ID and password. All passwords are saved in encrypted format.


4. Reliability
LM3.0 provides database backup/restore system, administrator can backup/restore database at any time to avoid data lost, backup system significantly improves data reliability.


5. Ease of use
LM3.0 comes with a powerful administration interface that lets administrator control user access to secured area, very easy to add, edit, delete user account, view user account activity log, administrator has option to set welcome page for user's login of first time, also easy to create member access areas, with htaccess protection. 


====================================================
Requirements (This is of most web hostings provide)
====================================================
Operating System: Linux/Unix, Windows
Web Server: Apache server 1.X
Scripting: PHP 4
Database: MySQL


==============================
Installation
==============================
See "Installation.txt" file.  


==============================
Administration
==============================
After installation, five tables will be created which include the default admin account, these five tables can be viewed through DB management software like phpMyAdmin. It is recommended to change admin password after installing the application.

Tables:
------------
Authuser
Authaccess
Memberaccess
Log
Emailtemplates
------------

There are two types of member accounts:
* Regular Member Account --- the account which is created by administrator.
* Registered(Signup) Account --- users signup online and create account by themselves.

There are also two types of status for each account:
* Active Account --- For regular member account, administrator has already assigned membership secured areas to this account. For signup account, user already confirmed email and activated account.
* Inactive Account --- For regular member account, no member access area was assigned to this user. For signup account, user has filled out signup form but didn't validate email and activate account yet. 


Follow the instructions below to administer Login Manager.

1. Login as administrator:

1.1 Go to your website admin control panel login page.

1.2 Login as "admin" and enter the password. 

2. Create new password protected area

2.1 Click "Protected Directory", this is the area admin creates membership directories, which are protected by .htaccess.

2.2 Click "Add" button to create a new protected directory.

2.2.1 Enter "Access Name", this is the directory name you will create, "Directory Path" is the path to this directory on the server, it will be updated automatically, "Access Description" is the link description which will be shown on membership index page after user login. Administrator has option to select if the new secured area is created along, or add the new access to all existing active member accounts.

2.2.3 To delete a protected directory, select the directory on checkbox, then click "Delete" button. It's NOT recommended to use this delete function, administrator must be cautious to use this feature, as:
1) All members who currently have access to this secured area will be no long accessible.
2) If administrator deletes protected directories after using DB backup feature, then DB restore function may not work properly, as restoring system can only import user's membership data, it cannot re-create the directories which had already been deleted. 
3) If administrator creates sub-directories manually under the secured folder, this delete function may not work properly due to the file access permission. 


3. Add new members account

3.1 Click "Add Member", then enter username, password and other informaton of the new member account, select directories this member can access to, administrator has the option to email the user of this account creation, admin can also setup the welcome page which will be displayed when user login at the first time.

4. Edit/Delete member account

4.1 First search for this member by clicking search button on the search member page, then click "Edit" link to modify member profile or change access areas. Leave the password field blank if don't change the password.

4.2 To delete member account, search the member account then click "Delete" link, member account will be removed permanently.

5. View member profile and activity log

5.1 Search for this member account, click the link on member's login ID, it will show member's profile and all activity log.

6. Assign signup user default access area

6.1 Click "Signup Access", select the protected areas where signup user can access to, then submit to save the result, all signup users will have the same access to these secured areas.

7. Email notification

7.1 This is the area where administrator can send email to individual member or whole group.

8. Email templates

8.1 Administrator can modify email subject and contents, email will be sent to the user when adding/editing account, signing up new registration form, or retrieving lost password.

9. Change password

9.1 This feature is for administrator account only, it's designed to change admin password to prevent from unauthorized access to admin control panel.

10. Database backup/restore

10.1 DB status: Display table name, Row Format, Rows, Data Length, Create Time and Update Time. These are all table properties in Mysql database.

10.2 DB backup: Click the link "Create a Backup", this will bring administrator to DB backup page where admin can backup whole Login Manager DB or selected tables. 

10.3 DB restore: Click the link "List/Import backup", sort backed up files by Date, Name or Size, select file you want to restore, then click "Restore DB" button. "Delete" link will delete the corresponding DB backed up file.



==============================
Usage
==============================
1. For administrator

Admin control panel URL: http://www.yourdomain.com/admin/login.php

After running "setup.php" and configuring the application, administrator can start to upload membership files to secured directories.

Folder "members" contains all protected directories created by administrator, you will find three files in "members" folder:
index.php -- the main index page after member login.
welcome.php -- if member account is set to show welcome page, this is the page that member will see after login of first time.
.htaccess -- protect all member files, you can add more file types by editing ".htaccess" and "redir.php" files.

After administrator creates new secured directory, you will find there are five files in it:
index.php -- the main page of this protected area.
redir.php -- redirect to member files if user has been authorized to access this area.
sample.html, sample.jpg and sample.pdf -- these are sample files only and can be removed.

How to get files be protected?
Administrator uploads files into secured directory, the hyperlink in each html file needs to be modified.
For example, admin creates secured folder "secure_area1", and uploads three files: page1.htm, page2.htm, and image.jpg

Assume that page1.htm contains hyperlinks to page2.htm and image.jpg
The existing links in page1.htm are:
<a href="page2.htm">goto page2</a>
<a href="image.jpg">goto image</a>

With the new protecting method, change links to:
<a href="redir.php?filename=page2.htm">goto page2</a>
<a href="redir.php?filename=image.jpg">goto image</a>

Login Manager V3.0 creates one level protected area under "members" folder, for example "secure_area1", if you need to create sub-directories under "secure_area1"(like "members/secured_area1/sub_are1"), do three things:
1) copy index.php and redir.php from "secure_area1" into this sub-directory. Note: DO NOT copy these files from admin/templates folder.
2) edit these two files, find:
	include_once ("../../auth_member.php");
	include_once ("../../admin/authconfig.php");
	include_once ("../../check_member.php");
and change the path into:
	include_once ("../../../auth_member.php");
	include_once ("../../../admin/authconfig.php");
	include_once ("../../../check_member.php");
3) save the files.


2. For member

Membership login URL: http://www.yourdomain.com/login.php
Features: 
2.1 Remember Login ID/Password
2.2 Remove saved Login ID/Password
2.3 Create new account as signup user
2.4 Retrieve the lost Login ID/Password


==============================
Terms and Conditions
==============================
You should carefully read the following terms and conditions before using this software.  Unless you have a different license agreement signed by Easebay Resources,  your use of this software indicates your acceptance of this license agreement and warranty.

This is commercial version of software, which you cannot distribute without permissions of easebayresources.com website owners. 

Disclaimer of Warranty
THIS SOFTWARE AND THE ACCOMPANYING FILES ARE SOLD "AS IS" AND WITHOUT WARRANTIES AS TO PERFORMANCE OR MERCHANTABILITY OR ANY OTHER WARRANTIES WHETHER EXPRESSED OR IMPLIED. NO WARRANTY OF FITNESS FOR A PARTICULAR PURPOSE IS OFFERED.

Good data processing procedure dictates that any program be thoroughly tested with non-critical data before relying on it.  The user must assume the entire risk of using the program.  ANY LIABILITY OF THE SELLER WILL BE LIMITED EXCLUSIVELY TO PRODUCT REPLACEMENT.

Copyright© 2004 Easebay Resources