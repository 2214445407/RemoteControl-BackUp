<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>跳转提示</title>
	<style type="text/css">
		*{ padding: 0; margin: 0; }
		body{ background: #fff; font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif; color: #333; font-size: 16px; }
		.system-message{ padding: 24px 48px; }
		.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
		.system-message .jump{ padding-top: 10px; }
		.system-message .jump a{ color: #333; }
		.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px; }
		.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display: none; }
	</style>
</head>
<body>
	<div class="system-message">
        <?php if($code == 0) echo '<h1>:(</h1><p class="error">' . $msg . '</p>'; ?>
        <?php if($code == 1) echo '<h1>:)</h1><p class="success">' . $msg . '</p>'; ?>
		<p class="detail"></p>
		<p class="jump">
			页面自动 <a id="href" href="<?php if($url != 'last') { echo $url; } else { echo '#'; } ?>" onclick="<?php if($url == 'last') { echo 'history.go(-1);'; } ?>">跳转</a> 等待时间： <b id="wait">3</b>
		</p>
	</div>
	<script type="text/javascript">
		(function(){
			var wait = document.getElementById('wait'),
				href = document.getElementById('href').href;
			if('<?php echo $url; ?>' == 'last') {
				var interval = setInterval(function(){
					var time = --wait.innerHTML;
					if(time <= 0) {
						history.go(-1);
						clearInterval(interval);
					};
				}, 1000);
			} else {
				var interval = setInterval(function(){
					var time = --wait.innerHTML;
					if(time <= 0) {
						location.href = href;
						clearInterval(interval);
					};
				}, 1000);
			}
		})();
	</script>
</body>
</html>
