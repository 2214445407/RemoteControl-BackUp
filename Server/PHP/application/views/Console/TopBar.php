<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><nav class="navbar">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
				<a href="javascript:void(0);" class="bars"></a>
				<a class="navbar-brand" href="Index"><?php echo $sites['configs']->sitename; ?></a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="javascript:void(0);" class="js-search" data-close="true">
							<i class="material-icons">search</i>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);" class="js-right-sidebar" data-close="true">
							<i class="material-icons">palette</i>
						</a>
					</li>
					<li class="pull-right">
						<a href="/Console/Logout" data-no-instant>
							<i class="material-icons">input</i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>