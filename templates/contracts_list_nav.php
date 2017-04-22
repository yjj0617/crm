<a <?php if($cmodel==0){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts');?>">全部合同</a>
<a <?php if($cmodel==1){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/60dayend');?>">60日内到期合同(记帐类)</a>
<a <?php if($cmodel==2){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/notpayall');?>">款项未付清的合同</a>
<a <?php if($cmodel==3){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/notpai');?>">未派单的合同</a>