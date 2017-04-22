<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo = 2; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-sousuo"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						<?php if($mid==''){?>
							添加客户
						<?php }else{?>
							编辑客户，客户ID： <?php echo($m['id']);?>，客户名：<?php echo($m['name']);?>
						<?php } ?>
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
				</div>
				<div class="box-body">
					<div class="form">
						<form id="mform" method="post">
						<div class="form-item">
							<label class="form-filed-name">客户姓名</label>
							<div class="form-filed-box">
								<input type="text" name="name" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['name']);}?>" datatype="s2-8" errormsg="格式：2～8个字符" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 客户姓名不允许“先生、女士、太太、小姐”等称谓，必须是真实有效的姓名。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">性别</label>
							<div class="form-filed-box">
								<input type="radio" name="sexy" value="0" <?php if(isset($m) && $m!='' && $m['sexy']==0){echo('checked="checked"');}?> datatype="*" errormsg="请选择性别！" /> 先生
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="sexy" value="1" <?php if(isset($m) && $m!='' && $m['sexy']==1){echo('checked="checked"');}?>/> 女士
							</div>
							
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">手机号码</label>
							<div class="form-filed-box">
								<input type="text" name="mobile" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['mobile']);}?>" datatype="m" errormsg="格式：11个数字" <?php if($m == ''){?> ajaxurl="<?php echo($settings['renderer']['home_path']);?>vmobile"<?php } ?> />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的手机号码。</div>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">客户所在地</label>
							<div class="form-filed-box" id="locaA">
								<select name="prov" class="input input-default prov"><option value="" code="">不限</option></select> -
                                <select name="city" class="input input-default city"><option value=""  code="">不限</option></select> -
                                <select name="area" class="input input-default area" datatype="*" nullmsg="请选择" errormsg="请选择"><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入客户所在地省市区。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">关联业务员</label>
							<div class="form-filed-box">
								<select name="ywuid" class="input cgselect" datatype="*" nullmsg="请选择" errormsg="请选择">
									<option value="">请选择</option>
									<?php if($satff){
											foreach ($satff as $s) { ?>
									<?php if($m!='' && $m['ywuid']==$s['id']){?>
									<option selected="selected" value="<?php echo($s['id']);?>">
										<?php echo($s['name']);?>-<?php echo($s['mobile']);?>
									</option>
									<?php }else{?>
										<option value="<?php echo($s['id']);?>">
											<?php echo($s['name']);?>-<?php echo($s['mobile']);?>
										</option>
									<?php }}} ?>
								</select>
							</div>
							
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">&nbsp;</label>
							<div class="form-filed-msg no-text-indent text-color-red"><i class="iconfont icon-gantanhao text-color-red"></i> 注意，以上信息必须全部填写。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">备用手机号码</label>
							<div class="form-filed-box">
								<input type="text" name="mobile2" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['mobile2']);}?>" datatype="m" ignore="ignore" errormsg="格式：11个数字" <?php if($m == ''){?> ajaxurl="<?php echo($settings['renderer']['home_path']);?>vmobile"<?php } ?> />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的手机号码，没有则可以不填。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">联系地址</label>
							<div class="form-filed-box">
								<input type="text" name="address" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['address']);}?>" datatype="s2-48" ignore="ignore" errormsg="格式：2~48个字符" style="width:400px;" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的联系地址，没有则可以不填。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">生日</label>
							<div class="form-filed-box">
								<input type="date" name="birthday" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['birthday']);}?>" />
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">身份证号码</label>
							<div class="form-filed-box">
								<input type="text" name="sfz" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['sfz']);}?>" datatype="n18-18" ignore="ignore" errormsg="格式：18位数字"  />
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="more" class="input input-default" style="width:400px;height:50px;"><?php if(isset($m) && $m!=''){echo($m['more']);}?></textarea>
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
												echo('<img src="'.$settings['renderer']['home_path'].$t['thumbnail'].'" width="48" data-id="'.$i.'" />');
											}
										}?>
									</div>
									<div class="font-size-12 text-color-red">注意：点击图片可移除被点击图片。</div>
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
					var name = $('input[name="name"]').val();
					var nokey = ['先生','女士','太太','小姐'];
					for(var i = 0;i < nokey.length; i++){
						if(name.indexOf(nokey[i]) > -1){
							alert('错误, 客户名称不能出现：'+ nokey[i]);
							return false
						}
					}
					<?php if($mid!=''){?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>customs/save/<?php echo($mid);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>customs/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            alert(d.msg);
			            window.location = '<?php echo($settings['renderer']['home_path']);?>customs/detail/'+d.id; 
			            return false;
			          }else{
			            alert(d.msg);
			            window.location.reload();
			          }
			        });
				}
			});
			pca('#locaA','<?php if(isset($m) && $m!=''){echo($m['prov']);}else{echo('浙江省');}?>','<?php if(isset($m) && $m!=''){echo($m['city']);}else{echo('杭州市');}?>','<?php if(isset($m) && $m!=''){echo($m['area']);}else{echo('西湖区');}?>');

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
