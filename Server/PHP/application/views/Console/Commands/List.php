<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>命令列表 - <?php echo $sites['configs']->sitename; ?></title>
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
				<h2>命令列表</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>ACK</th>
										<th>命令类型</th>
										<th>状态</th>
										<th>下达时间</th>
										<th>管理</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($list as $v): ?><tr>
										<th scope="row"><?php echo $v['cid']; ?></th>
										<th><?php echo $v['ack']; ?></th>
										<th><?php foreach($sites['commands'] as $k => $s) { if($k == $v['act']) echo $s; } ?></th>
										<th><?php if($v['fin'] == '1') { echo '<span class="label label-success">已完成</span>'; } else { echo '<span class="label label-warning">等待中</span>'; } ?></th>
										<th><?php echo $v['tim']; ?></th>
										<th>
											<a href="/Console/Commands/Info/<?php echo $v['cid']; ?>" class="btn btn-info btn-xs">详情</a>
											<a href="/Console/Commands/Delete/<?php echo $v['cid']; ?>" class="btn btn-danger btn-xs" data-no-instant>删除</a>
										</th>
									</tr><?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('Console/Footer'); ?>
</body>
</html>