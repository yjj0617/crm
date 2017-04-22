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
						节日福利添加
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="qklist">
					<form id="mform" method="post" action="<?php echo($settings['renderer']['home_path']);?>executive/jieinsert" onsubmit="return demo()" name="reg_testdate">
						<div class="form-item">
							<label class="form-filed-name">添加人</label>
							<div class="form-filed-box">
									<?php echo($mode['name'])?>	
							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>																					
						</div> 
						<div class="form-item">
							<label class="form-filed-name">节日名称</label>
							<div class="form-filed-box">
									<input type="text" id="did" required onfocus="fun()" onblur="func()" name="jname" class="input input-default input-w400" value=""/>	
							</div>
							<div class="form-filed-msg text-color-gray"><i id="ss"></i> </div>
							<div class="clearfix"></div>																					
						</div>                    					
						<div class="form-item">
							<label class="form-filed-name">节日时间</label>
							
							     <select name="YYYY" onChange="YYYYDD(this.value)">
					                <option value="">请选择 年</option>
					            </select>
					            <select name="MM" onChange="MMDD(this.value)">
					                <option value="">选择 月</option>
					            </select>
					            <select name="DD">
					                <option value="">选择 日</option>
					             </select>									
						</div>
												
						<div class="form-item">
							<label class="form-filed-name">福利名称</label>
							<div class="form-filed-box">
									<select name="wname">
									<?php foreach($wsock as $u){?>
					                	<option value="<?php echo($u['name'])?>"><?php echo($u['name'])?></option>
					                	<?php }?>
					           		 </select>
							</div>
							<div class="form-filed-msg text-color-gray"><i id="ss"></i> </div>
							<div class="clearfix"></div>																					
						</div>
						<div class="form-item">
							<label class="form-filed-name">数量</label>
							<div class="form-filed-box">
									<input type="text" id="number" required onfocus="mu()" onblur="mc()" name="number" class="input input-default input-w400" value="" placeholder="输入每个人可领取的数量"/>	
							</div>
							<div class="form-filed-msg text-color-gray"><i id="mm"></i> </div>
							<div class="clearfix"></div>																					
						</div> 
							<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="jcontent" class="input input-default" style="width:400px;height:100px;" ></textarea>
									
							</div>
							<div class="form-filed-msg text-color-gray"><i id="ss"></i> </div>
							<div class="clearfix"></div>																					
						</div>
						<div class="form-item form-item-btn">
								<button type="submit" id="submiti" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 提交</button>	
						</div>
						<input type="hidden" name="id" value="<?php echo($mode['id'])?>">
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
		//表单提交验证
				//姓名验证
			function fun(){
				ss=document.getElementById('ss');
				ss.innerHTML="填写节日名称";
				ss.style.color='red';
			}
			function func(){
				did=document.getElementById('did');
				val=did.value;
				if(val.match(/[\u4E00-\u9FA5]{2,4}/)==null){
					ss.innerHTML="节日名不能为空";
					ss.style.color="blue";
		 			return false;
				}else{
					ss.innerHTML="正确";
		 		ss.style.color="green";
		 		return true;
				}
			}

				// 电话验证
			function mu(){
				mm=document.getElementById('mm');
				mm.innerHTML="填写领取的数量";
				mm.style.color='red';
			}
			function mc(){
				number=document.getElementById('number');
				val=number.value;
				if(val.match(/^[1-9]\d*$/)==null){
					mm.innerHTML="输入规定的领取数量";
					mm.style.color="blue";
					return false
				}else{
					mm.innerHTML="正确";
					mm.style.color="green";
					return true;
				}
			}
				


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
		 	//开始时间三级联动
		 	  function YYYYMMDDstart() {
                MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                //先给年下拉框赋内容   
                var y = new Date().getFullYear();
                for (var i = (y - 30); i < (y + 30); i++) //以今年为准，前30年，后30年   
                    document.reg_testdate.YYYY.options.add(new Option(" " + i + " 年", i));
                //赋月份的下拉框   
                for (var i = 1; i < 13; i++)
                    document.reg_testdate.MM.options.add(new Option(" " + i + " 月", i));
                document.reg_testdate.YYYY.value = y;
                document.reg_testdate.MM.value = new Date().getMonth() + 1;
                var n = MonHead[new Date().getMonth()];
                if (new Date().getMonth() == 1 && IsPinYear(YYYYvalue)) n++;
                writeDay(n); //赋日期下拉框Author:meizz   
                document.reg_testdate.DD.value = new Date().getDate();
            }
            if (document.attachEvent)
                window.attachEvent("onload", YYYYMMDDstart);
            else
                window.addEventListener('load', YYYYMMDDstart, false);

            function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)   
            {
                var MMvalue = document.reg_testdate.MM.options[document.reg_testdate.MM.selectedIndex].value;
                if (MMvalue == "") {
                    var e = document.reg_testdate.DD;
                    optionsClear(e);
                    return;
                }
                var n = MonHead[MMvalue - 1];
                if (MMvalue == 2 && IsPinYear(str)) n++;
                writeDay(n)
            }

            function MMDD(str) //月发生变化时日期联动   
            {
                var YYYYvalue = document.reg_testdate.YYYY.options[document.reg_testdate.YYYY.selectedIndex].value;
                if (YYYYvalue == "") {
                    var e = document.reg_testdate.DD;
                    optionsClear(e);
                    return;
                }
                var n = MonHead[str - 1];
                if (str == 2 && IsPinYear(YYYYvalue)) n++;
                writeDay(n)
            }

            function writeDay(n) //据条件写日期的下拉框   
            {
                var e = document.reg_testdate.DD;
                optionsClear(e);
                for (var i = 1; i < (n + 1); i++)
                    e.options.add(new Option(" " + i + " 日", i));
            }

            function IsPinYear(year) //判断是否闰平年   
            {
                return (0 == year % 4 && (year % 100 != 0 || year % 400 == 0));
            }

            function optionsClear(e) {
                e.options.length = 1;
            }

            //结束时间三级联动......................................
             function YYMMDDstart() {
                MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                //先给年下拉框赋内容   
                var y = new Date().getFullYear();
                for (var i = (y - 30); i < (y + 30); i++) //以今年为准，前30年，后30年   
                    document.reg_testdate.YY.options.add(new Option(" " + i + " 年", i));
                //赋月份的下拉框   
                for (var i = 1; i < 13; i++)
                    document.reg_testdate.MO.options.add(new Option(" " + i + " 月", i));
                document.reg_testdate.YY.value = y;
                document.reg_testdate.MO.value = new Date().getMonth() + 1;
                var n = MonHead[new Date().getMonth()];
                if (new Date().getMonth() == 1 && IsPinYeary(YYvalue)) n++;
                writeDayt(n); //赋日期下拉框Author:meizz   
                document.reg_testdate.DE.value = new Date().getDate();
            }
            if (document.attachEvent)
                window.attachEvent("onload", YYMMDDstart);
            else
                window.addEventListener('load', YYMMDDstart, false);

            function YYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)   
            {
                var MOvalue = document.reg_testdate.MO.options[document.reg_testdate.MO.selectedIndex].value;
                if (MOvalue == "") {
                    var e = document.reg_testdate.DE;
                    optionsCleart(e);
                    return;
                }
                var n = MonHead[MOvalue - 1];
                if (MOvalue == 2 && IsPinYeary(str)) n++;
                writeDayt(n)
            }

            function MD(str) //月发生变化时日期联动   
            {
                var YYvalue = document.reg_testdate.YY.options[document.reg_testdate.YY.selectedIndex].value;
                if (YYvalue == "") {
                    var e = document.reg_testdate.DE;
                    optionsCleart(e);
                    return;
                }
                var n = MonHead[str - 1];
                if (str == 2 && IsPinYeary(YYvalue)) n++;
                writeDayt(n)
            }

            function writeDayt(n) //据条件写日期的下拉框   
            {
                var e = document.reg_testdate.DE;
                optionsCleart(e);
                for (var i = 1; i < (n + 1); i++)
                    e.options.add(new Option(" " + i + " 日", i));
            }

            function IsPinYeary(year) //判断是否闰平年   
            {
                return (0 == year % 4 && (year % 100 != 0 || year % 400 == 0));
            }

            function optionsCleart(e) {
                e.options.length = 1;
            }


            ////////////////////////////////////////时间
            ///
		
		
		</script>

	</body>
</html>
