# Drop existing tables
DROP TABLE if exists authuser;
DROP TABLE if exists authaccess;
DROP TABLE if exists memberaccess;
DROP TABLE if exists log;
DROP TABLE if exists emailtemplates;

# Create table authaccess
CREATE TABLE authaccess (
  access_name varchar(50) NOT NULL default '',
  access_path varchar(100) NOT NULL default '',
  access_desc varchar(250) NOT NULL default '',
  create_time datetime,
  signup char(1)
) TYPE=MyISAM;



# Create table authuser
CREATE TABLE authuser (
  uname varchar(25) NOT NULL default '',
  passwd varchar(60) NOT NULL default '',
  name varchar(50), 
  email varchar(50), 
  address varchar(50),
  city varchar(20),
  state varchar(20),
  zip varchar(15),
  country varchar(20),
  phone varchar(20),
  status varchar(10),
  lastlogin datetime,
  logincount int(11),
  create_time datetime,
  signup char(1),
  welcome char(1),
  reg_validate char(1),
  validate_key varchar(20)
) TYPE=MyISAM;


# Dumping admin data to table authuser
INSERT INTO authuser (uname,passwd,status,create_time) VALUES ('admin', 'YWRtaW4xMjM=','1',now());


#Create table memberaccess
CREATE TABLE memberaccess (
  uname varchar(25) NOT NULL default '',
  access_name varchar(50) NOT NULL default ''
) TYPE=MyISAM;


#Create table log
CREATE TABLE log (
  uname varchar(25) NOT NULL default '',
  ctime datetime,
  ip varchar(20),
  activity varchar(100)
) TYPE=MyISAM;

#Create table log
CREATE TABLE emailtemplates (
  name varchar(25) NOT NULL default '',
  subject varchar(100),
  contents text
) TYPE=MyISAM;

# Dumping admin data to table authuser
INSERT INTO emailtemplates (name,subject,contents) values ('addmember','New account has been created','Dear member:

This is to notify you that the member account has been created.
Please use the Login ID/Password provided below to access member area.

Login ID: <%username%>
Password: <%password%>

Website URL: <a href="<%weburl%>/login.php"><%weburl%>/login.php</a>

Regards.');

INSERT INTO emailtemplates (name,subject,contents) values ('editmember','Account has been modified','Dear member:

This is to notify you that the member account has been modified.
Please use following Login ID/Password to access member area.

Login ID: <%username%>
Password: <%password%>

Website URL: <a href="<%weburl%>/login.php"><%weburl%>/login.php</a>

Regards.');

INSERT INTO emailtemplates (name,subject,contents) values ('signup','Activate your signup account','Dear member:

Thanks for completing the signup form, you have created signup member account, to activate this signup account, you must provide validation code,  please click the link below to activate your account.

<a href="<%weburl%>/reg_activate.php?username=<%username%>&vcode=<%code%>"><%weburl%>/reg_activate.php?username=<%username%>&vcode=<%code%></a>

Regards.');

INSERT INTO emailtemplates (name,subject,contents) values ('lostpass','Lost password retrieval','Dear member:

You have requested to have your login ID and password emailed to you. Here is your login information:

Login ID: <%username%>
Password: <%password%>

Website URL: <a href="<%weburl%>/login.php"><%weburl%>/login.php</a>

Regards.');