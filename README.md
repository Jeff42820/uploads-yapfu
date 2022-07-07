# uploads-yapfu

<h1>File Uploader - only one php file</h1>

<h2>Description</h2>

This software is designed to download/upload files from/to a web server.
You forgot your Usb key ? It can help.

It uses the basic authentification (AuthType Basic, auth_basic) for login possibilities, so each user has its private directory.

<h2>Snapshot</h2>

<img width="250" alt="snapshot-1" src="https://user-images.githubusercontent.com/94007934/177738728-a917c1c7-e285-412d-920f-9fdfb85d9ff5.png">

<h2>Installation</h2>

Create an empty directory under the server root dir and download upload.php in it.
Then change the ownership and permissions of this dir.
NB: You can rename upload.php index.php in order to have a simple url.

Example for Debian :
```
sudo mkdir /var/www/html/uploads
sudo chown root:www-data  /var/www/html/uploads
sudo chmod 770 /var/www/html/uploads
cd /var/www/uploads
sudo cp upload.php /var/www/html/uploads/index.php
sudo chown root:root  /var/www/html/uploads/index.php
sudo chmod 644 /var/www/html/uploads/index.php
```

<h2>Server configuration</h2>

Apache2 :

```
<Directory "/var/www/html/uploads">
  AuthType Basic
  AuthUserFile /etc/nginx/.htpasswd
  AuthGroupFile /dev/null
  AuthName "Please Enter Password"
  Require valid-user
  Allowoverride None
</Directory>
```

Nginx :

```
server {
  listen 80 default_server;
  listen [::]:80 default_server;
  root /var/www/html;
  # ( ...... )
  location /uploads {
    auth_basic "Enter your password";
    auth_basic_user_file  /etc/nginx/.htpasswd;
  }
}
```

<h2>Create .htpasswd</h2>

```
sudo htpasswd -c /etc/nginx/.htpasswd user1
sudo htpasswd    /etc/nginx/.htpasswd user2
```
