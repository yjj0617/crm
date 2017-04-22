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
							添加商机
						<?php }else{?>
							编辑商机，商机ID： <?php echo($m['id']);?>
						<?php } ?>
					</div>
					<div class="pull-right">
						
					</div>
				</div>
				<div class="box-body">
					<div class="form">
						<form id="mform" method="post">
						<div class="form-item">
							<label class="form-filed-name">客户姓名</label>
							<div class="form-filed-box">
								<input type="text" name="name" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['uname']);}?>" datatype="s2-8" errormsg="格式：1～8个字符" />
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 客户姓名尽量填写真实有效的姓名。</div>
							<div class="clearfix"></div>
						</div>

						

						<div class="form-item">
							<label class="form-filed-name">联系方式</label>
							<div class="form-filed-box">
								<input type="text" name="mobile" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['mobile']);}?>" />

							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请尽可能填写客户的手机号码。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">业务类型</label>
							<div class="form-filed-box">
								<select name="cateId" class="input input-default">
									<?php if($ctype){
										foreach ($ctype as $c) { if($c['pid']==0){?>
									<option value="<?php echo($c['id']);?>"><?php echo($c['typename']);?></option>
									<?php }}} ?>
								</select>
								<select name="item" class="input input-default hide">
									<option value="0">请选择</option>
									<?php if($ctype){
										foreach ($ctype as $c) { if($c['pid']==3){?>
									<option value="<?php echo($c['id']);?>"><?php echo($c['typename']);?></option>
									<?php }}} ?>
								</select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请选择客户咨询的业务类型。</div>
							<div class="clearfix"></div>
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">客户所在地</label>
							<div class="form-filed-box" id="locaA">
								<select name="prov" class="input input-default prov"><option value="" code="">不限</option></select> -
                                <select name="city" class="input input-default city"><option value=""  code="">不限</option></select> -
                                <select name="area" class="input input-default area" ><option value=""  code="">不限</option></select>
							</div>
							<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 请输入客户所在地省市区。</div>
							<div class="clearfix"></div>
						</div>

						<div class="form-item">
							<label class="form-filed-name">业务渠道</label>
							<div class="form-filed-box">
								<input type="text" name="qd" class="input input-default input-w250" value="<?php if(isset($m) && $m!=''){echo($m['qd']);}?>" />
							</div>
							<div class="clearfix"></div>
						</div>
						

						<div class="form-item">
							<label class="form-filed-name">&nbsp;</label>
							<div class="form-filed-msg no-text-indent text-color-red"><i class="iconfont icon-gantanhao text-color-red"></i> 注意，以上信息必须全部填写。</div>
							<div class="clearfix"></div>
						</div>

						
						
						

						

						<div class="form-item">
							<label class="form-filed-name">内容或备注</label>
							<div class="form-filed-box">
								<textarea  name="text" class="input input-default" style="width:400px;height:50px;"><?php if(isset($m) && $m!=''){echo($m['text']);}?></textarea>
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
			
			$('select[name="cateId"]').change(function(){
				var cId = $(this).val();
				if(cId==3){
					$('select[name="item"]').show();
				}else{
					$('select[name="item"]').hide();
					$('select[name="item"]').val(0);
				}
			});

			$("#mform").Validform({
				tiptype:3,
				btnSubmit:"#submit", 
				showAllError:true,
				postonce:true,
				ajaxPost:false,
				beforeSubmit:function(curform){
					
					<?php if($mid!=''){?>
					var uri = '<?php echo($settings['renderer']['home_path']);?>opportunity/save/<?php echo($mid);?>';
					<?php } else{?>
						var uri = '<?php echo($settings['renderer']['home_path']);?>opportunity/save';
					<?php }?>

					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            alert(d.msg);
			            window.location = '<?php echo($settings['renderer']['home_path']);?>opportunity'; 
			            return false;
			          }else{
			            alert(d.msg);
			            window.location.reload();
			          }
			        });
				}
			});
			pca('#locaA','<?php if(isset($m) && $m!=''){echo($m['prov']);}else{echo('浙江省');}?>','<?php if(isset($m) && $m!=''){echo($m['city']);}else{echo('杭州市');}?>','<?php if(isset($m) && $m!=''){echo($m['area']);}else{echo('西湖区');}?>');

		</script>
		
	</body>
</html>
