<?php 
	require 'header.php';
?>
	<body style="background:#fff;animation:anshow 1s 1;">
		<section style="padding:20px;width:calc(100% - 40px);height:calc(100% - 40px);">
			<div class="response-page">
				<div class="wp-status" style="top:40px;right:40px;">
					<?php if($m['status']==0){?>
						<i class="iconfont icon-xiaozhushouweiwancheng text-color-gray"></i><br />
						<span class="font-size-12 text-color-gray">未执行</span>
					<?php }elseif($m['status']==1){?>
						<i class="iconfont icon-weiwancheng text-color-green"></i><br />
						<span class="font-size-12 text-color-green">正在执行</span>
					<?php }elseif($m['status']==2){?>
						<i class="iconfont icon-wancheng icon-weiwancheng text-color-green"></i><br />
						<span class="font-size-12 text-color-green">已按时完成</span>
					<?php }elseif($m['status']==3){?>
						<i class="iconfont icon-cuowu text-color-red"></i><br />
						<span class="font-size-12 text-color-red">未按时完成</span>
					<?php }?>
				</div>
				<div class="font-size-14">工作计划：<?php if(isset($m['title']) && $m['title']!=''){echo($m['title']);}?></div>
				<div class="font-size-12" style="min-height:100px;">
					<?php echo($m['plancontent']);?>
				</div>
				<div class="form" style="margin-top:20px;padding-top:10px;border-top:1px dotted #eee;">

					<form method="post" name="mform" id="mform">
						<?php if($m['status']!=0){?>
							<input type="hidden" value="<?php echo($m['status']);?>" name="status" />
						<div class="font-size-12 text-color-red">计划执行情况说明</div>
						<div class="form-item">
							<textarea class="textarea" name="more" style="width:99%;height:60px;"><?php if(isset($m['more']) && $m['more']!=''){echo($m['more']);}?></textarea>
						</div>

						<div class="form-item text-center">
							<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 保存</button>
						</div>
						<?php }else{?>
							<input type="hidden" value="1" name="status" />
						<div class="form-item text-center">
							<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 开始执行</button>
						</div>
						<?php }?>
						</form>
					</form>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>

		<script type="text/javascript">
			

			$('#submit').click(function(){
				var uri = '<?php echo($settings['renderer']['home_path']);?>executive/workplan/savemore/<?php echo($m['id']);?>';
				
				$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			          	layer.msg(d.msg,{icon: 1,time: 2000,}, function(){
							//以下代码可以关闭父级弹窗
				   			var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
							parent.layer.close(index);

			            	return false;
						});
			            
			            
			          }else{
			            layer.msg(d.msg,{icon: 0,time: 2000,}, function(){
			            	return false;
						});
			          }
			    });
			});	
			
		</script>
	</body>
</html>
