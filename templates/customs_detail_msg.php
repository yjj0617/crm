<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=1; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-kehu"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						客户 [ <span class="text-color-red"><?php echo($m['name']);?></span> ] 的详细资料
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						该客户于 [ <span class="text-color-red"><?php echo($m['creattime']);?></span> ] 
						成为平台用户，注册方式为 [ <span class="text-color-red"><?php if($m['from']==0){ echo('线下录入');}elseif($m['from']==1){echo('微信注册');}elseif($m['from']==2){echo('网站注册');}else{echo('其它方式');}?></span> ]
						<?php if($m['from']==0){echo('，由 [ <span class="text-color-red">'.$m['staffCompany'].' - '.$m['staffName']).' - '.$m['staffMobile'].'</span> ] 录入。';} ?>
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=2; require 'customs_detail_nav.php';?>
					</div>
					<div class="infobox">
						
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		<script type="text/javascript">
			//$(document).ready(function(){
				// $('.mycustoms').height($(window).height()-135);
				// $('.waitrun').height($(window).height()-597);
			//});
		</script>
		
	</body>
</html>
