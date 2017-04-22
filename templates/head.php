<header>
	<div class="pull-left logo text-center">
		<span><i class="iconfont icon-ss" style="font-size:48px;color:#fff;"></i></span>
	</div>
	<div class="pull-left">
		<div class="pull-left apps <?php if($path=='/'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>"><i class="iconfont icon-gongzuotai-copy"></i> 工作台</a>
		</div>
		<div class="pull-left apps <?php if($path=='/customs'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>customs"><i class="iconfont icon-kehu"></i> 客户</a>
		</div>
		<div class="pull-left apps <?php if($path=='/companies'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>companies"><i class="iconfont icon-qiye"></i> 企业</a>
		</div>
		<div class="pull-left apps <?php if($path=='/contracts'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>contracts"><i class="iconfont icon-hetong"></i> 合同</a>
		</div>
		<div class="pull-left apps <?php if($path=='/opportunity'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>opportunity"><i class="iconfont icon-shangjibaobeiffcc"></i> 商机</a>
		</div>
		<div class="pull-left apps <?php if($path=='/hr'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>hr"><i class="iconfont icon-icon-users-bold"></i> 人事</a>
		</div>
		<div class="pull-left apps <?php if($path=='/executive'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>executive"><i class="iconfont icon-xingzhengguanli-copy"></i> 行政</a>
		</div>
		
		<div class="pull-left apps <?php if($path=='/finance'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>finance"><i class="iconfont icon-caiwu"></i> 财务</a>
		</div>
		<div class="pull-left apps <?php if($path=='/complain'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>complain"><i class="iconfont icon-tousu"></i> 投诉</a>
		</div>
		
		<div class="pull-left apps <?php if($path=='/operate'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>operate"><i class="iconfont icon-yunying"></i> 消息</a>
		</div>
		
		<div class="pull-left apps <?php if($path=='/performance'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>performance"><i class="iconfont icon-jixiaoguanli01"></i> 绩效</a>
		</div>
		<div class="pull-left apps <?php if($path=='/report'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>report"><i class="iconfont icon-baobiao"></i> 报表</a>
		</div>
		
		<div class="pull-left apps <?php if($path=='/cms'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>cms"><i class="iconfont icon-wangzhan"></i> CMS</a>
		</div>
		<div class="pull-left apps <?php if($path=='/setting'){echo('active');}?>">
			<a href="<?php echo($settings['renderer']['home_path']);?>setting"><i class="iconfont icon-shezhishedingpeizhichilun"></i> 设定</a>
		</div>
		
	</div>
	<div class="pull-right apps">
		<a href="<?php echo($settings['renderer']['home_path']);?>logout"><i class="iconfont icon-tuichu"></i></a>
	</div>
</header>