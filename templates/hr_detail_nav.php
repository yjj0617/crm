<a <?php if($cmodel==0){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid);?>">基本信息</a>
<a <?php if($cmodel==1){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid.'/authority');?>">权限</a>
<a <?php if($cmodel==2){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid.'/remuneration');?>">薪酬</a>
<a <?php if($cmodel==3){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid.'/candc');?>">客户与企业与合同</a>
<a <?php if($cmodel==4){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid.'/performance');?>">绩效</a>
<a <?php if($cmodel==5){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid.'/msg');?>">动态信息</a>