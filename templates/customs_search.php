<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=3; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-sousuo"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						搜索客户
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
				</div>
				<div class="box-body">
					<div class="form">
						<form id="search" method="post" action="<?php echo($settings['renderer']['home_path']);?>customs/search">
						<div class="form-item">
							<label class="form-filed-name">客户姓名或手机号</label>
							<div class="form-filed-box">
								<input type="text" name="key" class="input input-default input-w250" required="required" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入客户姓名或者手机号码。</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">&nbsp;</label>
							<div class="form-filed-msg no-text-indent text-color-gray" style="max-width:80%"><i class="iconfont icon-gantanhao text-color-red"></i> 注意，您仅能搜索您权限范围[ <span class="text-color-green"><?php echo($u['authoritySubc']);?></span> ]内的客户。如需搜索其它客户，请先获取授权。</div>
							<div class="clearfix"></div>
						</div>
						<!-- <div class="form-item">
							<label class="form-filed-name">客户所在地</label>
							<div class="form-filed-box" id="locaA">
								<select name="prov" class="input input-default"><option value="" code="">不限</option></select> -
                                <select name="city" class="input input-default"><option value=""  code="">不限</option></select> -
                                <select name="area" class="input input-default"><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入客户所在地省市区。</div>
							<div class="clearfix"></div>
						</div> -->
						<div class="form-item form-item-btn">
							<button type="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-sousuo"></i> 搜索</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		<script type="text/javascript">
			//pca('#locaA','','','');
		</script>
		
	</body>
</html>
