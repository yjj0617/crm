<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=1; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-kehu"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						企业 [ <span class="text-color-red"><?php echo($m['companyname']);?></span> ] 的详细资料
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						该企业于 [ <span class="text-color-red"><?php echo($m['creattime']);?></span> ]
						<?php echo('，由 [ <span class="text-color-red">'.$m['staffCompany'].' - '.$m['staffName']).' - '.$m['staffMobile'].'</span> ] 录入。'; ?>
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=0;  require 'company_detail_nav.php';?>
					</div>
					<div class="infobox">
						<div class="cells">
							<div class="cells-item">
								<label class="cells-filed-name">ID</label>
								<div class="cells-filed-box">
									<span class="pull-right">
										<a href="<?php echo($settings['renderer']['home_path']);?>companies/form/<?php echo $m['id'];?>" class="btn btn-link btn-red">编辑基本信息</a>
										
									</span>
									
									<?php echo($m['id']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">企业名称</label>
								<div class="cells-filed-box">
									<?php 
										echo($m['companyname']);
										if($m['status']==0){
											echo(' <span class="text-color-gray">[正常]</span>');
										}else{
											echo(' <span class="text-color-gray">[已关闭]</span>');
										}
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">简称</label>
								<div class="cells-filed-box"><?php echo($m['decname']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">企业类别</label>
								<div class="cells-filed-box">
									<?php if($m['ctype'] == 0){
											echo('小规模');
										}elseif($m['ctype'] == 1){
											echo('一般纳税人');
										}else{
											echo('其它');
										}?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">营业执照编号</label>
								<div class="cells-filed-box">
									<?php echo($m['cno']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">税务登记证号</label>
								<div class="cells-filed-box"><?php echo($m['swno']);?></div>
								<div class="clearfix"></div>
							</div>
							
							<div class="cells-item">
								<label class="cells-filed-name">工商所在地</label>
								<div class="cells-filed-box"><?php echo($m['prov']);?>-<?php echo($m['city']);?>-<?php echo($m['area']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">工商注册地址</label>
								<div class="cells-filed-box"><?php echo($m['address']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">注册日期</label>
								<div class="cells-filed-box"><?php echo($m['companyctime']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">联系人</label>
								<div class="cells-filed-box">
									<?php if($m['customsid'][0]!=0){?><a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo($m['customsid'][0]);?>" target="_blank" class="btn btn-green"><?php echo($m['customs'][0]);?></a><?php }?>
									<?php if($m['customsid'][1]!=0){?><a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo($m['customsid'][1]);?>" target="_blank" class="btn btn-green"><?php echo($m['customs'][1]);?></a><?php }?>
									<?php if($m['customsid'][2]!=0){?><a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo($m['customsid'][2]);?>" target="_blank" class="btn btn-green"><?php echo($m['customs'][2]);?></a><?php }?>
									<?php if($m['customsid'][3]!=0){?><a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo($m['customsid'][3]);?>" target="_blank" class="btn btn-green"><?php echo($m['customs'][3]);?></a><?php }?>
									<?php if($m['customsid'][4]!=0){?><a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo($m['customsid'][4]);?>" target="_blank" class="btn btn-green"><?php echo($m['customs'][4]);?></a><?php }?>
									
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">关联的业务员</label>
								<div class="cells-filed-box"><?php echo($m['owenSubCompany'].' - '.$m['owenSaler']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">注册资本金</label>
								<div class="cells-filed-box"><?php echo($m['companym']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">企业法人</label>
								<div class="cells-filed-box"><?php echo($m['fr']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">所属行业</label>
								<div class="cells-filed-box"><?php echo($m['hy']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">主要营业范围</label>
								<div class="cells-filed-box"><?php echo($m['content']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">办公所在地</label>
								<div class="cells-filed-box"><?php echo($m['bgprov']);?> - <?php echo($m['bgcity']);?> - <?php echo($m['bgarea']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">办公地址</label>
								<div class="cells-filed-box"><?php echo($m['bgaddress']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">国税</label>
								<div class="cells-filed-box">
									<span class="text-color-blue">帐号：</span><?php echo($m['na']);?>
									<span class="w15"></span>
									<span class="text-color-blue">密码：</span><?php echo($m['napwd']);?>
									<span class="w15"></span>
									<span class="text-color-blue">税盘到期日：</span><?php echo($m['na_end_day']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">地税</label>
								<div class="cells-filed-box">
									<span class="text-color-blue">帐号：</span><?php echo($m['nb']);?>
									<span class="w15"></span>
									<span class="text-color-blue">密码：</span><?php echo($m['nbpwd']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">VPDN</label>
								<div class="cells-filed-box">
									<span class="text-color-blue">帐号：</span><?php echo($m['vpn']);?>
									<span class="w15"></span>
									<span class="text-color-blue">密码：</span><?php echo($m['vpnpwd']);?>
									<span class="w15"></span>
									<span class="text-color-blue">VPDN到期日：</span><?php echo($m['vpn_end_day']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">网上办事</label>
								<div class="cells-filed-box">
									<span class="text-color-blue">帐号：</span><?php echo($m['webpname']);?>
									<span class="w15"></span>
									<span class="text-color-blue">密码：</span><?php echo($m['webppwd']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">其它</label>
								<div class="cells-filed-box">
									<span class="text-color-blue">发票是否我司认证：</span><?php if($m['fp']==1){echo('是');}else{echo('否');}?>
									<span class="w15"></span>
									<span class="text-color-blue">是否代拿回单：</span><?php if($m['hds']==1){echo('是');}else{echo('否');}?>
									<span class="w15"></span>
									<span class="text-color-blue">是否上门取票：</span><?php if($m['qp']==1){echo('是');}else{echo('否');}?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">备注</label>
								<div class="cells-filed-box"><?php echo($m['more']);?></div>
								<div class="clearfix"></div>
							</div>
							
							<div class="cells-item">
								<label class="cells-filed-name">图片与照片</label>
								<div class="cells-filed-box">
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

								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		
	</body>
</html>
