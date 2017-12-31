<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>系统设置 - <?php echo $sites['configs']->sitename; ?></title>
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
				<h2>系统设置</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<form class="body" action="/Console/Configs" method="POST">
							<label>站点名称</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="sin" class="form-control" value="<?php echo $sites['configs']->sitename; ?>">
								</div>
							</div>
							<label>版权信息</label>
							<div class="form-group">
								<div class="form-line">
									<textarea name="cpr" class="form-control" rows="4"><?php echo $sites['configs']->copyrights; ?></textarea>
								</div>
							</div>
							<label>站点维护</label>
							<div class="form-group switch">
								<label>
									OFF
									<input type="checkbox" name="wwh" <?php if($sites['configs']->maintain == 'on') { echo 'checked'; } ?>>
									<span class="lever"></span>
									ON
								</label>
							</div>
							<label>开放注册</label>
							<div class="form-group switch">
								<label>
									OFF
									<input type="checkbox" name="reg" <?php if($sites['configs']->register == 'on') { echo 'checked'; } ?>>
									<span class="lever"></span>
									ON
								</label>
							</div>
							<button type="submit" class="btn btn-primary">保存设置</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>