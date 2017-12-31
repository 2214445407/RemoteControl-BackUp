<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>登录 - <?php echo $sites['configs']->sitename; ?></title>
	<?php $this->load->view('Console/Head'); ?>
</head>
<body class="login-page">
	<div class="login-box">
		<div class="logo">
			<a href="javascript:void(0);">Remote<b>Control</b></a>
			<small>远程控制</small>
		</div>
		<div class="card">
			<div class="body">
				<form id="sign_in" action="Login" method="POST">
					<div class="msg">登录到此站点</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">person</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="username" placeholder="账号" required autofocus>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">lock</i>
						</span>
						<div class="form-line">
							<input type="password" class="form-control" name="password" placeholder="密码" required>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8 p-t-5">
							<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
							<label for="rememberme">记住我</label>
						</div>
						<div class="col-xs-4">
							<button class="btn btn-block bg-pink waves-effect" type="submit">登录</button>
						</div>
					</div>
					<div class="row m-t-15 m-b--20">
						<div class="col-xs-6">
							<?php if($sites['configs']->register == 'on'): ?><a href="Register">注册一个账号</a><?php endif; ?>
						</div>
						<div class="col-xs-6 align-right">
							<a href="ForgetPassword">忘记了密码</a>
						</div>
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