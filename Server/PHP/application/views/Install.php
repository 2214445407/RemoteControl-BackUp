<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>程序安装 - RemoteControl</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="/plugins/node-waves/waves.css" rel="stylesheet" />
	<link href="/plugins/animate-css/animate.css" rel="stylesheet" />
	<link href="/css/style.css" rel="stylesheet">
</head>
<body class="login-page">
	<div class="login-box">
		<div class="logo">
			<a href="javascript:void(0);">Remote<b>Control</b></a>
			<small>程序安装</small>
		</div>
		<div class="card">
			<div class="body">
				<form id="sign_in" action="/Install/Setup" method="POST">
					<label for="HOT">数据库地址</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="HOT" class="form-control" name="hot" placeholder="请输入您的数据库地址" required autofocus>
						</div>
					</div>
					<label for="USR">数据库账号</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="USR" class="form-control" name="usr" placeholder="请输入您的数据库账号" required>
						</div>
					</div>
					<label for="PWD">数据库密码</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="PWD" class="form-control" name="pwd" placeholder="请输入您的数据库密码" required>
						</div>
					</div>
					<label for="DBN">数据库名称</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="DBN" class="form-control" name="dbn" placeholder="请输入您的数据库名称" required>
						</div>
					</div>
					<label for="ADMINUSR">管理员账号</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="ADMINUSR" class="form-control" name="username" placeholder="请输入您的管理员账号" required>
						</div>
					</div>
					<label for="ADMINPWD">管理员密码</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="ADMINPWD" class="form-control" name="password" placeholder="请输入您的管理员密码" required>
						</div>
					</div>
					<label for="ADMINEMA">管理员邮箱</label>
					<div class="input-group">
						<div class="form-line">
							<input type="text" id="ADMINEMA" class="form-control" name="emailadd" placeholder="请输入您的管理员邮箱" required>
						</div>
					</div>
					<button class="btn btn-block bg-pink waves-effect" type="submit">开始安装</button>
				</form>
			</div>
		</div>
	</div>
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="/plugins/node-waves/waves.js"></script>
	<script src="/plugins/jquery-validation/jquery.validate.js"></script>
	<script src="/js/admin.js"></script>
	<script src="/js/pages/examples/sign-in.js"></script>
</body>
</html>