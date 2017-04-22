<?php 
	require 'header.php';
?>
	<body style="background:#fff;animation:anshow 1s 1;">
		<section style="padding:20px;width:calc(100% - 40px);height:calc(100% - 40px);">
			<div class="response-page">
				<div class="form">
					<form id="mform" method="post">
					
					<div class="form-item">
						<label class="form-filed-name">详细填写日报内容</label>
						<div class="form-filed-box">
							<script id="editor" type="text/plain" style="width:640px;height:220px;"></script>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="form-item form-item-btn">
						<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 保存</button>
					</div>
					</form>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript" charset="utf-8" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/editor/ueditor.config.js"></script>
	    <script type="text/javascript" charset="utf-8" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/editor/ueditor.all.min.js"> </script>
	    <script type="text/javascript" charset="utf-8" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/editor/lang/zh-cn/zh-cn.js"></script>
		<script type="text/javascript">
			var ue = UE.getEditor('editor',{
					zIndex:999999,
					maximumWords:10000000,
					toolbars: [[
						'bold', //加粗
				        'forecolor', //字体颜色
				        'indent', //首行缩进
				        'italic', //斜体
				        'horizontal', //分隔线
				        'simpleupload', //单图上传
				        'link', //超链接
				        'justifyleft', //居左对齐
				        'justifyright', //居右对齐
				        'justifycenter', //居中对齐
				        'justifyjustify', //两端对齐
				        'insertorderedlist', //有序列表
				        'insertunorderedlist', //无序列表
				        'rowspacingtop', //段前距
				        'rowspacingbottom', //段后距
				        'imagenone', //默认
				        'imageleft', //左浮动
				        'imageright', //右浮动
				        'imagecenter', //居中
				        'lineheight'
				    ]]
				});
			setTimeout(function(){
	            ue.setContent('<?php if(isset($m['daily']) && $m['daily']!=''){echo($m['daily']);}?>');
	        },200);

			$('#submit').click(function(){
				var uri = '<?php echo($settings['renderer']['home_path']);?>executive/daily/save';
				
				$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			          	layer.msg(d.msg,{icon: 1,time: 2000,}, function(){
							//以下代码可以关闭父级弹窗
				   			var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
							parent.layer.close(index);

			            	return false;
						});
			            
			            
			          }else{
			            layer.msg(d.msg,{icon: 0,time: 2000,}, function(){
			            	return false;
						});
			          }
			    });
			});	
			
		</script>
		
	</body>
</html>
