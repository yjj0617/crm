<?php 
	require 'header.php';
?>
	<body >
	<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/clndr.css">
	<?php require 'head.php';?>
	<?php $modelNo = 5; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-fuwu5"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						查看具体信息
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="qklist">
					<form id="mform" method="post" action="<?php echo($settings['renderer']['home_path']);?>executive/linsert" onsubmit="return demo()" name="reg_testdate">
						<div class="form-item">
							<label class="form-filed-name">姓名</label>
							<div class="form-filed-box">
									<?php echo($leave['name'])?>	
							</div>
							<div class="form-filed-msg text-color-gray"><i id="ss"></i> </div>
							<div class="clearfix"></div>
														
							
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">联系方式</label>
							<div class="form-filed-box">
								<?php echo($mode['mobile'])?>
							</div>
							<div class="form-filed-msg text-color-gray"><i id="mm"></i> </div>
							<div class="clearfix"></div>							
							
						</div> 
						<div class="form-item">
							<label class="form-filed-name">所在部门</label>
							<div class="form-filed-box">
									<?php echo($sub['subcompanyname'])?>-<?php echo($b['departmentname'])?>-<?php echo($red['positionname'])?>
							</div>
							<div class="form-filed-msg text-color-gray"><i id="ss"></i> </div>
							<div class="clearfix"></div>	
						</div>                      
						<div class="form-item">
							<label class="form-filed-name">类型</label>
							<div class="form-filed-box">
								<?php echo($leave['content'])?>
							</div>
							<div class="form-filed-msg text-color-gray"><i id="sh"></i> </div>
							<div class="clearfix"></div>														
						</div>										
						<div class="form-item">
							<label class="form-filed-name">开始时间</label>
							
							   <?php echo($leave['ontime'])?>
						</div>
						<div class="form-item">
							<label class="form-filed-name">结束时间</label>
							
							   <?php echo($leave['offtime'])?>
						</div>
						<div class="form-item">
							<label class="form-filed-name">提交时间时间</label>
							
							   <?php echo($leave['stime'])?>
						</div>
						<div class="form-item">
							<label class="form-filed-name">审核人</label>
							
							   <?php echo($leave['check'])?>
						</div>
						<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="remarks" class="input input-default" style="width:400px;height:100px;" ><?php echo($leave['remarks'])?></textarea>
							</div>
							
						</div>	

					
						</form>
					
					</div>
					
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/underscore-min.js"></script>
    	<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/moment-with-locales.min.js"></script>
    	<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/clndr.js"></script>
		<script type="text/javascript">
			//日期联动
			
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
			                window.location.href = "<?php echo($settings['renderer']['home_path']);?>executive/minelog/"+thisday.getFullYear() + "/" + (thisday.getMonth()+1) + "/" + thisday.getDate();
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
