<?php 
	require 'header.php';
?>
	<body >
	<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/clndr.css">
	<?php require 'head.php';?>
	<?php $modelNo = 4; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-fuwu5"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						员工外勤记录
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
									<th width="150">员工姓名</th>
									<th width="180">事务内容</th>
									<th width="100">开始时间</th>									
									<th width="100">提交时间</th>					
									<th width="100">操作</th>
									
								</tr>	
							</thead>
						</table>
						<div style="height:calc(100% - 56px);overflow:auto;">
						<table class="table" width="100%">
							<tbody>
							<?php if($list){ 
									foreach($list as $a){?>
								<tr>
									<td width="90"><?php echo($a['id']);?></td>
									<td width="150"><?php echo($a['name']);?></td>
									<td width="180"><?php echo($a['shiwu'])?></td>									
									<td width="100">
										<?php echo($a['time']);?>										
									</td>
									<td width="100">
										<?php echo($a['resd']);?>										
									</td>
									<td width="100">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/detail/<?php echo $a['id'];?>" class="btn btn-link btn-gray view">查看</a>																											</td>																		
									
								</tr>
							<?php }}else{ 
									if($c!=0){
										foreach($c as $l){?>
								<tr>
									<td width="90"><?php echo($l['id']);?></td>
									<td width="150"><?php echo($l['name']);?></td>
									<td width="180"><?php echo($l['shiwu'])?></td>
									
									<td width="100">
										<?php echo($l['ortime']);?>
										
									</td>
									<td width="100">
										<?php echo($l['resd']);?>										
									</td>
									<td width="100">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/detail/<?php echo $l['id'];?>" class="btn btn-link btn-gray view">查看</a>																											</td>																		
									
								</tr>
							<?php }}}?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="qk-cal">
						<div class="text-center" style="height:60px">
							<a href="<?php echo($settings['renderer']['home_path']);?>executive/add"  class="btn btn-big btn-red btn-w100">					
						<i class="iconfont icon-baochi"></i> 我要出外勤					
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
			                window.location.href = "<?php echo($settings['renderer']['home_path']);?>executive/mine/"+thisday.getFullYear() + "/" + (thisday.getMonth()+1) + "/" + thisday.getDate();
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
