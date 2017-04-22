<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/f.js"></script>
<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/layer/layer.js"></script>
<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/chatim.js"></script>
<script type="text/javascript">
<?php if(isset($_COOKIE['staffID'])){?>
	creatsocket(<?php echo($_COOKIE['staffID']);?>);
<?php } ?>
</script>
<script type="text/javascript">
	if (self != top) {      
	    $('header,aside').hide();
	    $('.box-head').css('top','0').css('left','0').css('width','calc(100% - 40px)');
	    $('.box-body').css('top','60px').css('left','0').css('width','calc(100%)');
	} 
</script>
