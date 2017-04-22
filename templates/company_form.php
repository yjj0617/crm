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
							添加企业
						<?php }else{?>
							编辑企业，企业ID： <?php echo($mid);?>，企业名：<?php echo($m['companyname']);?>
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
							<label class="form-filed-name">企业名称</label>
							<div class="form-filed-box">
								<input type="text" name="companyname" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['companyname']);}?>" datatype="s2-16" errormsg="格式：2～16个字符" />
							</div>
							<div class="form-filed-msg text-color-gray">
								<i class="iconfont icon-gantanhao text-color-red"></i> 请填写企业全称
								<span class="w25"></span>
								<a href="http://www.gsxt.gov.cn/index.html" target="_blank" class="text-color-blue">[ 查询企业公示信息 ]</a>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">简称</label>
							<div class="form-filed-box">
								<input type="text" name="decname" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['decname']);}?>" datatype="s2-8" errormsg="格式：2～6个字符" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 2～6字的企业简称</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">企业类别</label>
							<div class="form-filed-box">
								<select name="ctype" class="input input-default">
									<option value="0" <?php if($m){ if($m['ctype']==0){echo 'selected="selected"';}}?>>小规模</option>
									<option value="1" <?php if($m){ if($m['ctype']==1){echo 'selected="selected"';}}?>>一般纳税人</option>
									<option value="2" <?php if($m){ if($m['ctype']==2){echo 'selected="selected"';}}?>>其它</option>
								</select>
							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">营业执照编号</label>
							<div class="form-filed-box">
								<input type="text" name="cno" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['cno']);}?>" datatype="*" errormsg="不能为空"  />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的营业执照编号。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">税务登记证号</label>
							<div class="form-filed-box">
								<input type="text" name="swno" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['swno']);}?>" datatype="*" errormsg="不能为空"  />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请填写真实有效的税务登记证号。</div>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">工商所在地</label>
							<div class="form-filed-box" id="locaA">
								<select name="prov" class="input input-default prov"><option value="" code="">不限</option></select> -
                                <select name="city" class="input input-default city"><option value=""  code="">不限</option></select> -
                                <select name="area" class="input input-default area" datatype="*" nullmsg="请选择" errormsg="请选择"><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入工商所在地省市区。</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">工商注册地址</label>
							<div class="form-filed-box">
								<input type="text" name="address" class="input input-default input-w400" value="<?php if(isset($m) && $m!=''){echo($m['address']);}?>" datatype="*5-30" errormsg="格式：请填写6到16位任意字符"  />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">注册日期</label>
							<div class="form-filed-box">
								<input type="date" name="companyctime" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['companyctime']);}?>" datatype="day" errormsg="格式：2017-03-24" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">联系人</label>
							<div class="form-filed-box">
								<input type="text" readonly="readonly" name="customs" class="input input-w200" value="<?php if(isset($m) && $m!=''){echo($m['customs']);}?>" />
								<input type="text" readonly="readonly" name="customsid" class="input input-w200" value="<?php if(isset($m) && $m!=''){echo($m['customsid']);}?>" datatype="*" errormsg="请先关联联系人" />
								<button type="button" class="btn btn-red" id="choosecustom">选择</button>

								<span class="w50"></span>
								<a data-href="<?php echo($settings['renderer']['home_path']);?>customs/form" class="btn btn-oranage creatNcutom"><i class="iconfont icon-anonymous-iconfont"></i> 添加新客户</a>
							</div>
							<div class="form-filed-msg text-color-gray"></div>
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
							<label class="form-filed-name">注册资本金</label>
							<div class="form-filed-box">
								<input type="text" name="companym" class="input input-w400" value="<?php if(isset($m) && $m!=''){echo($m['companym']);}?>"  />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">企业法人</label>
							<div class="form-filed-box">
								<input type="text" name="fr" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['fr']);}?>"  />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">所属行业</label>
							<div class="form-filed-box">
								<input type="text" name="hy" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['hy']);}?>" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">主要营业范围</label>
							<div class="form-filed-box">
								<textarea  name="content" class="textarea" style="width:400px;height:80px;"><?php if(isset($m) && $m!=''){echo($m['content']);}?></textarea>

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>


						
						<div class="item-space"></div>
						
						<div class="form-item">
							<label class="form-filed-name">办公所在地</label>
							<div class="form-filed-box" id="locaB">
								<select name="bgprov" class="input input-default prov"><option value="" code="">不限</option></select> -
                                <select name="bgcity" class="input input-default city"><option value=""  code="">不限</option></select> -
                                <select name="bgarea" class="input input-default area" ><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入办公所在地省市区。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">办公地址</label>
							<div class="form-filed-box">
								<input type="text" name="bgaddress" class="input input-w400" value="<?php if(isset($m) && $m!=''){echo($m['bgaddress']);}?>"  />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">国税</label>
							<div class="form-filed-box text-color-red" style="max-width: calc(55%)">
								帐号：<input type="text" name="na" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['na']);}?>" />
								<span class="w15"></span>
								密码：<input type="text" name="napwd" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['napwd']);}?>" />
								<span class="w15"></span>
								税盘到期日：<input type="date" name="na_end_day" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['na_end_day']);}?>" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">地税</label>
							<div class="form-filed-box text-color-red" >
								帐号：<input type="text" name="nb" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['nb']);}?>" />
								<span class="w15"></span>
								密码：<input type="text" name="nbpwd" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['nbpwd']);}?>" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">VPDN</label>
							<div class="form-filed-box text-color-red" style="max-width: calc(55%)">
								帐号：<input type="text" name="vpn" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['vpn']);}?>" />
								<span class="w15"></span>
								密码：<input type="text" name="vpnpwd" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['vpnpwd']);}?>" />
								<span class="w15"></span>
								VPDN到期日：<input type="date" name="vpn_end_day" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['vpn_end_day']);}?>" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>
						<div class="form-item">
							<label class="form-filed-name">网上办事</label>
							<div class="form-filed-box text-color-red" >
								帐号：<input type="text" name="webpname" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['webpname']);}?>" />
								<span class="w15"></span>
								密码：<input type="text" name="webppwd" class="input input-default" value="<?php if(isset($m) && $m!=''){echo($m['webppwd']);}?>" />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">其它</label>
							<div class="form-filed-box text-color-red" >
								发票是否我司认证：<input type="checkbox" name="fp" value="1" <?php if(isset($m) && $m!='' && $m['fp']==1){echo('checked="checked"');}?> />
								<span class="w15"></span>
								是否代拿回单：<input type="checkbox" name="hds" value="1" <?php if(isset($m) && $m!='' && $m['hds']==1){echo('checked="checked"');}?> />
								<span class="w15"></span>
								是否上门取票：<input type="checkbox" name="qp" value="1" <?php if(isset($m) && $m!='' && $m['qp']==1){echo('checked="checked"');}?> />

							</div>
							<div class="form-filed-msg text-color-gray"></div>
							<div class="clearfix"></div>
						</div>


						<div class="item-space"></div>
						<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="more" class="textarea" style="width:400px;height:50px;"><?php if(isset($m) && $m!=''){echo($m['more']);}?></textarea>
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
		<div id="pop" class="hide">
			<div class="popbox-head">
				<span class="pull-right"><form method="post" id="s"><input type="text" name="key" class="input input-default" placeholder="手机号或客户姓名" />
					<button type="button" class="btn btn-red" id="searchCustom">搜索</button></form></span>
					<span class="text-color-red">最新录入的30个客户，若无目标客户，请使用右边搜索。</span>
					<div class="clearfix"></div>
			</div>
			<div class="popbox-body">
				<div class="choosecustoms-list">
					<?php 
						$scid = $_COOKIE['subcomid'];
						$cs = $db->select('customs',['id','name','mobile'],[
								'subc' => $scid,
								'ORDER'=>['id'=>'DESC'],
								'LIMIT'=>[0,30]
							]);
						foreach ($cs as $k) {?>
							<label>
							<input type="checkbox" name="customid" data-id="<?php echo($k['id']);?>" data-name="<?php echo($k['name']);?>" /> 
							<?php echo($k['name']);?>
							<?php echo($k['mobile']);?>
							</label>
					<?php }?>
				</div>
			</div>
		</div>
		<?php require 'js.php';?>
		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/select.js"></script>

		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/Validform_v5.3.2.js"></script>
		<script type="text/javascript">
			$('#choosecustom').click(function(){
				var op = layer.open({
					  	type: 1,
					  	title:'企业关联联系人',
					  	area: ['800px', '460px'],
					  	content: $('#pop')
					});
			});
			$(document).on('click','input[name="customid"]',function(){
				var val ='';
				var id = '';
				console.log($(this));
				$('input[name="customid"]').each(function(){
					if($(this).is(":checked")){
						val = val + $(this).attr('data-name') + ',';
						id = id + $(this).attr('data-id') + ',';
					}
				});
				$('input[name="customs"]').val(val);
				$('input[name="customsid"]').val(id);

			});
			$('#searchCustom').click(function(){
				
				$.post('<?php echo($settings['renderer']['home_path']);?>customs/searchJSON',$('#s').serialize(), function(data){
					$('.choosecustoms-list').html('');
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			          	var html ='';
			            var tpl = '';
			            for(var i=0;i<d.data.length;i++){
			            	tpl = '<label><input type="checkbox" name="customid" data-id="'+d.data[i].id+'" data-name="'+d.data[i].name+'" />'+d.data[i].name+''+d.data[i].mobile+'</label>';
			            	html = html + tpl;
			            }
			            $('.choosecustoms-list').html(html);
			            return false;
			          }else{
			           	$('.choosecustoms-list').html('没有匹配的客户。');
			          }
			        });
			});
		</script>
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
					var uri = '<?php echo($settings['renderer']['home_path']);?>companies/save/<?php echo($mid);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>companies/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            layer.msg(d.msg,{icon: 1,time: 2000,}, function(){
				            	window.location = '<?php echo($settings['renderer']['home_path']);?>companies/detail/'+d.id; 
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
			pca('#locaA','<?php if(isset($m) && $m!=''){echo($m['prov']);}else{echo('浙江省');}?>','<?php if(isset($m) && $m!=''){echo($m['city']);}else{echo('杭州市');}?>','<?php if(isset($m) && $m!=''){echo($m['area']);}else{echo('西湖区');}?>');

			pca('#locaB','<?php if(isset($m) && $m!=''){echo($m['bgprov']);}else{echo('浙江省');}?>','<?php if(isset($m) && $m!=''){echo($m['bgcity']);}else{echo('杭州市');}?>','<?php if(isset($m) && $m!=''){echo($m['bgarea']);}else{echo('西湖区');}?>');

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
   			$('.creatNcutom').click(function(){
				var href = $(this).attr('data-href');
				var dbox = layer.open({
				  	type: 2,
				  	title:false,
				  	area: ['1000px', '500px'],
				  	content:  [href, 'yes'],
				  	end:function(){
						//window.location.reload();
						return false;
					}
				});
			});
		</script>
		
	</body>
</html>
