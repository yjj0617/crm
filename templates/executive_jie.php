<?php 
	require 'header.php';
?>
	<body >
	<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/clndr.css">
	<?php require 'head.php';?>
	<?php $modelNo = 6; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-fuwu5"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						节日福利
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="qklist">
						<table class="table" width="100%">
							<thead>
								<tr>
									<th width="90">ID</th>
									<th width="150">节日名称</th>
									<th width="180">节日时间</th>
									<th width="180">发放物品</th>
									<th width="180">状态</th>
									<th width="180">操作</th>
								</tr>	
							</thead>
						</table>
						<div style="height:calc(100% - 56px);overflow:auto;">
						<table class="table" width="100%">
							<tbody>
							<?php if($list){ 
									foreach($list as $l){?>
								<tr>
									<td width="90"><?php echo($l['id']);?></td>
									<td width="150"><?php echo($l['jname']);?></td>
									<td width="180"><?php echo($l['jtime']);?></td>
									<td width="150"><?php echo($l['wname']);?></td>
									
									<td width="180">
										<?php if($l['statu']==0){?>
											<span class="btn btn-link btn-red">未发放</span>
											<?php }?>
											<?php if($l['statu']==1||$l['statu']==2){?>
											<span class="btn btn-link btn-green">发放中...</span>
											<?php }?>
									</td>									
									<td width="180">
										<?php if($l['statu']==0){?>
											<a href="<?php echo($settings['renderer']['home_path']);?>executive/grant/<?php echo $l['id'];?>" class="btn btn-link btn-red view">发放</a>
										<?php }?>
										<?php if($l['statu']==1){?>
																					
											<a href="<?php echo($settings['renderer']['home_path']);?>executive/receive/<?php echo $l['id'];?>" class="btn btn-link btn-red view" id="aid">领取</a>									
											<a href="<?php echo($settings['renderer']['home_path']);?>executive/jledit/<?php echo $l['id'];?>" class="btn btn-link btn-red view">查看记录</a>
										<?php }?>
										
									</td>																																			
								</tr>
							<?php }}else{ 
									if($welfare!=0){
										foreach($welfare as $l){?>
								<tr>
									<td width="90"><?php echo($l['id']);?></td>
									<td width="150"><?php echo($l['jname']);?></td>
									<td width="180"><?php echo($l['jtime']);?></td>
									<td width="150"><?php echo($l['wname']);?></td>
									
									<td width="180">
											<?php if($l['statu']==0){?>
												<span class="btn btn-link btn-red">未发放</span>
											<?php }?>
											<?php if($l['statu']==1||$l['statu']==2){?>
												<span class="btn btn-link btn-green">发放中...</span>
											<?php }?>
									</td>
									<td width="180">
										<?php if($l['statu']==0){?>
											<a href="<?php echo($settings['renderer']['home_path']);?>executive/grant/<?php echo $l['id'];?>" class="btn btn-link btn-red view">发放</a>
										<?php }?>
										<?php if($l['statu']==1){?>	
											<a href="<?php echo($settings['renderer']['home_path']);?>executive/receive/<?php echo $l['id'];?>" class="btn btn-link btn-red view" id="aid">领取</a>
											<a href="<?php echo($settings['renderer']['home_path']);?>executive/jledit/<?php echo $l['id'];?>" class="btn btn-link btn-red view">查看记录</a>
										<?php }?>

									</td>																																			
								</tr>
							<?php }}}?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="qk-cal">
						<div class="text-center" style="height:60px">
							<a href="<?php echo($settings['renderer']['home_path']);?>executive/jieadd"  class="btn btn-big btn-red btn-w100">					
						<i class="iconfont icon-baochi"></i> 节日添加				
							</a>
						</div>
						<div class="text-center font-size-12 text-color-red">请选择您在查询的日期</div>
						<div class="height20"></div>
						<div class="cal1"></div>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/underscore-min.js"></script>
    	<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/moment-with-locales.min.js"></script>
    	<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/clndr.js"></script>
		<script type="text/javascript">
		
			var calendars = {};
			$(document).ready( function() {
				
			    var thisMonth = moment().format('YYYY-MM');
			    moment.locale('zh-cn'); 
			    
			    var eventArray = [
			        {
			            date: '<?php echo($thisyear);?>-<?php echo($thismonth);?>-<?php echo($thisday);?>',
			            title: '被选择'
			        }
			    ];

			    calendars.clndr1 = $('.cal1').clndr({
			        events: eventArray,
			        startWithMonth: moment(),
			        daysOfTheWeek: ['日', '一', '二', '三', '四', '五', '六'],
			        clickEvents: {
			            click: function (target) {
			                var thisday = new Date(target.date._i);
			                console.log(thisday.getFullYear());
			                window.location.href = "<?php echo($settings['renderer']['home_path']);?>executive/welfare/"+thisday.getFullYear() + "/" + (thisday.getMonth()+1) + "/" + thisday.getDate();
			            },
			            today: function () {
			                console.log('Cal-1 today');
			            },
			            nextMonth: function () {
			                console.log('Cal-1 next month');
			            },
			            previousMonth: function () {
			                console.log('Cal-1 previous month');
			            },
			            onMonthChange: function () {
			                console.log('Cal-1 month changed');
			            },
			            nextYear: function () {
			                console.log('Cal-1 next year');
			            },
			            previousYear: function () {
			                console.log('Cal-1 previous year');
			            },
			            onYearChange: function () {
			                console.log('Cal-1 year changed');
			            },
			            nextInterval: function () {
			                console.log('Cal-1 next interval');
			            },
			            previousInterval: function () {
			                console.log('Cal-1 previous interval');
			            },
			            onIntervalChange: function () {
			                console.log('Cal-1 interval changed');
			            }
			        },
			        multiDayEvents: {
			            singleDay: 'date',
			            endDate: 'endDate',
			            startDate: 'startDate'
			        },
			        showAdjacentMonths: true,
			        adjacentDaysChangeMonth: true
			    });

			    // Bind all clndrs to the left and right arrow keys
			    $(document).keydown( function(e) {
			        // Left arrow
			        if (e.keyCode == 37) {
			            calendars.clndr1.back();
			        }

			        // Right arrow
			        if (e.keyCode == 39) {
			            calendars.clndr1.forward();
			        }
			    });
			});
		</script>
	</body>
</html>
