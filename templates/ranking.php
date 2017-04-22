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
						<i class="iconfont icon-paiming"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						积分排名 TOP10
					</div>
					<div class="pull-left" style="padding-left:20px;">
						<span class="text-color-gray font-size-12">您当前的积分：<span class="text-color-red"><?php echo(get_integral($_COOKIE['staffID'],date('Ym')));?></span>，所在分公司排名：<span class="text-color-red"><?php print_r(get_integral_ranking($_COOKIE['staffID'],date('Ym')));?></span>
					</div>
					
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="report-box">
						<div class="report-box-head">
							<span class="pull-right chooice">
								按月份：
								<select name="month">
									<?php for($m=1;$m<=12;$m++){
										 $s = date('Y').str_pad($m,2,0,STR_PAD_LEFT);
										?>
									<option <?php if($thismonth == $s){echo('selected="selected"');}?> value="<?php echo($s);?>"><?php echo(date('Y'));?>-<?php echo(str_pad($m,2,0,STR_PAD_LEFT));?></option>
									<?php }?>
								</select>
							</span>
							月度员工积分排名 TOP10
						</div>
						<div class="report-box-body" style="height:460px;">
							<canvas id="c1" data-type="bar"></canvas>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/Chart.js/Chart.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var data = {
				    labels: [<?php 
				    	$i = 1; foreach($in as $a){
				        	echo('"第'.$i.'名：');
				        	echo($a['name'].'",');
				        	$i++;}
				    ?>],
				    datasets: [{
				    	label: "积分值",
				        borderWidth: 2,
				        borderColor:["rgba(255,0,0,0.9)","rgba(255,0,0,0.8)","rgba(255,0,0,0.7)","rgba(255,0,0,0.6)","rgba(255,0,0,0.5)","rgba(255,0,0,0.4)","rgba(255,0,0,0.3)","rgba(255,0,0,0.2)","rgba(255,0,0,0.1)","rgba(255,0,0,0.05)"],
				        backgroundColor:["rgba(255,0,0,0.8)","rgba(255,0,0,0.7)","rgba(255,0,0,0.6)","rgba(255,0,0,0.5)","rgba(255,0,0,0.4)","rgba(255,0,0,0.3)","rgba(255,0,0,0.2)","rgba(255,0,0,0.1)","rgba(255,0,0,0.05)","rgba(255,0,0,0.025)"],
				        data:[<?php 
				        	foreach($in as $a){
				        	echo($a['integral'].',');
				        	}
				        	?>]
				    }]
				};
				var c1 = new Chart($("#c1"), {
				    type: 'bar',
				    data: data,
				    options: {
				    	responsive: true,
				    }
				});

				$('select[name="month"]').change(function(){
					var m = $(this).val();
					window.location.href= "<?php echo($settings['renderer']['home_path']);?>ranking/"+m;
					return false;
				});
			});
		</script>
	</body>
</html>
