<?php 
	Global $dbs,$db,$assets_path;
	if(isset($_COOKIE['staffID'])){
		$u = getstaff($_COOKIE['staffID']);
		$o = explode(',',$u['authoritySubc']);
		$uc = $db->select('member_subcompany','*',['id'=>$o]);
		$nc ='';
		foreach ($uc as $ucv) {
			$nc = $nc.$ucv['subcompanyname'].',';
		}
		$u['authoritySubc'] = $nc;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo($settings['renderer']['app_name']);?> - <?php echo($settings['renderer']['version']);?></title>
		<link type="text/css" rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/common.css?v=<?php echo date('ymdhis');?>" />
		<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/layer/skin/layer.css?v=<?php echo date('ymdhis');?>" id="layui_layer_skinlayercss">
		<link type="text/css" rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/select.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/swiper-3.4.1.min.css" />
		<link type="text/css" rel="stylesheet" href="//at.alicdn.com/t/font_ovkfmvqr6spxpqfr.css" />
	</head>