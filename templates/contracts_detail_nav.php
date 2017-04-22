<a <?php if($cmodel==0){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/detail/'.$mid);?>">基本信息</a>

<a <?php if($cmodel==2){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/detail/'.$mid.'/bookingandcost');?>">款项与成本</a>
<a <?php if($cmodel==3){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/detail/'.$mid.'/executelog');?>">执行进度</a>
<a <?php if($cmodel==4){echo('class="active"');}?> href="<?php echo($settings['renderer']['home_path'].'contracts/detail/'.$mid.'/msg');?>">动态信息</a>