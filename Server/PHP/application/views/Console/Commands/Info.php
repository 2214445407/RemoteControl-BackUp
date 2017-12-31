<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>命令详情 - <?php echo $cid; ?> - <?php echo $sites['configs']->sitename; ?></title>
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
				<h2>命令详情</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body">
							<label for="ACT">命令类型</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="ACT" class="form-control" value="<?php echo $act; ?>" disabled>
								</div>
							</div>
							<label for="TEX">命令内容</label>
							<div class="form-group">
								<div class="form-line">
									<textarea id="TEX" class="form-control" rows="10" disabled><?php echo @base64_decode($tex); ?></textarea>
								</div>
							</div>
							<label for="RES">命令结果</label>
							<div class="form-group">
								<div class="form-line">
									<textarea id="RES" class="form-control" rows="10" disabled><?php echo @base64_decode($res); ?></textarea>
								</div>
							</div>
							<label for="TIM">下达时间</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="TIM" class="form-control" value="<?php echo $tim; ?>" disabled>
								</div>
							</div>
							<a href="/Console/Commands/Delete/<?php echo $cid; ?>" class="btn btn-danger" data-no-instant>删除命令</a>
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