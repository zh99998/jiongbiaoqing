<?php
/**
 * pages.inc.php
 *
 * page functions
 *
 * @author Tamashii
 * @version 13.12.18
 */
require_once('config.inc.php');
function getHeader($title = "首页") {
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title><?=$title ?> - <?=SITE_NAME ?></title>
		<!-- jQuery 1.10.2 -->
		<script src="js/jquery-1.10.2.min.js"></script>
		<!-- Bootstrap 3.0.3 -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/global.css">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      					<span class="sr-only">Toggle navigation</span>
      					<span class="icon-bar"></span>
      					<span class="icon-bar"></span>
      					<span class="icon-bar"></span>
    				</button>
    				<a class="navbar-brand" href="<?=SITE_URL ?>">囧表情</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?=SITE_URL ?>/home">主页</a></li>
                        <li><a href="<?=SITE_URL ?>/list">列表</a></li>
                        <li><a href="<?=SITE_URL ?>/about">关于</a></li>
                        <li><a href="<?=SITE_URL ?>/help">帮助</a></li>
                    </ul>
      				<ul class="nav navbar-nav pull-right">
      					<li><a href="<?=SITE_URL ?>/signin">登录</a></li>
      					<li><a href="<?=SITE_URL ?>/signup">注册</a></li>
      				</ul>
      			</div>
      		</div>
		</div>
		<div class="container">
			<div class="main">
<?php
}
function getFooter() {
?>
			</div>
			<!-- Hitokoto API -->
			<span id="hitokoto">加载中……</span><sup><a href="http://hitokoto.us">Hitokoto</a></sup>
			<script type="text/javascript">
			function hitokoto(data) {
				$('#hitokoto').html(data.hitokoto);
				$('#hitokoto').attr({title:'分类:' + data.catname + '  投稿日期:' + data.date + '  投稿人:' + data.author + '  出处:' + data.source});
			}
			$('#hitokoto').click(function() {
				$(this).html('加载中……');
				$.getScript('http://api.hitokoto.us/rand?encode=jsc&charset=utf-8');
			});
			$.getScript('http://api.hitokoto.us/rand?encode=jsc&charset=utf-8');
			</script>
		</div>
		<script type="text/javascript">
		if (console != undefined) {
			console.log('喜欢偷窥别人的代码？');
			console.log('这习惯不好吧！兄弟！');
			console.log('这样吧，既然你看都看了');
			console.log('那索性来帮我们怎么样？');
			console.log('我的G+帐号是：zh99998@gmail.com');
			console.log('等着你加我哦～');
		}
		</script>
	</body>
</html>
<?php
}
function getFormListItem($data) {
?>
					<div class="gener">
						<h3><a href="<?=$data['url'] ?>"><?=$data['title'] ?></a> <small><?=$data['time'] ?></small></h3>
						<p><?=$data['description'] ?></p>
						<img src="upload/thumbnail/<?=$data['thumbnail'] ?>" alt="<?=$data['title'] ?>"> <!-- 给作者放一个预览图用的 -->
					</div>
<?php
}
?>