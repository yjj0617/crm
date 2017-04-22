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
						搜索商机
					</div>
					<div class="pull-right">
						<!--  -->
					</div>
				</div>
				<div class="box-body">
					<div class="form">
						<form id="search" method="post" action="<?php echo($settings['renderer']['home_path']);?>opportunity/search">
						<div class="form-item">
							<label class="form-filed-name">商机关键词</label>
							<div class="form-filed-box">
								<input type="text" name="key" class="input input-default input-w250" required="required" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入关键词。</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">&nbsp;</label>
							<div class="form-filed-msg no-text-indent text-color-gray" style="max-width:80%"><i class="iconfont icon-gantanhao text-color-red"></i> 注意，关键词可以是商机内容、渠道名称、客户手机号码、来源姓名或者手机号码。</div>
							<div class="clearfix"></div>
						</div>
						
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
