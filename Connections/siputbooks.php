<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_siputbooks = "localhost";
$database_siputbooks = "siputbooks";
$username_siputbooks = "root";
$password_siputbooks = "";
$siputbooks = @mysql_pconnect($hostname_siputbooks, $username_siputbooks, $password_siputbooks) or trigger_error(mysql_error(),E_USER_ERROR); 
?>