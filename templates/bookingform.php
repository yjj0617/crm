<?php 
	require 'header.php';
?>
	<body style="background:#fff;animation:anshow 1s 1;">
		<section style="padding:20px;width:calc(100% - 40px);height:calc(100% - 40px);">
			<div class="response-page">
				<div class="form">
					<form id="mform" method="post">
					<div class="form-item">
						<label class="form-filed-name">入帐日(款项到帐日)</label>
						<div class="form-filed-box">
							<input type="date" name="entry_day" class="input input-default input-default" value="<?php if(isset($m) && $m!=''){echo($m['entry_day']);}?>" datatype="*" />
						</div>
						<div class="form-filed-msg text-color-gray">
							<i class="iconfont icon-gantanhao text-color-red"></i> 请填写款项到帐的实际日期
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-item">
						<label class="form-filed-name">款项帐期</label>
						<div class="form-filed-box">
							<input type="date" name="zq" class="input input-default input-default" value="<?php if(isset($m) && $m!=''){echo($m['zq']);}?>" datatype="*" />
						</div>
						<div class="form-filed-msg text-color-gray" style="max-width: calc(50%);">
							<i class="iconfont icon-gantanhao text-color-red"></i> 指的是分期付款合同(部分代理记账合同)，已付款项到期日。
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-item">
						<label class="form-filed-name">入帐金额</label>
						<div class="form-filed-box">
							<input type="text" name="money" class="input input-default input-default" value="<?php if(isset($m) && $m!=''){echo($m['money']);}?>" datatype="*" />
						</div>
						<div class="form-filed-msg text-color-gray" style="max-width: calc(50%);">
							<i class="iconfont icon-gantanhao text-color-red"></i> 实际入帐金额
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-item">
						<label class="form-filed-name">入帐渠道</label>
						<div class="form-filed-box">
							<select name="source" class="input">
								<?php foreach($source as $s){?>
								<option <?php if(isset($m) && $m!='' && $m['source'] == $s['id']){echo('selected="selected"');}?> value="<?php echo($s['id']);?>">
									<?php echo($s['sourcename']);?>
									<?php if($s['sourceaccount']!=''){ 
										echo('('.$s['sourceaccount'].')');
									}?>
								</option>
								<?php }?>
							</select>
						</div>
						
						<div class="clearfix"></div>
					</div>

					<div class="form-item">
						<label class="form-filed-name">备注</label>
						<div class="form-filed-box">
							<input type="text" name="text" class="input  input-full" style="width:500px;" value="<?php if(isset($m) && $m!=''){echo($m['text']);}?>" datatype="*" />
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="form-item form-item-btn">
						<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 入帐</button>
					</div>
					</form>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		
			$('#submit').click(function(){
				<?php if($id==0){?>
				var uri = '<?php echo($settings['renderer']['home_path']);?>/contracts/bookingform/<?php echo($cid);?>';
				<?php }else{ ?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>/contracts/bookingform/<?php echo($cid);?>/<?php echo($id);?>';
				<?php } ?>
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
