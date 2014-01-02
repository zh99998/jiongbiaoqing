<?php
/**
 * index.php
 * 
 * Main processing.
 *
 * @author Tamashii
 * @version 13.12.18.1850
 */

// page contents.
// home, list, generate, about, signin, signup, help
$act = $_GET['m'];
if (!isset($act))
	$act = 'home';
// include files
require_once('includes/config.inc.php');
require_once('includes/pages.inc.php');
// Home
if (strcasecmp($act, 'home') === 0) {
	getHeader('首页');
?>
				<div class="page-header">
					<h1>囧表情 <small>生成你的表情在线制作工具！</small></h1>
				</div>
				<div class="index">
					<h3>最近创建</h3>

<?php
	$stmt = $mysqli->prepare("select nFormID, txtFormName, nPostTime, txtDescription, txtThumbnail from tbl_forms where isAvaliable = 1 order by nPostTime desc limit 0, 5;");
	if (!$stmt) {
		die('发生错误：'.$mysqli->error);
	}
	$stmt->execute();
	$stmt->bind_result($id, $name, $time, $desc, $thumb);
	$count = 0;
	while($stmt->fetch()) {
		$data['title'] = $name;
		$data['url'] = SITE_URL.'/'.$id;
		$data['time'] = date('H:i:s Y:m:d', $time);
		$data['description'] = $desc;
		$data['thumbnail'] = $thumb;
		getFormListItem($data);
		$count++;
	}
	if ($count == 0) {
?>
					<blockquote>还没有人发布生成器哦~！还不快来<a href="upload">发布一个</a>！</blockquote>
<?php
	}
?>
			</div>
<?php
	getFooter();
}
else if (strcasecmp($act, 'list') === 0) {

}
else if (strcasecmp($act, 'upload') === 0) {
	getHeader('制作生成器');
?>
				<div class="page-header">
					<h1>制作生成器</h1>
				</div>
				<div class="index">
					<h3>步骤一：请先上传一张图片</h3>
					<div id="uploader">
					</div>
					<span id="lblMessage"></span>
					<script type="text/javascript" src="js/ajaxUpload.js"></script>
					<script type="text/javascript">
					var file = null;
					var reader = null;
					$('#uploader').css({'border':'dashed 2px #999','border-radius':'10px'});
					if ((document.ondrag !== undefined) && !/symbian|android|ios|iphone/i.test(navigator.userAgent)) {
						// HTML5 in desktop, using drag & drop.
						$('#uploader').append($('<div id="dropbox" name="fileUpload">请将要上传的文件拖拽到这里。</div>'));
						$('#dropbox').css({'font-size':'16px', 'line-height':'240px', 'text-align':'center', 'background':'#f0f0f0'});
						$('#dropbox').bind('dragenter', function(e) {
							this.style.background = '#e0e0e0';
						});
						$('#dropbox').bind('dragleave', function(e) {
							this.style.background = '#f0f0f0';
						});
						$('#dropbox').bind('dragover', function(e) {
							e.stopPropagation();
							e.preventDefault();
						});
						$('#dropbox').get(0).ondrop = function(e) {
							e.stopPropagation();
							e.preventDefault();
							var fileList = e.dataTransfer.files;
							if (fileList.length > 1) {
								$('#lblMessage').html('请不要一次拖入多个文件，请重新上传');
								return false;
							}
							file = fileList[0];
							if (!/^(image)/.test(file.type)) {
								$('#lblMessage').html('您所上传的文件不是图片，请重新上传');
								$('#dropbox').css({'font-size':'16px', 'line-height':'240px', 'text-align':'center', 'background':'#f0f0f0'});
								return false;
							}
							if (/firefox/i.test(navigator.userAgent)) {
								ffUpload = new FireFoxFileUpload("<?=SITE_URL?>/uploadfile.php", 'fileUpload');
								ffUpload.upload(ffUpload.getFile(e));
							}
							if (/chrome/i.test(navigator.userAgent)) {
								chromeUpload = new ChromeFileUpload("<?=SITE_URL?>/uploadfile.php", 'fileUpload');
								chromeUpload.upload(chromeUpload.getFile(e));
							}
							window.location.href = '/newform';
							/*
							reader.onloadend = function() {
								boundary = '---------------------------7d4a6d158c9';
								xmlHttp = new XMLHttpRequest();
								xmlHttp.open('post', '/uploadfile.php?m=ajax', false);
								xmlHttp.setRequestHeader("Content-Type", "multipart/form-data, boundary="+boundary);
								var body = '';
								body += '--' + boundary + '\r\n';
								body += 'Content-Disposition: form-data; name="fileUpload"; filename="' + file.name + '"\r\n';
								body += 'Content-Type: ' + file.type + '\r\n\r\n';
								strs = reader.result.split('base64,');
								body += utf8to16(base64decode(strs[1])) + '\r\n';
								body += '--' + boundary + '\r\n';
								console.log(body);
								xmlHttp.onreadystatechange = function() {
									if(xmlHttp.readyState == 'complete' || xmlHttp.readyState == 4) {
										if (xmlHttp.responseText == 1) {
											window.location.href = '/newform';
										}
										else {
											window.location.href = '/message';
										}
									}
								};
								xmlHttp.send(body);
							};
							*/
						};
					}
					else {
						// HTML 4.1 or mobile, using form upload.
					}
					</script>
				</div>
<?php
	getFooter();
}
else if (strcasecmp($act, 'newform') === 0) {

}
else {
	header('Location: /404.html');
}
?>
