<?php 
	require 'header.php';
?>
	<body style="background:#fff;animation:anshow 1s 1;">
		<section style="padding:20px;width:calc(100% - 40px);height:calc(100% - 40px);">
			<div class="response-page">
				<div class="pull-left cells" style="width:calc(50% - 10px);">
					<div class="cells-item">
						<label class="cells-filed-name">ID</label>
						<div class="cells-filed-box">
							<?php echo($m['id']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">客户</label>
						<div class="cells-filed-box">
							<?php echo($m['uname']);?> <span class="text-color-blue">[ <?php echo($m['mobile']);?> ]</span>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="cells-item">
						<label class="cells-filed-name">咨询业务</label>
						<div class="cells-filed-box">
							<?php echo($m['catename']);?>
							<?php if($m['itemId']!=0){ echo ('：'.$m['item']);}?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">咨询内容</label>
						<div class="cells-filed-box">
							<?php echo($m['text']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">所在地区</label>
						<div class="cells-filed-box">
							<?php echo($m['prov']);?> -
							<?php echo($m['city']);?> -
							<?php echo($m['area']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">来源</label>
						<div class="cells-filed-box">
							<?php echo($m['form']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">渠道</label>
						<div class="cells-filed-box">
							<?php echo($m['qd']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">录入时间</label>
						<div class="cells-filed-box">
							<?php echo($m['creattime']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">状态</label>
						<div class="cells-filed-box">
							<span class="text-color-blue"><?php echo($m['statusName']);?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="cells-item">
						<label class="cells-filed-name">商机负责员工</label>
						<div class="cells-filed-box">
							<?php echo($m['owenSubCompany']);?> - 
							<?php echo($m['owenSaler']);?>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php if($m['contractId'] != NULL){?>
					<div class="cells-item">
						<label class="cells-filed-name">合同ID</label>
						<div class="cells-filed-box">
							<?php echo $m['contractId'];?>
							<span class="w15"></span>
							<a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $m['contractId'];?>" class="btn btn-link btn-blue">查看合同</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
				</div>
				<div class="pull-right" style="width:calc(50% - 10px);">
					<?php if($m['status']==1 || $m['status']==2){?>
					<div class="form" style="background-color:rgba(0,0,0,0.05);border-radius:10px;padding:10px;">
						<form id="do" method="post">
							<div class="form-item form-item-v" id="text">
								<label class="form-filed-name">处理过程及内容</label>
								<div class="form-filed-box">
									<textarea class="textarea" name="text" style="background-color:rgba(255,255,255,0.8);"></textarea>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-item form-item-v" id="cId" style="display:none;">
								<label class="form-filed-name">合同ID</label>
								<div class="form-filed-box">
									<input type="number" name="contractId" class="input" /> <span class="w15"></span>
									<i class="iconfont icon-gantanhao text-color-red"></i> 注意：这里需要填的是合同ID,不是合同编号。
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-item form-item-v">
								<label class="form-filed-name">结果</label>
								<div class="form-filed-box" style="max-width:60%;width:60%;padding-top:5px">
									<label><input type="radio" name="status" value="2" <?php if($m['status']==2 || $m['status']==1){echo('checked="checked"');}?> /> 继续跟进</label>
									<label><input type="radio" name="status" value="3" <?php if($m['status']==3){echo('checked="checked"');}?> /> 已签单</label>
									<label><input type="radio" name="status" value="4" <?php if($m['status']==4){echo('checked="checked"');}?> /> 关闭</label>
								</div>
								<div class="pull-right">
									<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 保存处理结果</button>
								</div>
								<div class="clearfix"></div>
							</div>
						</form>
					</div>
					<?php } ?>
					<div class="timeline" style="height:330px;overflow:auto;">
					<?php if($oplog){
						foreach ($oplog as $l) { ?>
							<div class="timeline-item">
								<div class="timeline-timebox">
									<span class="font-size-18"><?php echo(date('H:i',strtotime($l['creatTime'])));?></span>
									<br />
									<span class="font-size-12"><?php echo(date('m月d日',strtotime($l['creatTime'])));?></span>
								</div>
								<div class="timeline-body">
									<div class="font-size-14">
										<?php echo($l['text']);?>
									</div>
									<div class="timeline-body-meta font-size-12 text-color-gray">
										<i class="iconfont icon-wo"></i> 
										<?php echo($l['ucompany']);?> - 
										<?php echo($l['uname']);?> 
										[ <?php echo($l['umobile']);?> ]
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
					<?php } } ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
			$('input[name="status"]').click(function(){
				var val = $(this).val();
				if(val==3){
					$('#cId').show();
					$('#text').hide();
				}
				if(val==2){
					$('#cId').hide();
					$('#text').show();
				}
			});
			$('#submit').click(function(){
				var val = $('input[name="status"]:checked').val();
				var cId = $('input[name="contractId"]').val();
				var text = $('textarea[name="text"]').val();
				if(val==3 && cId==''){
					
					layer.msg('合同ID不能为空',{icon: 0,time: 2000,}, function(){
			            	return false;
						});
					return false;
				}
				if(val==2 && text==''){
					// alert('处理过程及内容不能为空');
					layer.msg('处理过程及内容不能为空',{icon: 0,time: 2000,}, function(){
			            	return false;
						});
					return false;
				}
				if(val==4 && text==''){
					// alert('处理过程及内容不能为空');
					layer.msg('处理过程及内容不能为空',{icon: 0,time: 2000,}, function(){
			            	return false;
						});
					return false;
				}
				var uri = '<?php echo($settings['renderer']['home_path']);?>opportunity/do/<?php echo($m['id']);?>';
				$.post(uri,$('#do').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			          	layer.msg(d.msg,{icon: 1,time: 2000,}, function(){
							window.location.reload();
			            	return false;
						});
			            //以下代码可以关闭父级弹窗
			   			//var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
						// parent.layer.close(index);
			            
			          }else{
			            layer.msg(d.msg,{icon: 0,time: 2000,}, function(){
			            	return false;
						});
			          }
			    });
			});	
			var f = $('form');
			if(f.length==0){
				$('.timeline').css('height','540px');
			}
		</script>
	</body>
</html>
