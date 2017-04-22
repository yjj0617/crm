<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo($settings['renderer']['app_name']);?> - <?php echo($settings['renderer']['version']);?></title>
		<link type="text/css" rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/common.css?v=<?php echo date('ymdhis');?>" />
		<link type="text/css" rel="stylesheet" href="//at.alicdn.com/t/font_4cdue37fp4wh4cxr.css" />
	</head>
	<body class="page-login">
		<div class="login">
			<div class="system-logo text-center">
				<div class="logo" style="padding-top:20px;"><span><i class="iconfont icon-ss" style="font-size:108px;color:#fff;"></i></span></div>
			</div>
			<div class="loginbox">
				<form method="post" id="Form">
					<input type="number" name="mobile" class="input input-full" placeholder=" 手机号" style="background-color:#fefefe" />
					<input type="password" name="password" class="input input-full" placeholder=" 密码" style="background-color:#fefefe" />
					<button type="button" class="btn btn-red btn-full btn-big submit">登录</button>
				</form>
			</div>
			<div class="text-center font-size-12 copyright text-color-gray">
				&copy;2017~2020 <a href="http://cw2009.com" target="_blank" class="text-color-gray">CW2009.COM</a> All right reserved.
			</div>
		</div>
		<div  class="text-center font-size-12 copyright text-color-gray" style="line-height:20px;">
			注意：本系统要求IE9以上浏览器，建议使用Chrome,Firefox,Safari等新版浏览器。<br />
				 如您使用的是360等双核浏览器，必须使用支持HTML5的极速模式。
		</div>
		<?php require 'js.php';?>
		<script type="text/javascript">
			$(document).keyup(function(event){
			  if(event.keyCode ==13){
			    if($('input[name="password"]').val()!=''){
			    	$(".submit").trigger("click");
			    }
			  }
			});
			$('.submit').click(function(){
				if($('input[name="mobile"]').val()=='' || $('input[name="password"]').val()==''){
					alert('手机号和密码不能为空');
					return false;
				}
				if(!(/^1[34578]\d{9}$/.test($('input[name="mobile"]').val()))){ 
			        alert("手机号码格式不正确，只允许填写手机号码。");  
			        $(this).show();
			        return false; 
			    }
				$(this).text('登录中,请稍候...').attr('disabled',"true").css('background-color','#999');
				var that = this;
				$.post('<?php echo($settings['renderer']['home_path']);?>login',$('#Form').serialize(),function(data){
		          var d = data;
		          //console.log(d);
		          if(d.flag == 200){
		            //alert(d.msg);

		            location.href = '<?php echo($settings['renderer']['home_path']);?>';
		            return false;
		          }else{
		            //alert(d.msg);
		            layer.msg(d.msg,{icon: 0,time: 3000,}, function(){
		            	$(that).text('登录').removeAttr('disabled').css('background-color','#f00');
		            	return false;
					});
		            
		          }
		        },'json');
			});

		</script>
	</body>
</html>