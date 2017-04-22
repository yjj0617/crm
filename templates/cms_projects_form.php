<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo = 7; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-sousuo"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						<?php if($id==''){?>
							添加服务项目
						<?php }else{?>
							编辑服务项目，服务项目ID： <span class="text-color-red"><?php echo($id);?></span>，服务项目名称：<span class="text-color-red"><?php echo($m['title']);?></span>
						<?php } ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="form">
						<form id="mform" method="post">
						<div class="form-item">
							<label class="form-filed-name">服务名称</label>
							<div class="form-filed-box">
								<input type="text" name="title" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['title']);}?>" datatype="s2-16" errormsg="格式：2～16个字符" />
							</div>
							<div class="form-filed-msg text-color-gray">
								<i class="iconfont icon-gantanhao text-color-red"></i> 请填写服务名称
							</div>
							<div class="clearfix"></div>
						</div>

						

						<div class="form-item">
							<label class="form-filed-name">服务类别</label>
							<div class="form-filed-box">
								<select name="cateId" class="input input-default">
									<?php 
										$cs = $db->select('mcms_categories','*',['cateType'=>2]);
										foreach ($cs as $csv) {
											if(isset($m) && $m['cateId'] == $csv['id']){
												echo('<option selected="selected" value="'.$csv['id'].'">'.$csv['cateName'].'</option>');
											}else{
												echo('<option value="'.$csv['id'].'">'.$csv['cateName'].'</option>');
											}
										}
									?>
								</select>
							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">服务描述</label>
							<div class="form-filed-box">
								<textarea  name="desc" class="textarea" style="width:400px;height:80px;"><?php if(isset($m) && $m!=''){echo($m['desc']);}?></textarea>

							</div>
							<div class="form-filed-msg text-color-gray">
								<i class="iconfont icon-gantanhao text-color-red"></i> 用最简洁精炼的文字描述服务。
							</div>
							<div class="clearfix"></div>
						</div>


						
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">市场价</label>
							<div class="form-filed-box">
								<input type="text" name="marketPrice" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['marketPrice']);}?>"  />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 单位（元），此为市场参考价。</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">至上价</label>
							<div class="form-filed-box">
								<input type="text" name="allPrice" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['allPrice']);}?>"  />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 单位（元），此为统一价格，部分地区特定价格，请在地区报价里管理。</div>
							<div class="clearfix"></div>
						</div>

						<div class="item-space"></div>
						
						<div class="form-item">
							<label class="form-filed-name">缩略图</label>
							<div class="form-field-box">
								<div style="display:inline-block">
									<?php if($m && $m['thumbnailp'] != ''){echo('<img src="'.$assets_path.$m['thumbnailp'].'" width="48" />');}?>
								</div>
								<input type="hidden" name="thumbnail" value="<?php if($m && $m['thumbnail'] != ''){echo($m['thumbnail']);}?>" class="input input-default" />
								<input type="file" name="file" />
								
							</div>
							
							<div class="clearfix"></div>
						</div>

						
						<div class="form-item">
							<label class="form-filed-name">照片或图片</label>
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
												echo('<img src="'.$assets_path.$t['thumbnail'].'" width="48" data-id="'.$i.'" />');
											}
										}?>
									</div>
									<div class="font-size-12 text-color-red">注意：点击图片可移除被点击图片。</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">页面模板文件</label>
							<div class="form-filed-box">
								<input type="text" name="template" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['template']);}?>" />
							</div>
							<div class="form-filed-msg text-color-gray">
								<i class="iconfont icon-gantanhao text-color-red"></i> 如页面为定制页面，请输入页面模板名称，如不知，请咨询IT部。
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>

						
						<div class="form-item">
							<label class="form-filed-name">服务内容介绍</label>
							<div class="form-filed-box">
								<script id="editor" type="text/plain" style="width:1000px;height:500px;"></script>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item form-item-btn">
							<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 保存</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</section>

		<?php require 'js.php';?>
		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/select.js"></script>

		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/Validform_v5.3.2.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo($settings['renderer']['home_path']);?><?php echo($settings['renderer']['template_path']);?>dist/editor/ueditor.config.js"></script>
	    <script type="text/javascript" charset="utf-8" src="<?php echo($settings['renderer']['home_path']);?><?php echo($settings['renderer']['template_path']);?>dist/editor/ueditor.all.min.js"> </script>
	    <script type="text/javascript" charset="utf-8" src="<?php echo($settings['renderer']['home_path']);?><?php echo($settings['renderer']['template_path']);?>/dist/editor/lang/zh-cn/zh-cn.js"></script>
		<script type="text/javascript">
			$('select.cgselect').searchableSelect();

			$("#mform").Validform({
				tiptype:3,
				btnSubmit:"#submit", 
				showAllError:true,
				postonce:true,
				ajaxPost:false,
				beforeSubmit:function(curform){
					//在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
					//这里明确return false的话表单将不会提交;
					//
					
					<?php if($id!=''){?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>cms/projects/save/<?php echo($id);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>cms/projects/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            layer.msg(d.msg,{icon: 1,time: 2000,}, function(){
				            	window.location.reload(); 
				            	return false;
							});
			            
			            return false;
			          }else{
			            layer.msg(d.msg,{icon: 0,time: 2000,}, function(){
				            	window.location.reload();
				            	return false;
							});
			            
			          }
			        });
				}
			});

			$('input[name="file"]').change(function(){
				      var form = document.getElementById("mform");
				      var formdata = new FormData(form);
				      var that = this;
				      $.ajax({
				           type : 'post',
				           url : '<?php echo($settings['renderer']['home_path']);?>upload',
				           data : formdata,
				           cache : false,
				           processData : false, 
				           contentType : false, 
				           dataType : 'json',
				           success : function(data){
				           console.log(data);
				           	var tpl = '<img src="<?php echo($assets_path);?>'+data.data.thumbnail+'" width="48" />';
				           	$('.t').html(tpl);
				           	$('input[name="thumbnail"]').val(data.data.uri);
				           	$(that).val('');
				           },
				           error : function(){
				           	alert('上传失败！');
				           	$(that).val('');
				           }
				       });
				});//上传缩略图

			

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
				});//图集

				
				$('#ts').on('click','img',function(){
					var id = $(this).attr('data-id');
					deletepic(id,$(this));
				});



				function addpic(id,uri){
					var tpl = '<img src="<?php echo($assets_path);?>'+uri+'" width="48" data-id="'+id+'" />';
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
		<script type="text/javascript">
			var ue = UE.getEditor('editor',{
					zIndex:999999,
					maximumWords:10000000
				});
				ue.reset();
		        setTimeout(function(){
		            ue.setContent('<?php if($m && $m['text']!=''){echo($m['text']);}?>');
		        },300);
		</script>
	</body>
</html>
