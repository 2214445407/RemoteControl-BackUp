<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$usr = $this->session->userdata('userinfo')['usr'];
$ema = $this->session->userdata('userinfo')['ema'];
$tim = $this->session->userdata('userinfo')['tim'];

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>我的资料 - <?php echo $usr; ?> - <?php echo $sites['configs']->sitename; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="/plugins/node-waves/waves.css" rel="stylesheet" />
	<link href="/plugins/animate-css/animate.css" rel="stylesheet" />
	<link href="/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="theme-red">
	<?php $this->load->view('Console/PageLoader'); ?>
	<div class="overlay"></div>
	<?php $this->load->view('Console/SearchBar'); ?>
	<?php $this->load->view('Console/TopBar'); ?>
	<?php $this->load->view('Console/SideBar'); ?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>我的资料</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body">
							<form action="/Console/Profile" method="POST">
								<div class="alert alert-warning"><b>警告！</b>您正在修改 <?php echo $usr; ?> 的资料</div>
								<label for="USR">账号</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="USR" class="form-control" value="<?php echo $usr; ?>" disabled>
									</div>
								</div>
								<label for="PWD">密码</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="PWD" class="form-control" name="password" placeholder="为空则不修改">
									</div>
								</div>
								<label for="EMA">邮箱</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="EMA" class="form-control" name="emailadd" value="<?php echo $ema; ?>">
									</div>
								</div>
								<label for="TIM">上次上线时间</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" id="TIM" class="form-control" value="<?php echo $tim; ?>" disabled>
									</div>
								</div>
								<button type="submit" href="/Console/Profile" class="btn btn-default">保存</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script>
	<script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="/plugins/node-waves/waves.js"></script>
	<script src="/js/admin.js"></script>
	<script src="/js/demo.js"></script>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>