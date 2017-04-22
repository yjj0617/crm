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
							添加合同
						<?php }else{?>
							编辑合同，合同ID： <?php echo($mid);?>
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
							<label class="form-filed-name">合同编号</label>
							<div class="form-filed-box">
								<input type="text" name="cno" value="<?php if($m){echo $m['cno'];}?>" class="input" />
							</div>
							<div class="form-filed-msg text-color-gray">
								<i class="iconfont icon-gantanhao text-color-red"></i> 正式合同未签时，合同编号可不填。
								
							</div>
							<div class="clearfix"></div>
						</div>
						<?php if(!$m){?>
						<div class="form-item">
							<label class="form-filed-name">客户类型</label>
							<div class="form-filed-box">
								
								<label><input type="radio" name="utype" class="utype" value="1" <?php if($m){ if($m['utype']==1){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> /> 企业</label>
								&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name="utype" class="utype" value="2" <?php if($m){ if($m['utype']==2){echo 'checked="checked"';}}?> /> 个人</label>
                                
							</div>
							
							<div class="clearfix"></div>
						</div>
						<?php }?>
						<div class="form-item">
							<label class="form-filed-name">签约主体</label>
							<div class="form-filed-box" style="width:300px;">
								<input type="hidden" name="uid" value="<?php if($m){echo $m['uid'];}?>" />
								<span id="cname" class="text-color-red">
									<?php if($m){ 
											echo $m['uname'];
											}else{
											echo('搜索并选择');
											}
									?>
											
								</span>
								&nbsp;
							</div>
							<?php if($m && $m['uid']!=''){}else{?>
							<div class="form-filed-msg text-color-gray" style="width:600px;max-width:600px;text-indent:0;">
								<input type="text" name="key" id="key" class="input input-w200" placeholder="请输入..." />
								<a type="button" class="btn btn-green searchBtn">搜索</a>
								<span class="w50"></span>
								<a data-href="<?php echo($settings['renderer']['home_path']);?>customs/form" class="btn btn-oranage creatNcutom"><i class="iconfont icon-anonymous-iconfont"></i> 添加新客户</a>
								<span class="w25"></span>
								<a data-href="<?php echo($settings['renderer']['home_path']);?>companies/form" class="btn btn-red creatNcompany"><i class="iconfont icon-anonymous-iconfont"></i> 添加新企业</a>
								<br /><span class="font-size-12 text-color-gray">您可能会选择：</span>
								<div id="rlist" style="width:600px;">
									<div id="c"><?php
										$newc = $db->select('companies',['id','companyname'],['ORDER'=>['id'=>'DESC'],'LIMIT'=>[0,4]]);
										foreach ($newc as $nv) {
											echo('<label class="rlable" data-id="'.$nv['id'].'">'.$nv['companyname'].'</label>');
										}
									?>
									</div>
									<div id="s" class="hide">
									<?php
										$newc = $db->select('customs',['id','name','mobile'],['ORDER'=>['id'=>'DESC'],'LIMIT'=>[0,4]]);
										foreach ($newc as $nv) {
											echo('<label class="rlable" data-id="'.$nv['id'].'">'.$nv['name'].$nv['mobile'].'</label>');
										}
									?>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">合同类型</label>
							<div class="form-filed-box" style="width:300px;">
								<select name="type" class="input input-w200">
									<?php 
										$t=$db->select('contract_type','*',['pid'=>0]);
										if($t){
											foreach ($t as $o) {
												if($m['type']==$o['id']){
													echo "<option selected='selected' value='".$o['id']."'>".$o['typename']."</option>";
												}else{
													echo "<option value='".$o['id']."'>".$o['typename']."</option>";
												}
											}
											
										}
									?>
								</select>
								
							</div>
							<div class="form-filed-msg" style="width:600px;max-width:600px;text-indent:0;">
								<div id="item"  class="<?php if($m['type']==3){echo('show'); }else{echo('hide');} ?>"><?php 
										$t = $db->select('contract_type','*',['pid'=>3]);
										if($t){
											foreach ($t as $o) {
												if($m['type']==$o['id']){
													echo "<span style='display:inline-block;width:150px;'><input type='checkbox' name='item[]' value='".$o['id']."'>".$o['typename'].'</span>';
												}else{
													echo "<span style='display:inline-block;width:150px;'><input type='checkbox' name='item[]' value='".$o['id']."' />".$o['typename'].'</span>';
												}
											}
											
										}
									?></div>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">付款周期</label>
							<div class="form-filed-box">
								<select name="paytype" class="input input-w200">
									<option value="一次性全款" <?php if($m){if($m['paytype']=='一次性全款'){echo "selected='selected'";}}?>>一次性全款</option>
									<option value="季付" <?php if($m){if($m['paytype']=='季付'){echo "selected='selected'";}}?>>季付</option>
									<option value="半年付" <?php if($m){if($m['paytype']=='半年付'){echo "selected='selected'";}}?>>半年付</option>
									<option value="年付" <?php if($m){if($m['paytype']=='年付'){echo "selected='selected'";}}?>>年付</option>
								</select>

							</div>
							<div class="form-filed-msg text-color-gray">
								
							</div>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">合同关联地区</label>
							<div class="form-filed-box" id="locaA">
								<select name="prov" class="input input-default prov"><option value="" code="">不限</option></select> -
                                <select name="city" class="input input-default city"><option value=""  code="">不限</option></select> -
                                <select name="area" class="input input-default area" datatype="*" nullmsg="请选择" errormsg="请选择"><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请选择合同所在地省市区。</div>
							<div class="clearfix"></div>
						</div>



						<div class="form-item">
							<label class="form-filed-name">合同期限</label>
							<div class="form-filed-box">
								<input type="date" name="start_day" value="<?php if($m){echo $m['start_day'];}else{echo(date('Y-m-d'));}?>" class="input" /> ~ 
								<input type="date" name="end_day" value="<?php if($m){echo $m['end_day'];}else{echo(date('Y-m-d'));}?>" class="input" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">合同总金额</label>
							<div class="form-filed-box">
								<input type="number" name="money_total" value="<?php if($m){echo $m['money_total'];}else{echo(0);}?>" class="input" /> 元

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">预付款</label>
							<div class="form-filed-box">
								<input type="number" name="money_before" value="<?php if($m){echo $m['money_before'];}else{echo(0);}?>" class="input" /> 元
							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">签单日期</label>
							<div class="form-filed-box">
								<input type="date" name="order_day" value="<?php if($m){echo $m['order_day'];}else{echo(date('Y-m-d'));}?>" class="input" />
							</div>
							
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">办理事务</label>
							<div class="form-filed-box">
							

								<textarea  name="content" class="textarea" style="width:400px;height:50px;"><?php if(isset($m) && $m!=''){echo($m['content']);}?></textarea>

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="more" class="textarea" style="width:400px;height:50px;"><?php if(isset($m) && $m!=''){echo($m['more']);}?></textarea>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">照片或扫描件</label>
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

						<div class="item-space"></div>

						<div class="form-item">
							<label class="form-filed-name">业务所属</label>
							<div class="form-filed-box" style="max-width: calc(70%);width:1300px;">
                                    <?php
                                        $y = $db->select('member_subcompany','*',['id'=>getac($_COOKIE['authoritySubc'])]);
                                        if($y){
                                            foreach ($y as $sc) {
                                                if($_COOKIE['subcomid'] == $sc['id']){
                                                   
                                                    echo "<label class='form-fbox-label'><input type='radio' checked='checked' name='ywoid' value='".$sc['id']."'/>".$sc['subcompanyname']."</label>";
                                                }else{
                                                    echo "<label class='form-fbox-label'><input type='radio' name='ywoid' value='".$sc['id']."'/>".$sc['subcompanyname']."</label>";
                                                }
                                            }
                                        }
                                    ?>
                               

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">业务员</label>
							<div class="form-filed-box" style="max-width: calc(70%);width:1300px;">
									
									<?php 
										$w=$db->select('member',[
											'[>]member_subcompany'=>['subcompany'=>'id']
											],[
											'member.id(id)',
											'member.name(name)',
											'member.mobile(mobile)',
											'member_subcompany.subcompanyname(subcname)'
											],[
											'AND'=>[
											'member.status'=>1,
											'member.isout'=>0,
											'member.subcompany'=>getac($_COOKIE['authoritySubc'])
											],
											'ORDER'=>['member.subcompany'=>'ASC','member.mobile'=>'ASC']
											]);
										if($w){
											foreach ($w as $wa) {
												if($m['ywuid'] == $wa['id']){
													echo "<label class='form-fbox-label'><input type='radio' checked='checked' name='ywuid' value='".$wa['id']."'/>".$wa['subcname'].'-'.$wa['name'].$wa['mobile']."</label>";
												}else{
													echo "<label class='form-fbox-label'><input type='radio' name='ywuid' value='".$wa['id']."'/>".$wa['subcname'].'-'.$wa['name'].$wa['mobile']."</label>";
												}
											}
										}
									?>
								

							</div>
							<div class="form-filed-msg text-color-gray"></div>
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
					
					<?php if($mid!=''){?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>contracts/save/<?php echo($mid);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>contracts/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            layer.msg(d.msg,{icon: 1,time: 2000,}, function(){
				            	window.location = '<?php echo($settings['renderer']['home_path']);?>contracts/detail/'+d.id; 
				            	return false;
							});
			            
			            return false;
			          }else{
			            layer.msg(d.msg,{icon: 0,time: 2000,}, function(){
				            	//window.location.reload();
				            	return false;
							});
			            
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
		<script type="text/javascript">
			$('.searchBtn').click(function(){
				$('#rlist').html('');
				var key = $('input[name="key"]').val();
				var type = $('input[name="utype"]:checked').val();
				if(key==''){
					layer.msg('关键词不能为空。',{icon: 0,time: 2000,});
					return false;
				}else{
					$.post('<?php echo($settings['renderer']['home_path']);?>contracts/form/searchkey',{'key':key,'type':type}, function(data){
			          var d = data;
			          console.log(d);
			          var tpl;
			          if(d.flag == 200){
			          	if(d.data.length>0){
				          	for(var i=0;i<d.data.length;i++){
				          		if(type==1){
				          			tpl = '<label class="rlable" data-id="'+d.data[i].id+'">'+d.data[i].companyname + "<label>";
				          		}else{
				          			tpl = '<label class="rlable" data-id="'+d.data[i].id+'">'+d.data[i].name +d.data[i].mobile+ "<label>";
				          		}
				          		$('#rlist').append(tpl);
				          	}
				            return false;
				        }else{
				        	$('#rlist').append('<span class="text-color-red">没有找到结果。</span>');
			          	}
			        }
			        });
				}
			});
			$('#rlist').on('click','.rlable',function(){
				var id = $(this).attr('data-id');
				var name = $(this).html();
				$('input[name="uid"]').val(id);
				$('#cname').html(name);
			});
			$('input[name="utype"]').click(function(){
				var type = $('input[name="utype"]:checked').val();
				if(type==1){
					$('#c').show();
					$('#s').hide();
				}else{
					$('#s').show();
					$('#c').hide();
				}
				$('input[name="uid"]').val('');
				$('#cname').html('')
			});
		</script>
		<script type="text/javascript">
			$('select[name="type"]').change(function(){
				var v = $('select[name="type"]').val();
				if(v == 3){
					$('#item').show();
				}else{
					$('#item').hide();
				}
			});
			$('.creatNcutom,.creatNcompany').click(function(){
				var href = $(this).attr('data-href');
				var dbox = layer.open({
				  	type: 2,
				  	title:false,
				  	area: ['1200px', '600px'],
				  	content:  [href, 'yes'],
				  	end:function(){
						window.location.reload();
						return false;
					}
				});
			});
		</script>
	</body>
</html>
