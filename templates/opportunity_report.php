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
						平台 [ <span class="text-color-red">商机</span> ] 统计报表，
						当前统计年份 [ <span class="text-color-red"><?php echo($year);?></span> ]
					</div>
					<div class="pull-right">
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
								<span class="font-size-12">总商机数(条)</span><br />
								<span class="text-color-blue font-size-28"><?php echo($count['all']);?></span> 
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">待处理数(条)</span><br />
								<span class="text-color-red font-size-28"><?php echo($count['wait']);?></span> 
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">可跟进机(条)</span><br />
								<span class="text-color-blue font-size-28"><?php echo($count['cannext']);?></span> 
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">已成交数(条)</span><br />
								<span class="text-color-green font-size-28"><?php echo($count['ok']);?></span>
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">无效商机(条)</span><br />
								<span class="text-color-gray font-size-28"><?php echo($count['close']);?></span>
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">本月新增(条)</span><br />
								<span class="text-color-red font-size-28"><?php echo($count['thismonth']);?></span>
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">今日新增(条)</span><br />
								<span class="text-color-red font-size-28"><?php echo($count['today']);?></span>
							</div>
							<div class="pull-left databox">
								<span class="font-size-12">今日成交(条)</span><br />
								<span class="text-color-green font-size-28"><?php echo($count['todayok']);?></span>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="height10"></div>
					<div class="report-box">
						<div class="report-box-head">
							<span class="pull-right chooice">
								按年份：
								<a <?php if($year==2016){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2016">2016</a>
								<a <?php if($year==2017){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2017">2017</a>
								<a <?php if($year==2018){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2018">2018</a>
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
									<td>月总商机量(条)</td>
									<?php foreach($count['lineall'] as $cs){?>
										<td>
											<?php echo($cs);?>
										</td>
									<?php }?>
								</tr>
								<tr>
									<td>成交量(条)</td>
									<?php foreach($count['lineok'] as $cs){?>
										<td>
											<?php echo($cs);?>
										</td>
									<?php }?>
								</tr>
									
							</tbody>
						</table>
					</div>
					<div class="height10"></div>
					<div class="report-box half pull-left right-border-line">
						<div class="report-box-head">
							<span class="pull-right chooice">
								按年份：
								<a <?php if($year==2016){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2016">2016</a>
								<a <?php if($year==2017){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2017">2017</a>
								<a <?php if($year==2018){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2018">2018</a>
							</span>
							热点分布 TOP10
						</div>
						<div class="report-box-body" style="height:360px;">
							<canvas id="d1" data-type="Line"></canvas>
						</div>
						
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>排名</th>
								<?php for($i=1;$i<=10;$i++){?>
									<th>
										<?php echo($i);?>
									</th>
								<?php }?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>地区</td>
									<?php foreach($count['dq_all'] as $cs){?>
										<td>
											<?php echo($cs['city']);?>
										</td>
									<?php }?>
								</tr>
								<tr>
									<td>商机数</td>
									<?php foreach($count['dq_all'] as $cs){?>
										<td>
											<?php echo($cs['count']);?>
										</td>
									<?php }?>
								</tr>
									
							</tbody>
						</table>
					</div>
					<div class="report-box half pull-right">
						<div class="report-box-head">
							<span class="pull-right chooice">
								按年份：
								<a <?php if($year==2016){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2016">2016</a>
								<a <?php if($year==2017){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2017">2017</a>
								<a <?php if($year==2018){echo('class="text-color-red"');}?> href="<?php echo($settings['renderer']['home_path']);?>opportunity/report/2018">2018</a>
							</span>
							成交分布 TOP10
						</div>
						<div class="report-box-body" style="height:360px;">
							<canvas id="d2" data-type="Line"></canvas>
						</div>
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>排名</th>
								<?php for($i=1;$i<=10;$i++){?>
									<th>
										<?php echo($i);?>
									</th>
								<?php }?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>地区</td>
									<?php foreach($count['dq_ok'] as $cs){?>
										<td>
											<?php echo($cs['city']);?>
										</td>
									<?php }?>
								</tr>
								<tr>
									<td>成交量</td>
									<?php foreach($count['dq_ok'] as $cs){?>
										<td>
											<?php echo($cs['count']);?>
										</td>
									<?php }?>
								</tr>
									
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
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
				    	label: "月总商机量(条)",
				        borderWidth: 2,
				        borderColor:"rgba(255,0,0,0.5)",
				        backgroundColor:"rgba(255,0,0,0.02)",
				        data:<?php echo(json_encode($count['lineall']));?>
				    },{
				    	label: "成交量(条)",
				        borderWidth: 2,
				        borderColor:"rgba(255,132,0,0.5)",
				        backgroundColor:"rgba(255,132,0,0.02)",
				        data:<?php echo(json_encode($count['lineok']));?>
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

				var data2 = {
				    labels: [
				        <?php foreach($count['dq_all'] as $cs){echo('"'.$cs['city'].'",');}?>
				    ],
				    datasets: [
				        {
				            data: [<?php foreach($count['dq_all'] as $cs){echo($cs['count'].',');}?>],
				            backgroundColor: [
				                "#eaac30",
				                "#ee7e37",
				                "#d76051",
				                "#8ab31c",
				                "#49a2ac",
				                "#3a84b0",
				                "#844b89",
				                "#bb5179",
				                "#36A2EB",
				                "#FFCE56"
				            ],
				            hoverBackgroundColor: [
				                "#FF6384",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#FFCE56"
				            ]
				        }]
				};

				var d1 = new Chart($("#d1"), {
				    type: 'doughnut',
				    data: data2,
				    options: {
				    	responsive: true,
				    	animation:{
				            animateScale:true
				        }
				    	//onResize: ,
				    }
				});

				var data3 = {
				    labels: [
				        <?php foreach($count['dq_ok'] as $cs){echo('"'.$cs['city'].'",');}?>
				    ],
				    datasets: [
				        {
				            data: [<?php foreach($count['dq_ok'] as $cs){echo($cs['count'].',');}?>],
				            backgroundColor: [
				                "#eaac30",
				                "#ee7e37",
				                "#d76051",
				                "#8ab31c",
				                "#49a2ac",
				                "#3a84b0",
				                "#844b89",
				                "#bb5179",
				                "#36A2EB",
				                "#FFCE56"
				            ],
				            hoverBackgroundColor: [
				                "#FF6384",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#36A2EB",
				                "#FFCE56"
				            ]
				        }]
				};

				var d2 = new Chart($("#d2"), {
				    type: 'doughnut',
				    data: data3,
				    options: {
				    	responsive: true,
				    	animation:{
				            animateScale:true
				        }
				    	//onResize: ,
				    }
				});
			});
		</script>
		
	</body>
</html>
