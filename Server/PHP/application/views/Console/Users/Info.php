<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>用户详情 - <?php echo $usr; ?> - <?php echo $sites['configs']->sitename; ?></title>
	<?php $this->load->view('Console/Head'); ?>
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
				<h2>用户详情</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body">
							<div class="alert alert-warning"><b>警告！</b>您正在查看 <?php echo $usr; ?> 的信息</div>
							<label for="USR">账号</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="USR" class="form-control" value="<?php echo $usr; ?>" disabled>
								</div>
							</div>
							<label for="PWD">密码</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="PWD" class="form-control" value="<?php echo $pwd; ?>" disabled>
								</div>
							</div>
							<label for="EMA">邮箱</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="EMA" class="form-control" value="<?php echo $ema; ?>" disabled>
								</div>
							</div>
							<label for="SEC">SEC</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="SEC" class="form-control" value="<?php echo $sec; ?>" disabled>
								</div>
							</div>
							<label for="PKT">PKT</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="PKT" class="form-control" value="<?php echo $pkt; ?>" disabled>
								</div>
							</div>
							<label for="RIP">上次登录 IP</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="RIP" class="form-control" value="<?php echo $rip; ?>" disabled>
								</div>
							</div>
							<label for="TIM">上次上线时间</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="TIM" class="form-control" value="<?php echo $tim; ?>" disabled>
								</div>
							</div>
							<a href="/Console/Users/Delete/<?php echo $cid; ?>" class="btn btn-danger" data-no-instant>删除用户</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>