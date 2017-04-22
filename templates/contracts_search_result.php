<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=3; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-sousuo"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						当前 [ <span class="text-color-red">合同</span> ] 搜索结果，您设定的关键词为：<span class="text-color-red"><?php echo($key);?></span>，
						总计 <span class="text-color-red"><?php echo(count($list));?></span> 个结果。
						如需重新搜索，请点 <a href="<?php echo($settings['renderer']['home_path']);?>contracts/search" class="text-color-red">返回</a>。
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
				</div>
				<div class="box-body">
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>合同编号</th>
									<th>签约主体</th>
									<th>业务类型</th>
									<th>执行周期</th>
									<th>合同金额</th>
									<th>入帐金额</th>
									<th>余款</th>
									<th>业务所属</th>
									<th>业务员</th>
									<th>执行人</th>
									<th>签约时间</th>
									<th>状态</th>
									<th width="200">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr>
								<td width="50"><?php echo($o['id']);?></td>
								<td><?php echo($o['cno']);?></td>
								<td class="text-left">
									<?php  if($o['utype']==1){ ?>
										<a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>companies/detail/<?php echo $o['uid'];?>"><?php echo($o['coname']);?></a>
									<?php	}else{ ?>
										<a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo $o['uid'];?>"><?php echo($o['cuname']);?></a> [个人]
									<?php	} ?>
								</td>
								<td><?php echo($o['typename']);?></td>
								<td><?php echo($o['start_day']);?> ~ <?php echo($o['end_day']);?></td>
								<td><?php echo($o['money_total']);?></td>
								<td><?php echo($o['money_ok']);?></td>
								<td class="text-color-red"><?php echo(sprintf("%.2f",$o['money_total']-$o['money_ok']));?></td>
								<td><?php echo $o['owenSubCompany'];?></td>
								<td><?php echo $o['owenSaler'];?></td>
								<td><?php echo($o['owenRuner']);?></td>
								<td><?php echo($o['order_day']);?></td>
								<td class="text-left"><?php echo($o['statusname']);?></td>
								<td class="text-left">
									<a href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
									<?php if($o['status']!=6 && $o['status']!=7){?>
									<a href="<?php echo($settings['renderer']['home_path']);?>contracts/form/<?php echo $o['id'];?>" class="btn btn-link btn-red">编辑</a>
									
									<?php } ?>
									<?php if($o['status']==1 || $o['status']==2 || $o['status']==5){?>
									<a href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $o['id'];?>/bookingandcost" class="btn btn-link btn-oranage">款项</a>
									<?php } ?>
									<?php if($o['status']==4 || $o['status']==5){?>
									<a href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $o['id'];?>/executelog" class="btn btn-link btn-blue">进度</a>
									<?php } ?>
									
									<?php if($o['status']==1){?>
										<a data-id="<?php echo $o['id'];?>" class="btn btn-link btn-white close">关闭</a>
									<?php } ?>
								</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						
					</div>
					<div class="height10"></div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#getstatus').change(function(){
					var sid = $(this).val();
					if(sid!=''){
						window.location = "<?php echo($settings['renderer']['home_path'].'contracts/');?>"+sid;
					}else{
						window.location = "<?php echo($settings['renderer']['home_path'].'contracts');?>";
					}
				});

				$('.close').click(function(){
					var id = $(this).attr('data-id');
					op = layer.open({
					  	type: 1,
					  	title:'请输入关闭合同的原因',
					  	area: ['500px', '200px'],
					  	content:  $('#box'), //数组第二项即吸附元素选择器或者DOM
					  	btn: ['确定', '取消'],
					  	btn2: function(index, layero){
	    					console.log('b');
	    					layer.close(op);
	    					$('textarea[name=message]').val('');
						},
						btn1:function(index, layero){
						  console.log('确定');
						  var msg=$('textarea[name=message]').val();
						  console.log(msg);
						  $.post('<?php echo($settings['renderer']['home_path']);?>contracts/close/'+id,{'msg':msg}, function(data){
					          var d = data;
					          console.log(d);
					          if(d.flag == 200){
					          	layer.close(op);
					            alert(d.msg);
					            window.location.reload();
					          }else{
					            alert(d.msg);
					          }
					        }); 
						}
					});
					
				});
			});
		</script>
		
	</body>
</html>
