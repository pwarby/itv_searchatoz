To install
==========
1.  Clone repository
2.  Assuming you are running Apache server - create new vhosts entry pointing to cloned repository
3.  Enable "AllowOverride All" in the vhost entry
4.  Turn on the mod_rewrite extension
5.  Ensure the /application/logs directory is writeable
6.  Restart your server and hit http://localhost/a-z

To run unit tests
=================
1.  Install phpunit
2.  Navigate to the /tests directory from a terminal
3.  Enter the command 'phpunit'

To view logs
============
*  Logs can be viewed by tailing the log files in /application/logs

Relevent files
==============
This application is built on top of codeigniter and twitter bootstrap. Relevent files which are not part of code igniter or bootstrap reside in:

*  /application/config/mercury.php
*  /application/controllers
*  /application/exceptions
*  /application/interfaces
*  /application/models
*  /application/views
*  /assets/css
*  /assets/img
*  /tests
