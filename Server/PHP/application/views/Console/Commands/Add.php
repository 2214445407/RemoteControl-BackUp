<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>下达命令 - <?php echo $ack; ?> - <?php echo $sites['configs']->sitename; ?></title>
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
				<h2>下达命令</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body">
							<div class="alert alert-warning"><b>警告！</b>您正在向 <?php echo $ack; ?> 下达命令</div>
							<form action="/Console/Commands/Add/<?php echo $ack; ?>" method="POST">
								<label for="ACT"></label>
								<div class="form-group">
									<div class="form-line">
										<select id="ACT" class="form-control" name="act">
											<?php foreach($sites['commands'] as $k => $s): ?><option value="<?php echo $k; ?>"><?php echo $s; ?></option><?php endforeach; ?>
										</select>
									</div>
								</div>
								<label for="TEX"></label>
								<div class="form-group">
									<div class="form-line">
										<textarea id="TEX" class="form-control" name="tex" placeholder="命令内容" rows="10"></textarea>
									</div>
								</div>
								<button type="submit" class="btn btn-default">下达命令</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>