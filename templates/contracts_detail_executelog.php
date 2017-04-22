<?php 
	require 'header.php';
?>
	<body>
	<?php require 'head.php';?>
	<?php $modelNo = 1; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-hetong"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						编号 [ <span class="text-color-red"><?php echo($m['cno']);?></span> ] 的合同款项成本
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						该合同于 [ <span class="text-color-red"><?php echo($m['creattime']);?></span> ] 被录入，录入人 [ <span class="text-color-red"><?php echo($m['staffCompany']);?> - <?php echo($m['staffName']);?> - <?php echo($m['staffMobile']);?></span> ]
						
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=3;  require 'contracts_detail_nav.php';?>
					</div>
					<div class="infobox">
						<table class="table" width="100%">
							<thead>
								<tr>
									<th>签约主体</th>
									<th>合同类型</th>
									<th>执行周期</th>
									<th>业务员</th>
									<th>执行人</th>
									<th>当前状态</th>
									<th>到计时</th>
									<th width="200">执行人操作</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php  if($m['utype']==1){ ?>
										<a class="text-color-blue" target="_blank" href="<?php echo($settings['renderer']['home_path']);?>companies/detail/<?php echo $m['uid'];?>"><?php echo($m['coname']);?></a>

											<span class="text-color-green">{ <?php echo($m['couser']);?> }</span>

									<?php	}else{ ?>
										[个人] <a class="text-color-blue" target="_blank" href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo $m['uid'];?>"><?php echo($m['cuname']);?></a> <span class="text-color-green">[ <?php echo($m['cumobile']);?> ]</span>
									<?php	} ?></td>
									<td>
										<?php echo($m['typename']);?>
									<?php 
										if(is_serialized($m['item']) == true){
											echo('[<span class="text-color-blue"> ');
											foreach (unserialize($m['item']) as $o) {
												$ct = $db->get('contract_type','*',['id'=>$o]);
												if($ct){
													echo $ct['typename'].', ';
												}
											}
											echo('</span> ]');
										}
									?>
									</td>
									<td><?php echo($m['start_day']);?> ~ <?php echo($m['end_day']);?></td>
									<td>
										<?php echo $m['owenSubCompany'];?> - <?php echo $m['owenSaler'];?>
									</td>
									<td>
										<?php echo($m['runerCompany']);?> - <?php echo($m['owenRuner']);?>
										
									</td>
									<td>
										<?php echo($m['statusname']);?>
									</td>
									<td>
									</td>
									<td>
										<a data-cid="<?php echo($m['id']);?>" class="btn btn-link btn-red addrun"><i class="iconfont icon-anonymous-iconfont"></i> 添加合同执行进度</a>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="pull-left" style="width:calc(50% - 40px);padding:0 20px;background:#fff;height:calc(100% - 88px);overflow:auto;">
							<div class="timeline">
							<?php if($runlog){
								foreach ($runlog as $l) { ?>
									<div class="timeline-item">
										<div class="timeline-timebox">
											<span class="font-size-18"><?php echo(date('H:i',strtotime($l['creatTime'])));?></span>
											<br />
											<span class="font-size-12"><?php echo(date('m月d日',strtotime($l['creatTime'])));?></span>
										</div>
										<div class="timeline-body">
											<a data-cid="<?php echo($m['id']);?>" data-id="<?php echo($l['id']);?>" class="pull-right editrun"><i class="iconfont icon-bianji1"></i></a>
											<div class="font-size-14">
												进度：
												<?php if($m['type'] == 1){
													echo('[ '.$l['month'].' ]');
												}?>
												<?php if($l['text']!=''){?>
												<span class="text-color-green"><?php echo($l['text']);?></span>
												<?php } ?>
												<div class="runpics">
													<?php 
														if($l['pics']!=''){
														foreach (json_decode($l['pics']) as $i) {
														$t = getpicbyId($i);
													?>
														<a target="_blank" href="<?php echo($settings['renderer']['home_path'].$t['uri']);?>">
														<img width="48" height="48" src="<?php echo($settings['renderer']['home_path'].$t['thumbnail']);?>"  />
														</a>
													
													<?php }}?>

													<?php if($l['img1']!=''){?>
														<a target="_blank" href="<?php echo($l['img1']);?>"><img width="48" height="48" src="<?php echo($l['img1']);?>"  />
														</a>
													<?php }?>
													<?php if($l['img2']!=''){?>
														<a target="_blank" href="<?php echo($l['img2']);?>"><img width="48" height="48" src="<?php echo($l['img2']);?>"  />
														</a>
													<?php }?>
													<?php if($l['img3']!=''){?>
														<a target="_blank" href="<?php echo($l['img3']);?>"><img width="48" height="48" src="<?php echo($l['img3']);?>"  />
														</a>
													<?php }?>
													<?php if($l['img4']!=''){?>
														<a target="_blank" href="<?php echo($l['img4']);?>"><img width="48" height="48" src="<?php echo($l['img4']);?>"  />
														</a>
													<?php }?>
													<?php if($l['img5']!=''){?>
														<a target="_blank" href="<?php echo($l['img5']);?>"><img width="48" height="48" src="<?php echo($l['img5']);?>"  />
														</a>
													<?php }?>
													<?php if($l['img6']!=''){?>
														<a target="_blank" href="<?php echo($l['img6']);?>"><img width="48" height="48" src="<?php echo($l['img6']);?>"  />
														</a>
													<?php }?>
												</div>
											</div> 
											
											<div class="timeline-body-meta font-size-12 text-color-gray">
												<i class="iconfont icon-wo"></i> 
												
												执行人：<?php echo($l['m1Company']);?>  - <?php echo($l['m1name']);?> 
												
													
											
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
							<?php } } ?>
							</div>
						</div>
						<div class="pull-right" style="width:calc(50% - 41px);padding:0 20px;background:#fff;height:calc(100% - 88px);overflow:auto;">
							<div class="timeline">
							<?php if($pailog){
								foreach ($pailog as $l) { ?>
									<div class="timeline-item">
										<div class="timeline-timebox">
											<span class="font-size-18"><?php echo(date('H:i',strtotime($l['creatTime'])));?></span>
											<br />
											<span class="font-size-12"><?php echo(date('m月d日',strtotime($l['creatTime'])));?></span>
										</div>
										<div class="timeline-body">
											<div class="font-size-16">
												<?php if($l['type']==0){echo('派单给员工：');}else{echo('派单退回：');}?>
												<span class="text-color-red"><?php echo($l['m2Company']);?> - <?php echo($l['m2name']);?></span>
											</div>
											<?php if($l['text']!=''){?>
												<div class="text-color-blue font-size-12" style="padding-top:5px;padding-left:2px;">备注：<?php echo($l['text']);?></div>
												<?php } ?>
											<div class="timeline-body-meta font-size-12 text-color-gray">
												<i class="iconfont icon-wo"></i> 
												
												操作人：<?php echo($l['m1Company']);?> - <?php echo($l['m1name']);?>
												
											
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
							<?php } } ?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.addrun').click(function(){
					var cid = $(this).attr('data-cid');
					var op = layer.open({
					  	type: 2,
					  	title:'添加合同执行进度',
					  	area: ['860px', '480px'],
					  	content:  ['<?php echo($settings['renderer']['home_path']);?>contracts/runform/'+cid, 'yes'],
					  	cancel:function(){
							window.location.reload();
							return false;
						}
					});
				});
				$('.editrun').click(function(){
					var cid = $(this).attr('data-cid');
					var id = $(this).attr('data-id');
					var op = layer.open({
					  	type: 2,
					  	title:'编辑历史进度',
					  	area: ['860px', '480px'],
					  	content:  ['<?php echo($settings['renderer']['home_path']);?>contracts/runform/'+cid+'/'+id, 'yes'],
					  	cancel:function(){
							window.location.reload();
							return false;
						},
						end:function(){
							window.location.reload();
							return false;
						}
					});
				});
			});
		</script>
		
	</body>
</html>
