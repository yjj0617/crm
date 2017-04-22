<?php
/**
* 
*/
class Middleware
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }

    function __destruct(){
        //echo "Middleware对象被销毁！";
    }
}
