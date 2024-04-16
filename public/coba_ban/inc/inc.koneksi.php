<?php
//server = 127.0.0.1
//user = bansmpro_root
//pass = kmzwa88saa
//db = bansmpro_jatim
$myConnection = mysqli_connect("127.0.0.1", "bansmpro_root", 
"kmzwa88saa") 
or die("could not connect to mysql");
mysqli_select_db($myConnection, "bansmpro_jatim") or die("no 
database");
