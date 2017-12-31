<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>仪表盘 - <?php echo $sites['configs']->sitename; ?></title>
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
				<h2>仪表盘</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-pink hover-expand-effect">
						<div class="icon">
							<i class="material-icons">desktop_windows</i>
						</div>
						<div class="content">
							<div class="text">设备数量</div>
							<div class="number count-to" data-from="0" data-to="<?php echo $dev; ?>" data-speed="15" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-cyan hover-expand-effect">
						<div class="icon">
							<i class="material-icons">near_me</i>
						</div>
						<div class="content">
							<div class="text">命令数量</div>
							<div class="number count-to" data-from="0" data-to="<?php echo $com; ?>" data-speed="1000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-light-green hover-expand-effect">
						<div class="icon">
							<i class="material-icons">group</i>
						</div>
						<div class="content">
							<div class="text">用户数量</div>
							<div class="number count-to" data-from="0" data-to="<?php echo $mem; ?>" data-speed="1000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box bg-orange hover-expand-effect">
						<div class="icon">
							<i class="material-icons">apps</i>
						</div>
						<div class="content">
							<div class="text">程序版本</div>
							<div class="number"><?php echo APP_VERSION; ?></div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>用户信息</h2>
						</div>
						<div class="body">
							<label for="SEC">SEC</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" value="<?php echo $sec; ?>" class="form-control" id="SEC" disabled>
								</div>
							</div>
							<label for="PKT">PKT</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" value="<?php echo $pkt; ?>" class="form-control" id="SEC" disabled>
								</div>
							</div>
							<button class="btn btn-warning m-t-15 waves-effect" onclick="ResetSEC();">重置 SEC</button>
							<button class="btn btn-warning m-t-15 waves-effect" onclick="ResetPKT();">重置 PKT</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="/plugins/node-waves/waves.js"></script>
	<script src="/plugins/jquery-countto/jquery.countTo.js"></script>
	<script src="/plugins/raphael/raphael.min.js"></script>
	<script src="/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="/plugins/morrisjs/morris.js"></script>
	<script src="/js/admin.js"></script>
	<script src="/js/pages/index.js"></script>
	<script src="/js/demo.js"></script>
	<script>
		function ResetSEC() {
			swal({
				title: '你确定吗？',
				text: '这个操作将会重新分配一个新的 SEC',
				type: 'warning',
				showCancelButton: true,
				cancelButtonText: '取消',
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "确定",
				closeOnConfirm: false,
			}, function () {
				$.get('/Console/Keys/SEC');
				swal('已更新', '您的 SEC 已经更新', 'success');
				setTimeout(function () {
					location.reload(true);
				}, 3000);
			});
		}
		function ResetPKT() {
			swal({
				title: '你确定吗？',
				text: '这个操作将会重新分配一个新的 PKT',
				type: 'warning',
				showCancelButton: true,
				cancelButtonText: '取消',
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "确定",
				closeOnConfirm: false,
			}, function () {
				$.get('/Console/Keys/PKT');
				swal('已更新', '您的 PKT 已经更新', 'success');
				setTimeout(function () {
					location.reload(true);
				}, 3000);
			});
		}
	</script>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>