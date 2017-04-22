<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=4; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-baobiao"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						平台 [ <span class="text-color-red">合同</span> ] 统计报表，
						当前统计年份 [ <span class="text-color-red"><?php echo($year);?></span> ]
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
							数据汇总
						</div>
						<div class="report-box-body">
							<div class="pull-left databox">
								<span class="font-size-12">总合同数(件)</span><br />
								<span class="text-color-red font-size-28"><?php echo($count['all']);?></span> 
							</div>
							
							<div class="pull-left databox">
								<span class="font-size-12">本月新增(件)</span><br />
								<span class="text-color-red font-size-28"><?php echo($count['thismonth']);?></span>
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">今日新增(件)</span><br />
								<span class="text-color-red font-size-28"><?php echo($count['today']);?></span>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="height10"></div>
					<div class="report-box">
						<div class="report-box-head">
							<span class="pull-right chooice">
								按年份：
								<a <?php if($year==2016){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>contracts/report/2016">2016</a>
								<a <?php if($year==2017){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>contracts/report/2017">2017</a>
							</span>
							增长走势
						</div>
						<div class="report-box-body" style="height:260px;">
							<canvas id="c1" data-type="Line"></canvas>
						</div>
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>年月</th>
								<?php for($i=1;$i<=12;$i++){?>
									<th>
										<?php echo($year.'.'.$i);?>
									</th>
								<?php }?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>月新增合同(件)</td>
									<?php foreach($count['lineall'] as $cs){?>
										<td>
											<?php echo($cs);?>
										</td>
									<?php }?>
								</tr>
									
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/Chart.js/Chart.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var data = {
				    labels: [<?php for($i=1;$i<=12;$i++){echo($year.'.'.$i.',');}?>],
				    datasets: [{
				    	label: "月总合同量(件)",
				        borderWidth: 2,
				        borderColor:"rgba(255,0,0,0.5)",
				        backgroundColor:"rgba(255,0,0,0.02)",
				        data:<?php echo(json_encode($count['lineall']));?>
				    }]
				};
				var c1 = new Chart($("#c1"), {
				    type: 'line',
				    data: data,
				    options: {
				    	responsive: true,
				    	//onResize: ,
				    }
				});
			});
		</script>
		
	</body>
</html>
