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
						外勤详细信息
					</div>
					<div class="pull-left" style="padding-left:10px;">
						
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="qklist">
					<form id="mform" method="post" action="<?php echo($settings['renderer']['home_path']);?>executive/update">
						<div class="form-item">
							<label class="form-filed-name">姓名</label>
							<div class="form-filed-box">
								<?php if(isset($mode) && $mode!=''){echo($mode['name']);}?>
							</div>							
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">联系方式</label>
							<div class="form-filed-box">
								<?php if(isset($mode) && $mode!=''){echo($mode['mobile']);}?>
							</div>							
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">所在部门</label>
							<div class="form-filed-box">
									<?php if(isset($mode) && $mode!=''){echo($mode['departmentname']);}?>	
							</div>
							<div class="form-filed-msg text-color-gray"><i id="ss"></i> </div>
							<div class="clearfix"></div>
														
							
						</div> 
                        
						<div class="form-item">
							<label class="form-filed-name">外勤类型</label>
							<div class="form-filed-box">
								<select name="shiwu">
									<option value="<?php echo($mode['shiwu']);?>">--<?php echo($mode['shiwu']);?>--</option>				
									<?php if($type){
										foreach ($type as $c) 
												{ if($c['pid']==0){?>
												<option value="<?php echo($c['typename']);?>"><?php echo($c['typename']);?></option>
									<?php }}} ?>						
								</select>
							</div>
							<div class="form-filed-msg text-color-gray"><i id="sh"></i> </div>
							<div class="clearfix"></div>														
						</div>
						<div class="form-item">
							<label class="form-filed-name">外勤所在地</label>
							<div class="form-filed-box">
								<?php echo($mode['address'])?>
							</div>
						
							<div class="clearfix"></div>
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">开始时间</label>
							<div class="form-filed-box">
								<input type="text" name="time" class="input input-default input-w400" value="<?php if(isset($mode) && $mode!=''){echo($mode['time']);}?>" datatype="s2-8" errormsg="格式：1～8个字符" />
							</div>
							
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">填写返回时间</label>
							<div class="form-filed-box">
								<input type="text" name="ortime" class="input input-default input-w400" value="<?php if(isset($mode) && $mode!=''){echo($mode['ortime']);}?>" datatype="s2-8" errormsg="格式：1～8个字符" />
							</div>
						
							<div class="clearfix"></div>
						</div>
						
							<div class="form-item">
							<label class="form-filed-name">内容或备注</label>
							<div class="form-filed-box">
								<textarea  name="shuo" class="input input-default" style="width:400px;height:100px;"><?php if(isset($mode) && $mode!=''){echo($mode['shuo']);}?></textarea>
							</div>
							<div class="clearfix"></div>
						</div>
												
						

						
						<div class="form-item form-item-btn">
							<button type="submit" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i>修改</button>							
						</div>
						<input type="hidden" name="id" value="<?php echo($mode['id'])?>">
						<input type="hidden" name="departmentname" value="<?php echo($mode['departmentname'])?>">
						<input type="hidden" name="name" value="<?php echo($mode['name'])?>">
						<input type="hidden" name="mobile" value="<?php echo($mode['mobile'])?>">
						<input type="hidden" name="address" value="<?php echo($mode['address'])?>">

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

			$("#mform").Validform({
				tiptype:3,
				btnSubmit:"#submit", 
				showAllError:true,
				postonce:true,
				ajaxPost:false,
				beforeSubmit:function(curform){
					
					<?php if($mid!=''){?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>opportunity/save/<?php echo($mid);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>opportunity/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            alert(d.msg);
			            window.location = '<?php echo($settings['renderer']['home_path']);?>opportunity'; 
			            return false;
			          }else{
			            alert(d.msg);
			            window.location.reload();
			          }
			        });
				}
			});
		</script>
	</body>
</html>
