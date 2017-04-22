<?php


class CrmMiddleware extends Middleware{
    protected $app;

    public function __invoke($request, $response, $next)
    {
        if(!isset($_COOKIE['staffID']) || $_COOKIE['staffID']==''){
	        return $response->withRedirect($this->container->router->pathFor('Loginpage'));
	    }else{
            //$response->getBody()->write();
	    	$response = $next($request, $response);
        	return $response;
	    }
    }

    public function isStaff($request, $response, $next){
        Global $app,$db;
        if(!isset($_COOKIE['staffID']) || $_COOKIE['staffID']==''){
            return $response->withRedirect($this->container->router->pathFor('Loginpage'));
        }else{
            //获取当前用户世界唯一码是否数据库值
            $uniqid = $_COOKIE['uniqid'];
            $u = $db->get('member',['id','uniqid'],['id'=>$_COOKIE['staffID']]);
            if($u['uniqid'] != $uniqid){
                return $response->withRedirect($this->container->router->pathFor('Loginpage'));
            }
            $route = $request->getAttribute('route')->getName();//获取当前路由名称
            //获取当前路由在权限表的ID
            $authority = $db->get('member_authority',['id'],['path'=>$route]);
            //获取当前用户访问权限
            $u = $db->get('member',['authority'],['id'=>$_COOKIE['staffID']]);
            //$response->getBody()->write($authority['id']);
            //$response->getBody()->write($u['authority']);

            if(hasinarray($authority['id'],$u['authority']) != true){
                return $response->withRedirect($this->container->router->pathFor('errorNoauthority'));
            }else{
                $response = $next($request, $response);
                return $response;
            }
            //$request = $request->withAttribute('foo', 'bar');中间件给应用传变量参数
            
        }
    }

    public function h($request, $response, $next){
        
            $response->getBody()->write('h');
            $response = $next($request, $response);
            return $response;
        
    }

}