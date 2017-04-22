<?php 
	require 'header.php';
?>
	<body >
	<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/clndr.css">
	<?php require 'head.php';?>
	<?php $modelNo = 3; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-fuwu5"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						员工考勤记录
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
									<th width="90">员工ID</th>
									<th width="150">员工姓名</th>
									<th width="180">工作日</th>
									<th width="100">时长(h)</th>
									<th>打卡记录</th>
									<th width="80">工作日报</th>
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
									<td width="150"><?php echo($l['name']);?></td>
									<td width="180"><?php echo($l['workday']);?></td>
									<td width="100">
										<?php if(count($l['worktime']) == 2){
											$t1 = strtotime($l['worktime'][0]['worktime']);
											$t2 = strtotime($l['worktime'][1]['worktime']);
											$h = round(($t2 - $t1) / 3600,1);
											echo($h);
										}?> 
									</td>
									<td>
										<?php foreach($l['worktime'] as $wt){
											echo($wt['worktime']);
											echo(' [ IP：');
											echo($wt['ip']).' ]<br />';
										}?>
										
									</td>
									<td width="80">
										<?php if($l['hasdaily']){?>
										<a data-href="<?php echo($settings['renderer']['home_path']);?>executive/daily/detail/<?php echo($l['id']);?>/<?php echo($l['workday']);?>" data-title='<?php echo($l['name']);?>的日报：<?php echo($l['workday']);?>' class="btn btn-link btn-oranage showdaily">日报</a>
										<?php }else{
											echo('-');
										} ?>
									</td>
								</tr>
							<?php }} ?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="qk-cal">
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
    		$('.showdaily').click(function(){
    			var uri = $(this).attr('data-href');
    			var title = $(this).attr('data-title');
    			var dbox = layer.open({
					  	type: 2,
					  	title: title,
					  	area: ['860px', '480px'],
					  	content:  [uri, 'yes'],
					  	cancel:function(){
							//return false;
						}
					});
    		});
    	</script>
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
			        daysOfTheWeek: [ '一', '二', '三', '四', '五', '六','日'],
			        clickEvents: {
			            click: function (target) {
			                var thisday = new Date(target.date._i);
			                console.log(thisday.getFullYear());
			                window.location.href = "<?php echo($settings['renderer']['home_path']);?>executive/worktime/"+thisday.getFullYear() + "/" + (thisday.getMonth()+1) + "/" + thisday.getDate();
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
