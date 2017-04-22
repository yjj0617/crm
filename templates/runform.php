<?php 
	require 'header.php';
?>
	<body style="background:#fff;animation:anshow 1s 1;">
		<section style="padding:20px;width:calc(100% - 40px);height:calc(100% - 40px);">
			<div class="response-page">
				<div class="form">
					<form id="mform" method="post">
					<?php if($c['type']==1){?>
					<div class="form-item">
						<label class="form-filed-name">月份</label>
						<div class="form-filed-box">
							<input type="date" name="month" class="input input-default input-default" value="<?php if(isset($m) && $m!=''){echo($m['month']);}?>" datatype="*" />
						</div>
						<div class="form-filed-msg text-color-gray">
							<i class="iconfont icon-gantanhao text-color-red"></i> 填写代理记帐合同执行月份
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
					<div class="form-item">
						<label class="form-filed-name">进度描述</label>
						<div class="form-filed-box">
							<textarea name="text" class="textarea" style="width:500px;height:60px;"><?php if(isset($m) && $m!=''){echo($m['text']);}?></textarea>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="form-item">
						<label class="form-filed-name">图片与照片</label>
						<div class="form-filed-box">
							<span class="text-color-gray">上传新图片：</span>
								<input type="file" name="uppic" />
								<input type="hidden" name="pics" value="<?php if($m!='' && $m['pics'] != ''){echo($m['pics']);}else{echo('[]');}?>" class="input input-default input-full" />
									
									<div class="ts" id="ts">
										<?php 
										if($m!='' && $m['pics'] != ''){
											$pics = json_decode($m['pics']);
											foreach ($pics as $i) {
												$t = getpicbyId($i);
												echo('<img src="'.$settings['renderer']['home_path'].$t['thumbnail'].'" width="48" data-id="'.$i.'" />');
											}
										}?>
									</div>
									<div class="font-size-12 text-color-red">注意：点击图片可移除被点击图片。</div>
						</div>
						<div class="form-filed-msg text-color-gray" style="max-width: calc(50%);">
							<i class="iconfont icon-gantanhao text-color-red"></i> 可上传不超过10张图片，没有可忽略。
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="form-item">
						<label class="form-filed-name">是否执行完成</label>
						<div class="form-filed-box">
							<input type="checkbox" name="isend" value="1" />
						</div>
						<div class="form-filed-msg text-color-gray" style="max-width: calc(50%);">
							<i class="iconfont icon-gantanhao text-color-red"></i> 若合同已完成所有事务，请勾选本项。以便业务员确认合同完成。
						</div>
						<div class="clearfix"></div>
					</div>
					

					<div class="form-item form-item-btn">
						<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 提交</button>
					</div>
					</form>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		
			$('#submit').click(function(){
				<?php if($id==0){?>
				var uri = '<?php echo($settings['renderer']['home_path']);?>/contracts/runform/<?php echo($cid);?>';
				<?php }else{ ?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>/contracts/runform/<?php echo($cid);?>/<?php echo($id);?>';
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
		<script type="text/javascript">
			$('input[name="uppic"]').change(function(){
				      var form = document.getElementById("mform");
				      var formdata = new FormData(form);
				      var that = this;
				      $.ajax({
				           type : 'post',
				           url : '<?php echo($settings['renderer']['home_path']);?>uploadPic',
				           data : formdata,
				           cache : false,
				           processData : false, 
				           contentType : false, 
				           dataType : 'json',
				           success : function(data){
				           console.log(data);
				           	if(data.flag==200){
					           	addpic(data.data.uri,data.data.thumbnail);//添加
					           	$(that).val('');
				           	}else{
				           		alert('上传失败！请检查文件格式。');
				           	}
				           },
				           error : function(){
				           	alert('上传失败！');
				           	$(that).val('');
				           }
				       });
				});//上传缩略图

				$('#ts').on('click','img',function(){
					var id = $(this).attr('data-id');
					deletepic(id,$(this));
				});



				function addpic(id,uri){
					var tpl = '<img src="<?php echo($settings['renderer']['home_path']);?>'+uri+'" width="48" data-id="'+id+'" />';
					$('#ts').append(tpl);
		        	var pics = $('input[name="pics"]').val();
		        	var picsArray = JSON.parse(pics);
		        	var index = picsArray.indexOf(parseInt(id));
		        	picsArray.push(parseInt(id));
		        	var newpA = JSON.stringify(picsArray);
		        	$('input[name="pics"]').val(newpA);
		        }

		        function deletepic(id,a){
					$(a).remove();
		        	var pics = $('input[name="pics"]').val();
		        	var picsArray = JSON.parse(pics);
		        	var index = picsArray.indexOf(parseInt(id));//查找ID对应的index
		        	picsArray.splice(index,1);//从对象中移除
		        	var newpA = JSON.stringify(picsArray);
		        	$('input[name="pics"]').val(newpA);
		        } 
		</script>
	</body>
</html>
