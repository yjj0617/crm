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
						<i class="iconfont icon-baobiao"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						总客户数：<span class="text-color-red"><?php echo($count['all']);?></span> 人
					</div>
					<div class="pull-left" style="padding-left:20px;">
						[ 线下录入：<span class="text-color-red"><?php echo($count['offline']);?></span> 人
					</div>
					<div class="pull-left" style="padding-left:20px;">
						微信注册：<span class="text-color-red"><?php echo($count['wechat']);?></span> 人
					</div>
					<div class="pull-left" style="padding-left:20px;">
						网站注册：<span class="text-color-red"><?php echo($count['website']);?></span> 人 ]
					</div>
					<div class="pull-left" style="padding-left:50px;">
						本月新增：<span class="text-color-red"><?php echo($count['thismonth']);?></span> 人
					</div>
					<div class="pull-left" style="padding-left:50px;">
						今日新增：<span class="text-color-red"><?php echo($count['today']);?></span> 人
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<a href="<?php echo($settings['renderer']['home_path'].'customs/0');?>" <?php if($from==0){echo('class="active"');}?>>线下录入</a>
						<a href="<?php echo($settings['renderer']['home_path'].'customs/1');?>" <?php if($from==1){echo('class="active"');}?>>微信注册</a>
						<a href="<?php echo($settings['renderer']['home_path'].'customs/2');?>" <?php if($from==2){echo('class="active"');}?>>网站注册</a>
					</div>
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>姓名</th>
									<th>手机号</th>
									<th>备用手机</th>
									<th>所属分公司</th>
									<th>业务员</th>
									<th>所在地</th>
									<th>录入时间</th>
									<th>状态</th>
									<th width="220">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr <?php if($o['status']==1){echo 'style="text-decoration: line-through;"';}?>>
								<td><?php echo($o['id']);?></td>
								<td><?php echo($o['name']);?></td>
								<td><?php echo($o['mobile']);?></td>
								<td><?php echo($o['mobile2']);?></td>
								<td><?php echo($o['owenSubCompany']);?></td>
								<td><?php echo($o['owenSaler']);?></td>
								<td><?php echo($o['prov']);?> - <?php echo($o['city']);?> - <?php echo($o['area']);?></td>
								
								<td><?php echo($o['creattime']);?></td>
								<td><?php if($o['status']==0){echo('正常');}else{echo('已关闭');} ?></td>
								<td>
									<a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo($o['id']);?>" class="btn btn-link btn-gray">查看</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>sms/push/<?php echo($o['mobile']);?>" class="btn btn-link btn-green">发短信</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>customs/form/<?php echo($o['id']);?>" class="btn btn-link btn-red">编辑</a>
									<a data-id="<?php echo($o['id']);?>" class="btn btn-link btn-white close">关闭</a>
								</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<?php
							if($from==0){
								$counts = $count['offline'];
							}elseif($from==1){
								$counts = $count['wechat'];
							}elseif($from==2){
								$counts = $count['website'];
							}
							
							pagenavi($settings['renderer']['home_path'].'customs',$p,$counts,10,"$from");
						?>
					</div>
				</div>
			</div>
		</section>
		<div id="box" class="opbox hide">
			<textarea class="font-size-14"  name="message" style="width:100%;height:75px;border:none;" placeholder="请输入"></textarea></div>
		</div>
		<?php require 'js.php';?>
	
		<script type="text/javascript">
			$(document).ready(function(){
				$('.close').click(function(){
					var id=$(this).attr('data-id');
					op = layer.open({
					  	type: 1,
					  	title:'请输入关闭客户的原因',
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
						  $.post('<?php echo($settings['renderer']['home_path']);?>customs/close/'+id,{'msg':msg}, function(data){
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
