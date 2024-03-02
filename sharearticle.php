<?php
	error_reporting(-1);
	$articles=unserialize(file_get_contents('users/' . $_POST['JID'] . '.db'));
	if ($_POST['type']!='')
		$article['type']=$_POST['type'];	
	$article['JID']=$_POST['JID'];
	$article['datestamp']=$_POST['datestamp'];
	$article['content']=$_POST['content'];
	$article['ID']=hash('tiger128,4',$article['JID'] . $article['datestamp']);
	$articles[]=$article;
	file_put_contents('users/' . $article['JID'] . '.db',serialize($articles));
?>
<meta http-equiv="refresh" content="0;url=wall" />
