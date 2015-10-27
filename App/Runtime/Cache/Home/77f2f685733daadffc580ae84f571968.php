<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>For优 注册</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
		<link rel="icon" href="/fuwebapp/favicon.ico" type="image/x-icon" />
		<link href="/fuwebapp/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/commonstyle.css" />
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/style.css" />
		<link type="text/css" rel="stylesheet" href="/fuwebapp/Public/css/style-y.css" />
	</head>
	
	<body>
		<div class="register-head">
			<span class="fl text-special history-back glyphicon glyphicon-circle-arrow-left"></span>
			<span class="head-title">注册</span>
		</div><!--register-head-->
		<form id="register-form" action="/fuwebapp/index.php/home/login/toRegister">
			<div class="register-info-input">
				<span class="glyphicon glyphicon-user"></span>
				<span class="spliter"></span>
				<input type="text" name="nickname" placeholder="用户昵称">
			</div>
			<div class="error-message-wrapper">
				
	   		</div>

			<div class="register-info-input">
				<span class="glyphicon glyphicon-lock"></span>
				<span class="spliter"></span>
				<input type="password" name="password" placeholder="输入密码">
			</div>
			<div class="error-message-wrapper">
				
	   		</div>

			<div class="register-info-input">
				<span class="glyphicon glyphicon-lock"></span>
				<span class="spliter"></span>
				<input type="password" name="confirm-password" placeholder="确认密码">
			</div>
			<div class="error-message-wrapper">
				
	   		</div>

			<div id="phone-user-info" class="register-info-input">
				<span class="glyphicon glyphicon-phone"></span>
				<span class="spliter"></span>
				<input type="text" name="phone" placeholder="手机号码">
			</div>
			<div class="error-message-wrapper">
				
	   		</div>
			
			<div id="security-code-wrapper">
				
				<input type="text" name="confirmcode" placeholder="验证码">
				<span id="security-code-img"><img id="securityCode" src="/fuwebapp/index.php/home/login/verify/id/'+Math.random()" onclick="this.src='/fuwebapp/index.php/home/login/verify/id/'+Math.random()"/> </span>
				<!-- <button class="btn verify-code">发送验证码</button>	 -->
			</div>


			<div id="confirm-code" class="register-info-input">
				<span class="glyphicon glyphicon-comment"></span>
				<span class="spliter"></span>
				<input type="text" name="confirmcode" placeholder="验证码">
				<input id="resent-secword" type="button" value="发送验证码">
				<!-- <button class="btn verify-code">发送验证码</button>	 -->
			</div>
			<div class="error-message-wrapper">
				
	   		</div>

	   		<div id="user-protocol">
				<p><input id="user-protocol-input" type="checkbox">已阅读并同意<a class="text-subspecial" href="<?php echo U('Login/protocol');?>">《For优用户服务协议》</a></p>
			</div>
			<input id="button-register" type="submit" value="立即注册" class="btn register-info-submit-btn">
		</form>

		<script type="text/javascript" src="/fuwebapp/Public/script/plugins/jquery-1.11.2.js"></script>
		<script type="text/javascript" src="/fuwebapp/Public/script/plugins/jquery.validate.js"></script>
		<script src="/fuwebapp/Public/script/common.js" type="text/javascript"></script>
		<script src="/fuwebapp/Public/script/register.js" type="text/javascript"></script>
	</body>
</html>