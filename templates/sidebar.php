<aside>
	<nav>
		<ul>
		<?php if($path=='/'){?>
			<li class="active"><a href="<?php echo($settings['renderer']['home_path']);?>admin"><i class="iconfont icon-gongzuotai-copy"></i> 工作台</a></li>
			<hr size="1" />
			<li ><a href="<?php echo($settings['renderer']['home_path']);?>admin/newpost"><i class="iconfont icon-anonymous-iconfont"></i> 录入合同</a></li>
			<li ><a href="<?php echo($settings['renderer']['home_path']);?>customs/form"><i class="iconfont icon-anonymous-iconfont"></i> 录入客户</a></li>
			<li ><a href="<?php echo($settings['renderer']['home_path']);?>admin/newpage"><i class="iconfont icon-anonymous-iconfont"></i> 录入企业</a></li>
			<hr size="1" />
			<li ><a href="<?php echo($settings['renderer']['home_path']);?>admin/newcategory"><i class="iconfont icon-anonymous-iconfont"></i> 提交商机</a></li>
			<hr size="1" />
			<li ><a href="<?php echo($settings['renderer']['home_path']);?>admin/newcategory"><i class="iconfont icon-anonymous-iconfont"></i> 发布资讯</a></li>
			<li ><a href="<?php echo($settings['renderer']['home_path']);?>admin/newjob"><i class="iconfont icon-anonymous-iconfont"></i> 发布招聘</a></li>
			<hr size="1" />
			<li><a href="<?php echo($settings['renderer']['home_path']);?>admin/newjob"><i class="iconfont icon-caiwu"></i> 款项录入</a></li>

			<li><a href="<?php echo($settings['renderer']['home_path']);?>admin/newjob"><i class="iconfont icon-caiwu"></i> 成本录入</a></li>
			
		<?php } ?>
		<?php if($path=='/customs'){?>
			<li <?php if($modelNo==2){echo(' class="active"');}?> style="background-color:#fff9f0;"><a href="<?php echo($settings['renderer']['home_path']);?>customs/form"><i class="iconfont icon-anonymous-iconfont"></i> 添加新客户</a></li>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>customs"><i class="iconfont icon-uilist"></i> 所有客户</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>customs/search"><i class="iconfont icon-sousuo"></i> 搜索客户</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>customs/report"><i class="iconfont icon-baobiao"></i> 统计报表</a></li>
		<?php } ?>
		<?php if($path=='/companies'){?>
			<li <?php if($modelNo==2){echo(' class="active"');}?> style="background-color:#fff9f0;"><a href="<?php echo($settings['renderer']['home_path']);?>companies/form"><i class="iconfont icon-anonymous-iconfont"></i> 添加新企业</a></li>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>companies"><i class="iconfont icon-uilist"></i> 所有企业</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>companies/search"><i class="iconfont icon-sousuo"></i> 搜索企业</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>companies/report"><i class="iconfont icon-baobiao"></i> 统计报表</a></li>
		<?php } ?>
		<?php if($path=='/contracts'){?>
			<li <?php if($modelNo==2){echo(' class="active"');}?> style="background-color:#fff9f0;"><a href="<?php echo($settings['renderer']['home_path']);?>contracts/form"><i class="iconfont icon-anonymous-iconfont"></i> 添加新合同</a></li>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>contracts"><i class="iconfont icon-uilist"></i> 所有合同</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>contracts/search"><i class="iconfont icon-sousuo"></i> 搜索合同</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>contracts/report"><i class="iconfont icon-baobiao"></i> 统计报表</a></li>
		<?php } ?>
		<?php if($path=='/hr'){?>
			<li <?php if($modelNo==2){echo(' class="active"');}?> style="background-color:#fff9f0;"><a href="<?php echo($settings['renderer']['home_path']);?>hr/form"><i class="iconfont icon-anonymous-iconfont"></i> 添加新员工</a></li>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>hr"><i class="iconfont icon-uilist"></i> 所有员工</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>hr/search"><i class="iconfont icon-sousuo"></i> 搜索员工</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>hr/remunerationlog"><i class="iconfont icon-caiwu"></i> 薪资管理</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>hr/talentpool"><i class="iconfont icon-icon-users-bold"></i> 人才库</a></li>
		<?php } ?>
		<?php if($path=='/opportunity'){?>
			<li <?php if($modelNo==2){echo(' class="active"');}?> style="background-color:#fff9f0;"><a href="<?php echo($settings['renderer']['home_path']);?>opportunity/form"><i class="iconfont icon-anonymous-iconfont"></i> 添加新商机</a></li>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>opportunity"><i class="iconfont icon-uilist"></i> 全部商机</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>opportunity/mine"><i class="iconfont icon-wo"></i> 与我相关</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>opportunity/search"><i class="iconfont icon-sousuo"></i> 搜索商机</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>opportunity/report"><i class="iconfont icon-baobiao"></i> 统计报表</a></li>
		<?php } ?>

		<?php if($path=='/executive'){?>
			
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive"><i class="iconfont icon-uilist"></i> 员工通讯录</a></li>
			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/form"><i class="iconfont icon-gonggao"></i> 通知公告</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/worktime"><i class="iconfont icon-fuwu5"></i> 员工考勤</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/mine"><i class="iconfont icon-wo"></i> 外勤事务</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/search"><i class="iconfont icon-leave1"></i> 病事公假</a></li>
			<li <?php if($modelNo==6){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/welfare"><i class="iconfont icon-msnui-gift-bold"></i> 节假福利</a></li>
			<li <?php if($modelNo==7){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/apply"><i class="iconfont icon-bangongyongpin"></i> 办公申领</a></li>
			<li <?php if($modelNo==8){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/purchase"><i class="iconfont icon-buy"></i> 办公采购</a></li>
			<li <?php if($modelNo==9){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>executive/clearoffice"><i class="iconfont icon-dasao"></i> 卫生排班</a></li>
		<?php } ?>

		<?php if($path=='/finance'){?>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>finance/form"><i class="iconfont icon-caiwu"></i> 合同款项</a></li>

			
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>finance/mine"><i class="iconfont icon-baoxiao"></i> 费用报销</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>finance/search"><i class="iconfont icon-caiwu"></i> 薪资管理</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>finance/wechatpaylog"><i class="iconfont icon-weixin"></i> 在线支付</a></li>
			<li <?php if($modelNo==6){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>finance"><i class="iconfont icon-baobiao2"></i> 财务报表</a></li>

			
		<?php } ?>

		<?php if($path=='/complain'){?>
			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>complain/form"><i class="iconfont icon-anonymous-iconfont"></i> 录入投诉</a></li>

			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>complain"><i class="iconfont icon-tousu"></i> 全部投诉</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>complain/mine"><i class="iconfont icon-wo"></i> 与我相关</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>complain/report"><i class="iconfont icon-baobiao"></i> 统计报表</a></li>
			
		<?php } ?>
		<?php if($path=='/operate'){?>

			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/sms"><i class="iconfont icon-duanxin1"></i> 短信群发</a></li>
			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/wechat"><i class="iconfont icon-weixin"></i> 微信推送</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/im"><i class="iconfont icon-duanxin1"></i> 内部IM</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/sim"><i class="iconfont icon-duanxin1"></i> 客服IM</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/feedback"><i class="iconfont icon-duanxin1"></i> 外部反馈</a></li>
			
		<?php } ?>

		<?php if($path=='/performance'){?>
			
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>integral"><i class="iconfont icon-paiming"></i> 员工积分</a></li>
			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>fund"><i class="iconfont icon-jijin"></i> 至上基金</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>performance/logs/contracts"><i class="iconfont icon-yuceshixiangfuben"></i> 合同执行</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>performance/logs"><i class="iconfont icon-jilu"></i> 操作记录</a></li>
			
		<?php } ?>

		<?php if($path=='/setting'){?>
			
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/sms"><i class="iconfont icon-tixiguanli"></i> 业务体系</a></li>
			
			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/sms"><i class="iconfont icon-zuzhijigou"></i> 组织机构</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>complain/report"><i class="iconfont icon-beifenguanli"></i> 系统备份</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>complain/report"><i class="iconfont icon-shezhishedingpeizhichilun"></i> 系统设定</a></li>
			
		<?php } ?>

		<?php if($path=='/cms'){?>
			
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/posts"><i class="iconfont icon-uilist"></i> 文章管理</a></li>
			<li <?php if($modelNo==7){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/projects"><i class="iconfont icon-fuwu"></i> 服务管理</a></li>
			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/categories"><i class="iconfont icon-tixiguanli"></i> 分类管理</a></li>
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/pages"><i class="iconfont icon-baobiao"></i> 页面管理</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/fetures"><i class="iconfont icon-xingzhengguanli-copy"></i> 专题管理</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/subsites"><i class="iconfont icon-wangzhan"></i> 分站设定</a></li>
			<li <?php if($modelNo==6){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>cms/media"><i class="iconfont icon-gongzuotai-copy"></i> 多媒体</a></li>


		<?php } ?>

		<?php if($path=='/report'){?>
			<li <?php if($modelNo==1){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>report/now"><i class="iconfont icon-baobiao-copy"></i> 总报表</a></li>

			<li <?php if($modelNo==2){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>report/day"><i class="iconfont icon-baobiao2"></i> 日报表</a></li>
			
			<li <?php if($modelNo==3){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>report/week"><i class="iconfont icon-baobiao1"></i> 周报表</a></li>
			<li <?php if($modelNo==4){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>report/month"><i class="iconfont icon-baobiao1"></i> 月报表</a></li>
			<li <?php if($modelNo==5){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>report/year"><i class="iconfont icon-baobiao1"></i> 年报表</a></li>
			<li <?php if($modelNo==6){echo(' class="active"');}?>><a href="<?php echo($settings['renderer']['home_path']);?>operate/phm"><i class="iconfont icon-yuceshixiangfuben"></i> PHM</a></li>
		<?php } ?>

		</ul>
	</nav>
</aside>