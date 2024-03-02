<?php
    session_start();
    if (file_exists('users/' . $_SESSION['JID'] . '.password')) {
        echo '<meta http-equiv="refresh" content="0;url=wall" />';
        die();
    }
/*
 * index.php
 * 
 * Copyright 2024  <krzysztof@zygtech.pl>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>13.media Login</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Syne:wght@400..800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="border">
		Login with E-mail:
	<form id="login" action="wall/" method="POST">
	<input type="text" name="JID" placeholder="LOGIN ID" />
	<input type="password" name="password" placeholder="PASSWORD" />
	<center><input id="check" type="checkbox" name="REGISTER" value="true" /><label for="check">register new account</label></center>
	</form><br />
		<a onclick="document.getElementById('login').submit();">Login/Register</a>
	</div>
</body>

</html>
