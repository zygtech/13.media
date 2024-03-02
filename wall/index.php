<?php
	session_start();
	if ($_GET['logout']=='true') {
		$_SESSION['JID']='';
		echo '<meta http-equiv="refresh" content="1;url=/" />';
		die('LOGGED OUT!');
	}
	if ($_GET['register']!='' && !file_exists('../users/' . $_GET['jid'] . '.password')) {
	    file_put_contents('../users/' . $_GET['jid'] . '.password',$_GET['register']);
	    $_SESSION['JID']=$_GET['jid'];
	}
	if ($_SESSION['JID']=='' && $_POST['JID']=='' && $_GET['id']=='') {
		echo '<meta http-equiv="refresh" content="0;url=/" />';
		die();
	}
	if ($_POST['REGISTER']=='true' && strlen($_POST['password'])>5 && !file_exists('../users/' . $_POST['JID'] . '.password')) {
	    mail($_POST['JID'],'13.media Registration','https://13.media/wall/?jid=' . $_POST['JID'] . '&register=' . hash('sha256',$_POST['password']));
	    die('Check your email for confirmation!');
	}
	elseif (file_exists('../users/' . $_SESSION['JID'] . '.password'))
		$_SESSION['JID']=$_SESSION['JID'];
	elseif (hash('sha256',$_POST['password'])==file_get_contents('../users/' . $_POST['JID'] . '.password'))
		$_SESSION['JID']=$_POST['JID'];
	elseif ($_GET['id']!='')
		$_SESSION['JID']='';
	else {
		echo '<meta http-equiv="refresh" content="1;url=/" />';
		die('WRONG LOGIN PASSWORD!');
	}
	if ($_GET['id']!='') $JID=$_GET['id']; else $JID=$_SESSION['JID'];
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
if ($JID!='') {
	$wall=array();
	$articles=unserialize(file_get_contents('../users/' . $JID . '.db'));
	foreach ($articles as $article) {
		if ($article['JID']==$JID) { 			
			array_unshift($wall,$article);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Wall - <?php echo $JID; ?></title>
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
<?php
	if ($_SESSION['JID']!='') {
?>
	<h3>PUBLISH NEW BLOG <a href="../newarticle.php">ARTICLE</a>/<a href="../newphoto.php">PHOTO</a>/<a href="../newvideo.php">VIDEO</a></h3>
	<h3>SHARE YOUR BLOG <a href="../wall/?id=<?php echo $JID; ?>">WEBSITE LINK</a></h3>
<?php	
	}
	foreach ($wall as $article) {
?>
	<div class="border">
		<?php echo date('Y-m-d H:i',$article['datestamp']); ?> - <a href="../wall/?JID=<?php echo $JID; ?>"><?php echo $JID; ?></a>
<?php
	if ($article['type']=='') {
?>
	<article class="toggle" onclick="changec('<?php echo $article['ID']; ?>');" id="<?php echo $article['ID']; ?>">
<?php echo str_replace("\n","<br />\n", $article['content']); ?>
	</article>
<?php
	}
	
	if ($article['type']=='photo') {
?>
	<img src="<?php echo $article['content']; ?>" />
<?php
	}
	
	if ($article['type']=='video') {
		$youtube=true;
?>
	
	<video controls data-yt2html5="<?php echo $article['content']; ?>"></video>
<?php
	}
?>
	<a href="../post/?id=<?php echo $article['ID']; ?>:<?php echo $JID; ?>">Share</a>
<?php
	if ($_SESSION['JID']!=$JID) {
?>
	:: <select><option disabled selected>Grade This Article</option><option>Grade With +3</option><option>Grade With +2</option><option>Grade With +1</option><option>Grade With -1</option><option>Grade With -2</option><option>Grade With -3</option></select>
<?php
	} else {
?>
	:: <a href="../delarticle.php?id=<?php echo $article['ID']; ?>:<?php echo $JID; ?>">Delete</a>
<?php	
	}
?>
	</div>
</body>
<?php
	if ($youtube) {
?>
	<script src="https://cdn.jsdelivr.net/gh/thelevicole/youtube-to-html5-loader@4.0.1/dist/YouTubeToHtml5.js"></script>
	<script>
	new YouTubeToHtml5({
	    autoload: true,
	    withAudio: true,
	    withVideo: true
    });
    </script>
<?php
	}
?>
</html>
<?php
	}
	if ($_SESSION['JID']!='') {
?>
	<center><small><a href="../wall/?logout=true">LOGOUT</a></small></center>
<?php	
	}
}
?>
