<?php
// Creat By Chang.

$app->post('/contracts/form/searchkey', '\ContractController:searchkey');
$app->get('/contracts/search', '\ContractController:searchform')->setName('contractsSearchform')->add('\CrmMiddleware:isStaff');
$app->post('/contracts/search', '\ContractController:searchresult')->setName('contractsSearchform')->add('\CrmMiddleware:isStaff');
$app->get('/contracts/report[/{year:[0-9]+}]', '\ContractController:report')->setName('contractsReport')->add('\CrmMiddleware:isStaff');