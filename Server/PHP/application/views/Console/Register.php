<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>注册 - <?php echo $sites['configs']->sitename; ?></title>
	<?php $this->load->view('Console/Head'); ?>
</head>
<body class="signup-page">
	<div class="signup-box">
		<div class="logo">
			<a href="javascript:void(0);">Remote<b>Control</b></a>
			<small>远程控制</small>
		</div>
		<div class="card">
			<div class="body">
				<form id="sign_up" action="Register" method="POST">
					<div class="msg">注册一个新的账号</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">email</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="emailadd" placeholder="邮箱" required autofocus>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">person</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="username" placeholder="账号" required>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">lock</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="password" placeholder="密码" required>
						</div>
					</div>
					<div class="form-group">
						<input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
						<label for="terms">我阅读了并且遵守 <a href="javascript:void(0);">服务条款</a>.</label>
					</div>
					<button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">注册</button>
					<div class="m-t-25 m-b--5 align-center">
						<a href="Login">我已经有一个账号了</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="/plugins/node-waves/waves.js"></script>
	<script src="/js/admin.js"></script>
	<?php $this->load->view('Console/Footer'); ?>
	<style type="text/css">
		#instantclick-bar {
			background: red;
		}
	</style>
</body>
</html>