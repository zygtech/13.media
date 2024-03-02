<?php
	session_start();
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
	$wall=array();
	$ID=explode(':',$_GET['id']);
	if ($ID[1]==$_SESSION['JID']) {
	$articles=unserialize(file_get_contents($ID[1] . '.db'));
	foreach ($articles as $article) {
		if ($article['ID']!=$ID[0]) { 			
			$clean[]=$article;
		}
	}
	file_put_contents($ID[1] . '.db',serialize($clean));
	}
?>
<meta http-equiv="refresh" content="0;url=wall" />
