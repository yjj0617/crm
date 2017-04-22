<?php
//index
$app->get('/', '\DesktopController:index')->setName('Index')->add('\CrmMiddleware:isStaff');

//desktop
$app->get('/login', '\DesktopController:loginpage')->setName('Loginpage');
$app->post('/login', '\DesktopController:login')->setName('Login');
$app->get('/logout', '\DesktopController:logout')->setName('Logout');

//customs
$app->get('/customs[/{from:[0-9]+}[/{p:[0-9]+}]]', '\MemberController:index')->setName('customsIndex')->add('\CrmMiddleware:isStaff');
$app->get('/customs/report[/{year:[0-9]+}]', '\MemberController:report')->setName('customsReport')->add('\CrmMiddleware:isStaff');
$app->get('/customs/detail/{id:[0-9]+}', '\MemberController:detail')->setName('customsDetail')->add('\CrmMiddleware:isStaff');
$app->get('/customs/detail/{id:[0-9]+}/candc', '\MemberController:detailCandc')->setName('customsDetail')->add('\CrmMiddleware:isStaff');
$app->get('/customs/detail/{id:[0-9]+}/msg', '\MemberController:detailMsg')->setName('customsDetail')->add('\CrmMiddleware:isStaff');

$app->post('/customs/close/{id:[0-9]+}', '\MemberController:close')->setName('customsClose')->add('\CrmMiddleware:isStaff');

$app->get('/customs/form[/{id:[0-9]+}]', '\MemberController:form')->setName('customsForm')->add('\CrmMiddleware:isStaff');
$app->post('/customs/save[/{id:[0-9]+}]', '\MemberController:save')->setName('customsSaveform')->add('\CrmMiddleware:isStaff');

$app->get('/customs/search', '\MemberController:searchform')->setName('customsSearchform')->add('\CrmMiddleware:isStaff');
$app->post('/customs/search', '\MemberController:searchresult')->setName('customsSearchresult')->add('\CrmMiddleware:isStaff');
$app->post('/customs/searchJSON', '\MemberController:searchresultJSON')->setName('customsSearchresultJSON')->add('\CrmMiddleware:isStaff');

//vmobile vmobile
$app->post('/vmobile', '\MemberController:vmobile')->add('\CrmMiddleware:isStaff');

//company
$app->get('/companies[/{p:[0-9]+}]', '\CompanyController:index')->setName('companiesIndex')->add('\CrmMiddleware:isStaff');
$app->get('/companies/30daykeyend', '\CompanyController:keyend')->setName('companiesIndexKeyend')->add('\CrmMiddleware:isStaff');
$app->get('/companies/30dayvpdnend', '\CompanyController:vpdnend')->setName('companiesIndexVpdnend')->add('\CrmMiddleware:isStaff');
$app->get('/companies/yearcheck', '\CompanyController:yearcheck')->setName('companiesIndexYearcheck')->add('\CrmMiddleware:isStaff');

$app->get('/companies/detail/{id:[0-9]+}', '\CompanyController:detail')->setName('companiesDetail')->add('\CrmMiddleware:isStaff');
$app->get('/companies/detail/{id:[0-9]+}/contracts', '\CompanyController:detailcontracts')->setName('companiesDetailContracts')->add('\CrmMiddleware:isStaff');
$app->get('/companies/search', '\CompanyController:searchform')->setName('companiesSearchform')->add('\CrmMiddleware:isStaff');
$app->post('/companies/search', '\CompanyController:searchresult')->setName('companiesSearchresult')->add('\CrmMiddleware:isStaff');
$app->get('/companies/report[/{year:[0-9]+}]', '\CompanyController:report')->setName('companiesReport')->add('\CrmMiddleware:isStaff');

$app->get('/companies/form[/{id:[0-9]+}]', '\CompanyController:form')->setName('companiesForm')->add('\CrmMiddleware:isStaff');
$app->post('/companies/save[/{id:[0-9]+}]', '\CompanyController:save')->setName('companiesSaveform')->add('\CrmMiddleware:isStaff');

//contracts
$app->get('/contracts[/{s:[0-9]+}[/{p:[0-9]+}]]', '\ContractController:index')->setName('contractsIndex')->add('\CrmMiddleware:isStaff');
$app->get('/contracts/detail/{id:[0-9]+}', '\ContractController:detail')->setName('contractsDetail')->add('\CrmMiddleware:isStaff');
$app->get('/contracts/60dayend[/{p:[0-9]+}]', '\ContractController:day60end')->setName('contractsIndexday60end')->add('\CrmMiddleware:isStaff');
$app->get('/contracts/notpayall[/{p:[0-9]+}]', '\ContractController:notpayall')->setName('contractsIndexNotpayall')->add('\CrmMiddleware:isStaff');
$app->get('/contracts/notpai[/{p:[0-9]+}]', '\ContractController:notpai')->setName('contractsIndexNotpai')->add('\CrmMiddleware:isStaff');
$app->get('/contracts/detail/{id:[0-9]+}/executelog', '\ContractController:executelog')->setName('contractsDetailexecutelog')->add('\CrmMiddleware:isStaff');

$app->get('/contracts/runform/{cid:[0-9]+}[/{id:[0-9]+}]', '\ContractController:runform')->setName('contractsDetailRunform')->add('\CrmMiddleware:isStaff');
$app->post('/contracts/runform/{cid:[0-9]+}[/{id:[0-9]+}]', '\ContractController:saverun')->setName('contractsDetailRunSave')->add('\CrmMiddleware:isStaff');

$app->get('/contracts/detail/{id:[0-9]+}/bookingandcost', '\ContractController:bookingandcost')->setName('contractsDetailcandc')->add('\CrmMiddleware:isStaff');

$app->get('/contracts/bookingform/{cid:[0-9]+}[/{id:[0-9]+}]', '\ContractController:bookingform')->setName('contractsDetailbookingform')->add('\CrmMiddleware:isStaff');
$app->post('/contracts/bookingform/{cid:[0-9]+}[/{id:[0-9]+}]', '\ContractController:savebooking')->setName('contractsDetailbookingSave')->add('\CrmMiddleware:isStaff');

$app->post('/contracts/close/{id:[0-9]+}', '\ContractController:close')->setName('contractsDetailClose')->add('\CrmMiddleware:isStaff');

$app->get('/contracts/form[/{id:[0-9]+}]', '\ContractController:form')->setName('contractsForm')->add('\CrmMiddleware:isStaff');
$app->post('/contracts/save[/{id:[0-9]+}]', '\ContractController:save')->setName('contractsSaveform')->add('\CrmMiddleware:isStaff');

//hr
$app->get('/hr[/{s:[0-9]+}[/{subc:[0-9]+}[/{p:[0-9]+}]]]', '\HrController:index')->setName('hrIndex')->add('\CrmMiddleware:isStaff');
$app->get('/hr/detail/{id:[0-9]+}', '\HrController:detail')->setName('hrDetail')->add('\CrmMiddleware:isStaff');
$app->get('/hr/detail/{id:[0-9]+}/authority', '\HrController:authority')->setName('hrDetailAuthority')->add('\CrmMiddleware:isStaff');
$app->post('/hr/detail/{id:[0-9]+}/authority', '\HrController:saveAuthority')->add('\CrmMiddleware:isStaff');
$app->get('/hr/detail/{id:[0-9]+}/remuneration', '\HrController:remuneration')->setName('hrDetailRemuneration')->add('\CrmMiddleware:isStaff');
$app->post('/hr/detail/{id:[0-9]+}/remuneration', '\HrController:saveremuneration')->add('\CrmMiddleware:isStaff');
$app->get('/hr/remunerationlog[/{subc:[0-9]+}[/{month:[0-9]+}[/{p:[0-9]+}]]]', '\HrController:remunerationlog')->setName('hrRemunerationlog')->add('\CrmMiddleware:isStaff');

$app->get('/hr/detail/{id:[0-9]+}/performance[/{month:[0-9]+}]', '\HrController:performance')->setName('hrDetailPerformance')->add('\CrmMiddleware:isStaff');
$app->get('/hr/detail/{id:[0-9]+}/candc', '\HrController:candc')->setName('hrDetailCandc')->add('\CrmMiddleware:isStaff');
$app->get('/hr/detail/{id:[0-9]+}/msg', '\HrController:msg')->setName('hrDetailMsg')->add('\CrmMiddleware:isStaff');

$app->get('/hr/form[/{id:[0-9]+}]', '\HrController:form')->setName('hrForm')->add('\CrmMiddleware:isStaff');
$app->post('/hr/save[/{id:[0-9]+}]', '\HrController:save')->setName('hrSaveform')->add('\CrmMiddleware:isStaff');

$app->get('/hr/search', '\HrController:searchform')->setName('hrSearchform')->add('\CrmMiddleware:isStaff');
$app->post('/hr/search', '\HrController:searchresult')->setName('hrSearchresult')->add('\CrmMiddleware:isStaff');

$app->get('/hr/getonlineJSON', '\HrController:getstaffJSON')->add('\CrmMiddleware:isStaff');

$app->get('/chat/getlogJSON', '\DesktopController:getChatLog')->add('\CrmMiddleware:isStaff');

//人才库
$app->get('/hr/talentpool[/{s:[0-9]+}[/{p:[0-9]+}]]', '\HrController:talentpool')->setName('hrTalentpool')->add('\CrmMiddleware:isStaff');

$app->get('/hr/talentpool/appointment[/{p:[0-9]+}]', '\HrController:talentpoolappo')->setName('hrTalentpoolAppo')->add('\CrmMiddleware:isStaff');

$app->get('/hr/talentpool/detail/{id:[0-9]+}', '\HrController:talentpooldetil')->setName('hrTalentpoolDetail')->add('\CrmMiddleware:isStaff');

//opportunity

$app->get('/opportunity[/{status:[0-9]+}[/{p:[0-9]+}]]', '\OpportunityController:index')->setName('opporIndex')->add('\CrmMiddleware:isStaff');
$app->get('/opportunity/detail/{id:[0-9]+}', '\OpportunityController:detail')->setName('opporDetail')->add('\CrmMiddleware:isStaff');
$app->post('/opportunity/do/{id:[0-9]+}', '\OpportunityController:savedo')->setName('opporDo')->add('\CrmMiddleware:isStaff');
$app->get('/opportunity/mine[/{status:[0-9]+}[/{p:[0-9]+}]]', '\OpportunityController:mine')->setName('opporMine')->add('\CrmMiddleware:isStaff');
$app->get('/opportunity/report[/{year:[0-9]+}]', '\OpportunityController:report')->setName('opporReport')->add('\CrmMiddleware:isStaff');

$app->get('/opportunity/search', '\OpportunityController:searchform')->setName('opporSearchform')->add('\CrmMiddleware:isStaff');
$app->post('/opportunity/search', '\OpportunityController:searchresult')->setName('opporSearchresult')->add('\CrmMiddleware:isStaff');

$app->get('/opportunity/form[/{id:[0-9]+}]', '\OpportunityController:form')->setName('opporForm')->add('\CrmMiddleware:isStaff');
$app->post('/opportunity/save[/{id:[0-9]+}]', '\OpportunityController:save')->setName('opporSaveform')->add('\CrmMiddleware:isStaff');


//executive
$app->get('/executive', '\ExecutiveController:index')->setName('executiveIndex')->add('\CrmMiddleware:isStaff');

$app->get('/executive/notice[/{p:[0-9]+}]', '\ExecutiveController:notice')->setName('executiveNotice')->add('\CrmMiddleware:isStaff');
$app->get('/executive/notice/detail/{id:[0-9]+}', '\ExecutiveController:noticedetail')->setName('executiveNoticeDetail')->add('\CrmMiddleware:isStaff');
$app->post('/executive/notice/save[/{id:[0-9]+}]', '\ExecutiveController:savenotice')->setName('executiveNoticeSave')->add('\CrmMiddleware:isStaff');
$app->post('/executive/worktime', '\ExecutiveController:worktime')->setName('executiveWorktime')->add('\CrmMiddleware:isStaff');
$app->get('/executive/worktime[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:worktimelog')->setName('executiveWorktimeLog')->add('\CrmMiddleware:isStaff');
$app->get('/executive/mine[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:minelog')->setName('executivemineLog')->add('\CrmMiddleware:isStaff');


//行政大模块的外勤事物模块的路由
$app->get('/executive/detail/{id:[0-9]+}', '\ExecutiveController:notdetail')->setName('executiveNotdetail')->add('\CrmMiddleware:isStaff');
$app->get('/executive/add', '\ExecutiveController:notadd')->setName('executiveNotadd')->add('\CrmMiddleware:isStaff');//加载添加也面
$app->post('/executive/insert', '\ExecutiveController:notinsert')->setName('executiveNotinsert')->add('\CrmMiddleware:isStaff');//添加外勤信息
$app->post('/executive/update', '\ExecutiveController:notupdate')->setName('executiveNotupdate')->add('\CrmMiddleware:isStaff');//修改外勤信息
//行政大模块的节日福利模块的路由
$app->get('/executive/welfare[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:notselect')->setName('executiveNotwelfare')->add('\CrmMiddleware:isStaff');//节日福利列表
$app->get('/executive/jieadd', '\ExecutiveController:notjieadd')->setName('executiveNotjieadd')->add('\CrmMiddleware:isStaff');//跳转添加节日页面
$app->post('/executive/jieinsert', '\ExecutiveController:notjieinsert')->setName('executiveNotjieinsert')->add('\CrmMiddleware:isStaff');//提交添加节日信息
$app->get('/executive/jedit/{id:[0-9]+}', '\ExecutiveController:notjedit')->setName('executiveNotjedit')->add('\CrmMiddleware:isStaff');//查看节日详细信息
$app->post('/executive/jupdate', '\ExecutiveController:notjupdate')->setName('executiveNotjupdate')->add('\CrmMiddleware:isStaff');//修改节日信息
$app->get('/executive/grant/{id:[0-9]+}', '\ExecutiveController:notgrant')->setName('executiveNotgrant')->add('\CrmMiddleware:isStaff');//发放节日福利
$app->get('/executive/receive/{id:[0-9]+}', '\ExecutiveController:notreceive')->setName('executiveNotreceive')->add('\CrmMiddleware:isStaff');//领取福利
$app->get('/executive/jledit/{id:[0-9]+}', '\ExecutiveController:notjledit')->setName('executiveNotjledit')->add('\CrmMiddleware:isStaff');//查看领取列表


//行政大模块的办公申领模块路由
$app->get('/executive/apply[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:notapply')->setName('executiveNotapply')->add('\CrmMiddleware:isStaff');//加载物品列表页面
$app->get('/executive/addietms', '\ExecutiveController:notaddietms')->setName('executiveNotaddietms')->add('\CrmMiddleware:isStaff');//加载添加物品页面
$app->post('/executive/winsert', '\ExecutiveController:notwinsert')->setName('executiveNotwinsert')->add('\CrmMiddleware:isStaff');//将添加的物品数据写入数据库
$app->get('/executive/additional/{id:[0-9]+}', '\ExecutiveController:notaddit')->setName('executiveNotaddit')->add('\CrmMiddleware:isStaff');//将添加的物品数据写入数据库
$app->post('/executive/wupdate', '\ExecutiveController:notwupdate')->setName('executiveNotwupdate')->add('\CrmMiddleware:isStaff');//追加物品数量
$app->get('/executive/wedit/{id:[0-9]+}', '\ExecutiveController:notwedit')->setName('executiveNotwedit')->add('\CrmMiddleware:isStaff');//跳转查看详情页面
$app->post('/executive/wpupdate', '\ExecutiveController:notwpupdate')->setName('executiveNotwpupdate')->add('\CrmMiddleware:isStaff');//执行物品的数据修改 以及操作记录
$app->get('/executive/recadd/{id:[0-9]+}', '\ExecutiveController:notrecadd')->setName('executiveNorecadd')->add('\CrmMiddleware:isStaff');//跳转申领页面
$app->post('/executive/sinsert', '\ExecutiveController:notsinsert')->setName('executiveNotsinsert')->add('\CrmMiddleware:isStaff');//办公用品添加申请
$app->get('/executive/applyedit[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:notapplyedit')->setName('executiveNotapplyedit')->add('\CrmMiddleware:isStaff');//加载申请列表页
$app->get('/executive/examint/{id:[0-9]+}', '\ExecutiveController:notrexamint')->setName('executiveNotexamint')->add('\CrmMiddleware:isStaff');//跳转并加载具体信息审批页面
$app->get('/executive/sagree/{id:[0-9]+}', '\ExecutiveController:notsagree')->setName('executiveNotsagree')->add('\CrmMiddleware:isStaff');//同意申请
$app->get('/executive/record/{id:[0-9]+}', '\ExecutiveController:notrecord')->setName('executiveNotrecord')->add('\CrmMiddleware:isStaff');//查看操作记录
$app->get('/executive/records[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:notrecord')->setName('executiveNotrecord')->add('\CrmMiddleware:isStaff');//查看操作记录

$app->get('/executive/trecord[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:nottrecord')->setName('executiveNottrecord')->add('\CrmMiddleware:isStaff');//查看操作记录
$app->get('/executive/cedit/{id:[0-9]+}', '\ExecutiveController:notcedit')->setName('executiveNotcedit')->add('\CrmMiddleware:isStaff');//查看操作记录的具体操作信息
//行政大模块下的病事公假模块
$app->get('/executive/search[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:notsearch')->setName('executiveNotsearch')->add('\CrmMiddleware:isStaff');//跳转并且加载列表页面		
$app->get('/executive/leaveadd', '\ExecutiveController:notleaveadd')->setName('executiveNotleaveadd')->add('\CrmMiddleware:isStaff');//跳转并加载申请列表页	
$app->post('/executive/linsert', '\ExecutiveController:notlinsert')->setName('executiveNotlinsert')->add('\CrmMiddleware:isStaff');//申请病假提交提交
$app->get('/executive/tiral/{id:[0-9]+}', '\ExecutiveController:nottiral')->setName('executiveNottiral')->add('\CrmMiddleware:isStaff');//加载审核页面
$app->get('/executive/tupdate/{id:[0-9]+}', '\ExecutiveController:nottupdate')->setName('executiveNottupdate')->add('\CrmMiddleware:isStaff');//点击同意跳转此方法
$app->get('/executive/tiraledit/{id:[0-9]+}', '\ExecutiveController:nottiraledit')->setName('executiveNottiraledit')->add('\CrmMiddleware:isStaff');//审核完后可以查看但不可修改
$app->get('/executive/noupdate/{id:[0-9]+}', '\ExecutiveController:notnoupdate')->setName('executiveNotnoupdate')->add('\CrmMiddleware:isStaff');//点击拒绝跳转此方法
$app->get('/executive/bupdate/{id:[0-9]+}', '\ExecutiveController:notbupdate')->setName('executiveNotbupdate')->add('\CrmMiddleware:isStaff');//点击修改 跳转修改页面
$app->post('/executive/updateb', '\ExecutiveController:notupdateb')->setName('executiveNotupdateb')->add('\CrmMiddleware:isStaff');//执行修改信息操作
//行政达模块下的办公采购模块
$app->get('/executive/purchase[/{year:[0-9]+}[/{month:[0-9]+}[/{day:[0-9]+}]]]', '\ExecutiveController:notpurchase')->setName('executiveNotpurchase')->add('\CrmMiddleware:isStaff');//跳转并加载采购列表页		
$app->get('/executive/pleaseadd', '\ExecutiveController:notpleaseadd')->setName('executiveNotpleaseadd')->add('\CrmMiddleware:isStaff');//加载申请添加页面	
$app->post('/executive/pleinsert', '\ExecutiveController:notpleinsert')->setName('executiveNotpleinsert')->add('\CrmMiddleware:isStaff');//执行添加采购申请信息

//行政达模块下的办公采购模块结束。。。


$app->get('/executive/daily/form', '\ExecutiveController:dailyform')->setName('executiveDailyform')->add('\CrmMiddleware:isStaff');
$app->post('/executive/daily/save', '\ExecutiveController:dailysave')->setName('executiveDailysave')->add('\CrmMiddleware:isStaff');

$app->get('/executive/daily/detail/{uid:[0-9]+}/{day}', '\ExecutiveController:dailydetail')->setName('executiveDailyDetail')->add('\CrmMiddleware:isStaff');

//workplan
$app->get('/executive/workplan/detail/{id:[0-9]+}', '\ExecutiveController:workplandetail')->setName('executiveWorkplanDetail')->add('\CrmMiddleware:isStaff');


//finance
$app->get('/finance', '\MoneyController:index')->setName('financeIndex')->add('\CrmMiddleware:isStaff');

//complain
$app->get('/complain', '\ComplainController:index')->setName('complainIndex')->add('\CrmMiddleware:isStaff');

//operate
$app->get('/operate', '\OperateController:index')->setName('operateIndex')->add('\CrmMiddleware:isStaff');

//performance
$app->get('/performance', '\PerformanceController:index')->setName('performanceIndex')->add('\CrmMiddleware:isStaff');

$app->get('/ranking[/{month:[0-9]+}]', '\PerformanceController:ranking')->setName('rankingIndex')->add('\CrmMiddleware:isStaff');

//report
$app->get('/report', '\ReportController:index')->setName('reportIndex')->add('\CrmMiddleware:isStaff');

//setting
$app->get('/setting', '\SettingController:index')->setName('settingIndex')->add('\CrmMiddleware:isStaff');

//cms
$app->get('/cms', '\CmsController:index')->setName('cmsIndex')->add('\CrmMiddleware:isStaff');
$app->get('/cms/projects[/{p:[0-9]+}]', '\CmsController:projects')->setName('cmsProjects')->add('\CrmMiddleware:isStaff');
$app->get('/cms/projects/form[/{id:[0-9]+}]', '\CmsController:projectsform')->setName('cmsProjectsForm')->add('\CrmMiddleware:isStaff');

$app->post('/cms/projects/save[/{id:[0-9]+}]', '\CmsController:saveprojects')->setName('cmsProjectsSave')->add('\CrmMiddleware:isStaff');

$app->get('/cms/posts[/{p:[0-9]+}]', '\CmsController:posts')->setName('cmsPosts')->add('\CrmMiddleware:isStaff');
$app->get('/cms/categories', '\CmsController:categories')->setName('cmsCategories')->add('\CrmMiddleware:isStaff');
$app->get('/cms/pages[/{p:[0-9]+}]', '\CmsController:pages')->setName('cmsPages')->add('\CrmMiddleware:isStaff');
$app->get('/cms/fetures[/{p:[0-9]+}]', '\CmsController:fetures')->setName('cmsFetures')->add('\CrmMiddleware:isStaff');
$app->get('/cms/subsites[/{p:[0-9]+}]', '\CmsController:subsites')->setName('cmsSubsites')->add('\CrmMiddleware:isStaff');
$app->get('/cms/media[/{p:[0-9]+}]', '\CmsController:media')->setName('cmsMedia')->add('\CrmMiddleware:isStaff');


//upload
$app->post('/upload', '\UploadController:upload')->add('\CrmMiddleware:isStaff');
$app->post('/uploadfile', '\UploadController:uploadfile')->add('\CrmMiddleware:isStaff');
$app->post('/uploadPic', '\UploadController:uploadPic')->add('\CrmMiddleware:isStaff');

//city-prov-area
$app->get('/prov', '\DesktopController:getprov');
$app->get('/city[/{pcode:[0-9]+}]', '\DesktopController:getcity');
$app->get('/area[/{pcode:[0-9]+}]', '\DesktopController:getarea');

$app->get('/noauthority', '\DesktopController:noauthority')->setName('errorNoauthority');
$app->get('/noId', '\DesktopController:noId')->setName('errorNoId');
