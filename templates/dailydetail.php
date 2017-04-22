<?php 
	require 'header.php';
?>
	<body style="background:#fff;animation:anshow 1s 1;">
		<section style="padding:20px;width:calc(100% - 40px);height:calc(100% - 40px);">
			<div class="response-page">
				<?php if(isset($m['daily']) && $m['daily']!=''){echo($m['daily']);}?>
			</div>
		</section>
		<?php require 'js.php';?>
		
	</body>
</html>
