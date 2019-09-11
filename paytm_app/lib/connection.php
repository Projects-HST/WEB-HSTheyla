<?php

$con = @mysql_connect("localhost","root","O+E7vVgBr#{}");

if ($con) {
		mysql_select_db('heylaapp_app');
    } else {
		die("Connection failed");
}
?>