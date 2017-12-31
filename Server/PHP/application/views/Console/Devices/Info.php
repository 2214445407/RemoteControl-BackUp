<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>设备详情 - <?php echo $ack; ?> - <?php echo $sites['configs']->sitename; ?></title>
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
				<h2>设备详情</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body">
							<div class="alert alert-warning"><b>警告！</b>您正在查看 <?php echo $ack; ?> 的信息</div>
							<label for="RIP">外网 IP</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="RIP" class="form-control" value="<?php echo $rip; ?>" disabled>
								</div>
							</div>
							<label for="SIP">内网 IP</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="SIP" class="form-control" value="<?php echo $sip; ?>" disabled>
								</div>
							</div>
							<label for="HOT">主机名</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="HOT" class="form-control" value="<?php echo $hot; ?>" disabled>
								</div>
							</div>
							<label for="IPC">IPConfig</label>
							<div class="form-group">
								<div class="form-line">
									<textarea id="IPC" class="form-control" rows="10" disabled><?php echo @base64_decode($ipc); ?></textarea>
								</div>
							</div>
							<label for="TIM">上次上线时间</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="TIM" class="form-control" value="<?php echo $tim; ?>" disabled>
								</div>
							</div>
							<a href="/Console/Commands/Add/<?php echo $ack; ?>" class="btn btn-default">下达命令</a>
							<a href="/Console/Devices/Delete/<?php echo $ack; ?>" class="btn btn-danger" data-no-instant>删除设备</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>