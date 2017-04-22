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
							添加员工
						<?php }else{?>
							编辑员工，员工ID： <?php echo($m['id']);?>
						<?php } ?>
					</div>
					<div class="pull-right">
						
					</div>
				</div>
				<div class="box-body">
					<?php if($mid != ''){?>
					<div class="tabbox">
						<?php $cmodel=0;  require 'hr_detail_nav.php';?>
					</div>
					<?php } ?>
					<div class="form">
						<form id="mform" method="post">
						<div class="form-item">
							<label class="form-filed-name">员工编号</label>
							<div class="form-filed-box">
								<?php
                                    $getstaffid = $db->get("member", "staffid", [
                                        "AND" => [
                                            "staffid[!]" => [null],
                                        ],
                                        "ORDER" => ["member.id"=>"DESC"],
                                    ]);
                                    $staffid = substr($getstaffid, -2)+1;   //工号破百之后改-3,下面改zs00

                                ?>
								<input type="text" name="staffid" value="<?php if($m && $m['staffid']!=''){echo($m['staffid']);}else{echo('zs000'.$staffid);}?>" readonly="readonly" class="input input-full" />
								
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 员工卡编号</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">入职日期</label>
							<div class="form-filed-box">
								<input type="date" name="entryday" value="<?php if($m){echo $m['entryday'];}else{ echo date('Y-m-d');}?>" class="input input-full" />
							</div>
							
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">员工姓名</label>
							<div class="form-filed-box">
								<input type="text" name="name" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['name']);}?>" datatype="s2-8" errormsg="格式：2～8个字符" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 员工真实姓名。</div>
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
								<input type="text" name="mobile" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['mobile']);}?>" datatype="m" errormsg="格式：11个数字" />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的手机号码。</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">身份证号码</label>
							<div class="form-filed-box">
								<input type="text" name="sfz" class="input input-w250" value="<?php if(isset($m) && $m!=''){echo($m['sfz']);}?>" datatype="sfz" errormsg="格式：身份证号码"  />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的二代身份证号码</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">生日</label>
							<div class="form-filed-box">
								<input type="date" name="birthday" value="<?php if($m){echo $m['birthday'];}?>" class="input input-full" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">政治面貌</label>
							<div class="form-filed-box">
								<select name="political" class="input input-full">
									<option <?php if($m){ if($m['political']=='群众'){echo 'selected';}}?>>群众</option>
									<option <?php if($m){ if($m['political']=='中共党员'){echo 'selected';}}?>>中共党员</option>
									<option <?php if($m){ if($m['political']=='共青团员'){echo 'selected';}}?>>共青团员</option>
									<option <?php if($m){ if($m['political']=='其它'){echo 'selected';}}?>>其它</option>
								</select>

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">民族</label>
							<div class="form-filed-box">
								<input type="text" name="nation" value="<?php if($m){echo $m['nation'];}?>" class="input" placeholder="如：汉" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">户口所在地</label>
							<div class="form-filed-box">
								
								<input type="text" name="crossprev" value="<?php if($m){echo $m['crossprev'];}?>" class="input input-full" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请按身份证信息填写</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">户口详细地址</label>
							<div class="form-filed-box">
								<input type="text" name="crossaddress" value="<?php if($m){echo $m['crossaddress'];}?>" class="input input-full" style="width:400px;" />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请按身份证信息填写</div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">关联地区</label>
							<div class="form-filed-box" id="locaA">
								<select name="prov" class="input input-default prov"><option value="" code="">不限</option></select> -
                                <select name="city" class="input input-default city"><option value=""  code="">不限</option></select> -
                                <select name="area" class="input input-default area" ><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> [ 事务部 ]员工需关联地区以方便派单。</div>
							<div class="clearfix"></div>
						</div>

						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">公司/部门/岗位</label>
							<div class="form-filed-box">
								<select name='subcompany' class="input">
									<?php 
										$mc = $db->select('member_subcompany','*');
										if($mc){
											foreach ($mc as $o) {
												if($o){
													if($o['id'] == $m['subcompany']){
														echo '<option value="'.$o['id'].'" selected>'.$o['subcompanyname'].'</option>';
													}else{
														echo '<option value="'.$o['id'].'">'.$o['subcompanyname'].'</option>';
													}
												}else{
													echo '<option value="'.$o['id'].'">'.$o['subcompanyname'].'</option>';
												}
											}
										}
									?>
								</select>

								<select name="department" class="input" style="width:100px">
									<?php 
										$dt = $db->select('member_department','*');
										if($dt){
											foreach ($dt as $t) {
												if($m){
													if($t['id'] == $m['department']){
														echo '<option value="'.$t['id'].'" selected>'.$t['departmentname'].'</option>';
													}else{
														echo '<option value="'.$t['id'].'">'.$t['departmentname'].'</option>';
													}
												}else{
													echo '<option value="'.$t['id'].'">'.$t['departmentname'].'</option>';
												}
											}
										}
									?>
								</select>

								<select name="position" class="input">
									<?php 
										$ps = $db->select('member_position','*');
										if($ps){
											foreach ($ps as $p) {
												if($m){
													if($p['id'] == $m['position']){
														echo '<option value="'.$p['id'].'" selected>'.$p['positionname'].'</option>';
													}else{
														echo '<option value="'.$p['id'].'">'.$p['positionname'].'</option>';
													}
												}else{
													echo '<option value="'.$p['id'].'">'.$p['positionname'].'</option>';
												}
											}
										}
									?>
								</select>

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请选择</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">是否主管/经理</label>
							<div class="form-filed-box">
								
								<input type="checkbox" name="ismanager" value="1" <?php if($m && $m['ismanager'] == 1){ echo('checked="checked"'); }?> /> 是
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 若是请勾选本项</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">基本薪资</label>
							<div class="form-filed-box">
								<input type="text" name="remuneration" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['remuneration']);}?>" datatype="n2-8" errormsg="格式：2～8个数字" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 员工基本月工资，单位（元）。</div>
							<div class="clearfix"></div>
						</div>

						

						<div class="form-item">
							<label class="form-filed-name">&nbsp;</label>
							<div class="form-filed-msg no-text-indent text-color-red"><i class="iconfont icon-gantanhao text-color-red"></i> 注意，以上信息必须全部填写。</div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">毕业学校</label>
							<div class="form-filed-box">
								<input type="text" name="school" value="<?php if($m){echo $m['school'];}?>" class="input input-w250" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">专业</label>
							<div class="form-filed-box">
								<input type="text" name="specialty" value="<?php if($m){echo $m['specialty'];}?>" class="input input-w250" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">最高学历</label>
							<div class="form-filed-box">
								<select name="education" class="input input-full">
									<option value=''>请选择</option>
									<option <?php if($m){ if($m['education']=='研究生或以上'){echo 'selected';}}?>>研究生或以上</option>
									<option <?php if($m){ if($m['education']=='本科'){echo 'selected';}}?>>本科</option>
									<option <?php if($m){ if($m['education']=='专科'){echo 'selected';}}?>>专科</option>
									<option <?php if($m){ if($m['education']=='高中或中专'){echo 'selected';}}?>>高中或中专</option>
									<option <?php if($m){ if($m['education']=='初中或以下'){echo 'selected';}}?>>初中或以下</option>
									<option <?php if($m){ if($m['education']=='其他'||$m['education']==''){echo 'selected';}}?>>其他</option>
								</select>

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">资格证名称编号</label>
							<div class="form-filed-box">
								
								<input type="text" name="certificate" value="<?php if($m){echo $m['certificate'];}?>" class="input input-full" style="width:400px" />
							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">家庭电话</label>
							<div class="form-filed-box">
								<input type="text" name="familyphone" value="<?php if($m){echo $m['familyphone'];}?>" class="input input-w250" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">联系地址</label>
							<div class="form-filed-box">
								
								<input type="text" name="familyaddress" value="<?php if($m){echo $m['familyaddress'];}?>" class="input input-full" style="width:400px;" />
							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">紧急联系人</label>
							<div class="form-filed-box">
								<input type="text" name="emergencycontact" value="<?php if($m){echo $m['emergencycontact'];}?>" class="input input-full" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">紧急联系电话</label>
							<div class="form-filed-box">
								<input type="text" name="emergencyphone" value="<?php if($m){echo $m['emergencyphone'];}?>" class="input input-w250" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">工资卡开户行</label>
							<div class="form-filed-box">
								<select name="bank" class="input input-full">
									<?php 
										$bank = $db->select('member_bank','*');
										if($bank){
											foreach ($bank as $b) { 
												if($m){
													if($b['bankname'] == $m['bank']){
														echo '<option selected>'.$b['bankname'].'</option>';
													}else{
														echo '<option>'.$b['bankname'].'</option>';
													}
												}else{
													echo '<option>'.$b['bankname'].'</option>';
												}
											}
										}
									?>
								</select>

							</div>
							
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">工资卡帐号</label>
							<div class="form-filed-box">
								
								<input type="text" name="bankcard" value="<?php if($m){echo $m['bankcard'];}?>" class="input input-w250" />
							</div>
							<div class="clearfix"></div>
						</div>


						

						<div class="item-space"></div>
						
						

						

						

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
								<input type="hidden" name="pics" value="<?php if($m!='' && $m['pics'] != ''){echo($m['pics']);}else{echo('');}?>" class="input input-default input-full" />
									
									<div class="ts" id="ts">
										<?php 
										if($m!='' && $m['photo'] != ''){
											
											echo('<img src="'.$assets_path.$m['photo'].'" width="48" data-id="1" />');
											
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
					var uri = '<?php echo($settings['renderer']['home_path']);?>hr/save/<?php echo($mid);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>hr/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            alert(d.msg);
			            window.location = '<?php echo($settings['renderer']['home_path']);?>hr/detail/'+d.id; 
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
					var tpl = '<img src="<?php echo($assets_path);?>'+uri+'" width="48" data-id="1" />';
					$('#ts').append(tpl);
		        	$('input[name="pics"]').val(id);
		        }

		        function deletepic(id,a){
					$(a).remove();
		        	var pics = $('input[name="pics"]').val();
		        	
		        	$('input[name="pics"]').val('');
		        }   
		</script>
		
	</body>
</html>
