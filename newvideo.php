<?php
	session_start();
/*
 * newarticle.php
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
if ($_SESSION['JID']!='') {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>New Blog Video</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Syne:wght@400..800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="border">
		<?php $time=time(); echo date('Y-m-d H:i', $time); ?> - <?php echo $_SESSION['JID']; ?>
	<form id="newarticle" action="sharearticle.php" method="POST">
	<input type="hidden" name="type" value="video" />
	<input type="hidden" name="datestamp" value="<?php echo $time; ?>" />
	<input type="hidden" name="JID" value="<?php echo $_SESSION['JID']; ?>" />
	<input type="text" name="content" placeholder="YOUTUBE URL" />
	</form>
		<a onclick="document.getElementById('newarticle').submit();">Share</a> :: <a href="https://youtube.com/upload" target="_BLANK">Upload on YouTube</a>
	</div>
	<a href="wall"><h3>RETURN TO MY BLOG</h3></a>
	<center><small><a href="wall/?logout=true">LOGOUT</a></small></center>
</body>

</html>
<?php
}
?>
