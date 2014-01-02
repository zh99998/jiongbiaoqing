<?php
session_start();
if ($_FILES['fileUpload']['size'] > 5000000) {
	$_SESSION['msg'] = '上传的文件大于5MB，请压缩后再上传。';
	if ($_GET['m'] != 'ajax') {
	}
	else {
		die(0);
	}
	header('Location: /message');
	return;
}
$filename = 'upload/'.time().'.'.substr(strrchr($_FILES['fileUpload']['name'], '.'), 1);
$_SESSION['last_upload'] = $filename;
move_uploaded_file($_FILES['fileUpload']['tmp_name'], $filename);
if ($_GET['m'] != 'ajax') {
	header('Location: /newform');
}
else {
	echo 1;
}
?>