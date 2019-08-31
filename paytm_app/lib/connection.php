<?php

$con = @mysql_connect("localhost","heylaapp_app","heyla@66444");

if ($con) {
		mysql_select_db('heylaapp_apptest');
    } else {
		die("Connection failed");
}
?>