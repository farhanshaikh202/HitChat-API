<?php

if(!mysql_connect("localhost", "chatts", "farhanshaikh"))
	{
		echo "error";
		die();
	}
mysql_select_db("chatts");

?>