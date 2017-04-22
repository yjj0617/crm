<?php 
	require 'header.php';
?>
	<body >
	<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/clndr.css">
	<?php require 'head.php';?>
	<?php $modelNo = 7; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-fuwu5"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						物品列表
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
									<th width="80">ID</th>
									<th width="120">物品名称</th>
									<th width="80">物品库存</th>
									
									<th width="100">添加时间</th>
									<th width="100">操作</th>

								</tr>	
							</thead>
						</table>
						<div style="height:calc(100% - 56px);overflow:auto;">
						<table class="table" width="100%">
							<tbody>
							<?php if($list){ 
									foreach($list as $l){?>
								<tr>
									<td width="160"><?php echo($l['id']);?></td>
									<td width="245"><?php echo($l['name']);?></td>
									<td width="180"><?php echo($l['number']);?></td>
									
									<td width="180"><?php echo($l['wtime'])?></td>

									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/recadd/<?php echo $l['id'];?>" class="btn btn-link btn-gray view">申领</a>
									</td>
									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/additional/<?php echo $l['id'];?>" class="btn btn-link btn-gray view">入库</a>
									</td>
									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/wedit/<?php echo $l['id'];?>" class="btn btn-link btn-gray view">查看</a>
									</td>
									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/record/<?php echo $l['id'];?>" class="btn btn-link btn-gray view">记录</a>
									</td>													
									
								</tr>
							<?php }}else{
								if(empty($list)){
									foreach($goods as $b){?>
										<tr>
									<td width="160"><?php echo($b['id']);?></td>
									<td width="245"><?php echo($b['name']);?></td>
									<td width="180"><?php echo($b['number']);?></td>
									
									<td width="180"><?php echo($b['wtime'])?></td>
									
									<td width="50">
									<?php if($b['number']>0){?>
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/recadd/<?php echo $b['id'];?>" class="btn btn-link btn-gray view">申领</a>
									<?php }?>
									<?php if($b['number']==0){?>
										<a href="" class="btn btn-link btn-gray view">空</a>
									<?php }?>
									</td>
									
									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/additional/<?php echo $b['id'];?>" class="btn btn-link btn-gray view">入库</a>
									</td>
									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/wedit/<?php echo $b['id'];?>" class="btn btn-link btn-gray view">查看</a>
									</td>
									<td width="50">
										<a href="<?php echo($settings['renderer']['home_path']);?>executive/record/<?php echo $b['id'];?>" class="btn btn-link btn-gray view">记录</a>
									</td>													
									
								</tr>
								
								<?php }}}?>
							</tbody>
						</table>
						</div>
					</div>
					<div class="qk-cal">
						<div class="text-center" style="height:60px">
							<a href="<?php echo($settings['renderer']['home_path']);?>executive/addietms"  class="btn btn-big btn-red btn-w100">					
						<i class="iconfont icon-baochi"></i> 新物品入库					
							</a>
						</div>
							<div class="text-center" style="height:60px">
							<a href="<?php echo($settings['renderer']['home_path']);?>executive/applyedit"  class="btn btn-big btn-red btn-w100">					
						<i class="iconfont icon-baochi"></i> 查看申领列表					
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
			                window.location.href = "<?php echo($settings['renderer']['home_path']);?>executive/apply/"+thisday.getFullYear() + "/" + (thisday.getMonth()+1) + "/" + thisday.getDate();
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
