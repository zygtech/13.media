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
	$ID=explode(':',$_GET['id']);
	$articles=unserialize(file_get_contents('../users/' . $ID[1] . '.db'));
	foreach ($articles as $article) {
		if ($article['ID']==$ID[0] && $article['JID']==$ID[1]) {
			$JID=$article['JID'];
			$datestamp=$article['datestamp'];
			$content=$article['content'];
			$type=$article['type'];
			$articleID=$article['ID'];
		}
	}
	if ($ID[0]==hash('tiger128,4',$JID . $datestamp)) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Post - <?php echo $ID[0] . ':' . $ID[1]; ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Syne:wght@400..800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../style.css">
	<script>

	function changec(el) {
		var e = document.querySelector('.is-active');
		if (e) {
			e.classList.remove("is-active");
			e.scrollTo({
				top: 0,
				left: 0,
				behavior: "smooth"
			});
		}
		var x = document.getElementById(el);
		x.classList.add("is-active");
	}
	
	</script>
</head>

<body>
	<div class="border">
		<?php echo date('Y-m-d H:i',$datestamp); ?> - <a href="../wall/?JID=<?php echo $JID; ?>"><?php echo $JID; ?></a>
<?php
	if ($type=='') {
?>
	<article class="toggle" onclick="changec('<?php echo $article['ID']; ?>');" id="<?php echo $article['ID']; ?>">
<?php echo str_replace("\n","<br />\n", $content); ?>
	</article>
<?php
	}
	
	if ($type=='photo') {
?>
	<img src="<?php echo $content; ?>" />
<?php
	}
	
	if ($type=='video') {
		$youtube=true;
?>
	
	<video controls data-yt2html5="<?php echo $content; ?>"></video>
<?php
	}
?>
	<a href="../post/?id=<?php echo $articleID; ?>:<?php echo $JID; ?>">Share</a> <?php
	if ($_SESSION['JID']!=$JID) {
?>
	:: <select><option disabled selected>Grade This Article</option><option>Grade With +3</option><option>Grade With +2</option><option>Grade With +1</option><option>Grade With -1</option><option>Grade With -2</option><option>Grade With -3</option></select>
<?php
	} else {
?>
	:: <a href="../delarticle.php?id=<?php echo $article['ID']; ?>:<?php echo $JID; ?>">Delete</a>
<?php	
	}
?>	</div>
<?php
	if ($_SESSION['JID']!='') {
?>
	<a href="../wall"><h3>RETURN TO MY BLOG</h3></a>
	<center><small><a href="../wall/?logout=true">LOGOUT</a></small></center>
<?php	
	}
?>
</body>
<?php
	if ($youtube) {
?>
	<script src="https://cdn.jsdelivr.net/gh/thelevicole/youtube-to-html5-loader@4.0.1/dist/YouTubeToHtml5.js"></script>
	<script>
	new YouTubeToHtml5({
	    autoload: true,
	    withAudio: true
    });
    </script>
<?php
	}
?>
</html>
<?php
	}
?>
