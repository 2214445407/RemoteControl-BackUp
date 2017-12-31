<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '../config.inc.php';
?><section>
		<aside id="leftsidebar" class="sidebar">
			<div class="user-info">
				<div class="image">
					<img src="/images/user.png" width="48" height="48" alt="User" />
				</div>
				<div class="info-container">
					<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('userinfo')['usr']; ?></div>
					<div class="email"><?php echo $this->session->userdata('userinfo')['ema']; ?></div>
					<div class="btn-group user-helper-dropdown">
						<i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
						<ul class="dropdown-menu pull-right">
							<li><a href="/Console/Profile"><i class="material-icons">person</i>我的资料</a></li>
							<li role="seperator" class="divider"></li>
							<li><a href="/Console/Logout" data-no-instant><i class="material-icons">input</i>登出</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="menu">
				<ul class="list">
					<li>
						<a href="/Console/Index">
							<i class="material-icons">home</i>
							<span>仪表盘</span>
						</a>
					</li>
					<li>
						<a href="/Console/Devices/List">
							<i class="material-icons">desktop_windows</i>
							<span>设备列表</span>
						</a>
					</li>
					<li>
						<a href="/Console/Commands/List">
							<i class="material-icons">near_me</i>
							<span>命令列表</span>
						</a>
					</li>
					<?php if($this->Request->isAdmin()): ?><li>
						<a href="/Console/Users/List">
							<i class="material-icons">group</i>
							<span>用户列表</span>
						</a>
					</li>
					<li>
						<a href="/Console/Configs">
							<i class="material-icons">settings</i>
							<span>系统设置</span>
						</a>
					</li>
					<li>
						<a href="/Console/SystemPurge" data-no-instant>
							<i class="material-icons">delete_sweep</i>
							<span>系统清理</span>
						</a>
					</li>
					<!--<li>
						<a href="/Console/Update">
							<i class="material-icons">system_update</i>
							<span>系统更新</span>
						</a>
					</li>--><?php endif; ?>
				</ul>
			</div>
			<div class="legal">
				<div class="copyright">
					<?php echo $sites['configs']->copyrights; ?>
				</div>
				<div class="version">
					<b>Version: </b> <?php echo APP_VERSION; ?>
				</div>
			</div>
		</aside>
		<aside id="rightsidebar" class="right-sidebar">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active in active" id="skins">
					<ul class="demo-choose-skin">
						<li data-theme="red" class="active">
							<div class="red"></div>
							<span>红色</span>
						</li>
						<li data-theme="pink">
							<div class="pink"></div>
							<span>粉色</span>
						</li>
						<li data-theme="purple">
							<div class="purple"></div>
							<span>紫色</span>
						</li>
						<li data-theme="deep-purple">
							<div class="deep-purple"></div>
							<span>深紫色</span>
						</li>
						<li data-theme="indigo">
							<div class="indigo"></div>
							<span>靛蓝</span>
						</li>
						<li data-theme="blue">
							<div class="blue"></div>
							<span>蓝色</span>
						</li>
						<li data-theme="light-blue">
							<div class="light-blue"></div>
							<span>浅蓝色</span>
						</li>
						<li data-theme="cyan">
							<div class="cyan"></div>
							<span>青色</span>
						</li>
						<li data-theme="teal">
							<div class="teal"></div>
							<span>蓝绿色</span>
						</li>
						<li data-theme="green">
							<div class="green"></div>
							<span>绿色</span>
						</li>
						<li data-theme="light-green">
							<div class="light-green"></div>
							<span>浅绿色</span>
						</li>
						<li data-theme="lime">
							<div class="lime"></div>
							<span>橙色</span>
						</li>
						<li data-theme="yellow">
							<div class="yellow"></div>
							<span>黄色</span>
						</li>
						<li data-theme="amber">
							<div class="amber"></div>
							<span>黄褐色</span>
						</li>
						<li data-theme="orange">
							<div class="orange"></div>
							<span>橙色</span>
						</li>
						<li data-theme="deep-orange">
							<div class="deep-orange"></div>
							<span>深橙色</span>
						</li>
						<li data-theme="brown">
							<div class="brown"></div>
							<span>褐色</span>
						</li>
						<li data-theme="grey">
							<div class="grey"></div>
							<span>灰色</span>
						</li>
						<li data-theme="blue-grey">
							<div class="blue-grey"></div>
							<span>蓝灰色</span>
						</li>
						<li data-theme="black">
							<div class="black"></div>
							<span>黑色</span>
						</li>
					</ul>
				</div>
			</div>
		</aside>
	</section>