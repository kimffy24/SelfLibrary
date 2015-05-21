<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:16 PM
 */
namespace SelfLibrary\Infrastructure\Session;

use Zend\ServiceManager\ServiceLocatorInterface;

class SessionManager {
    public function __construct(ServiceLocatorInterface $sl){
        $this->serviceLocator = $sl;
    }

    public function general(){
        // @todo 获取配置文件，初始化Container；
        $this->targetContainer = new $this->defaultContainerClass();
    }

    public function getContainer(){
        if(!$this->targetContainer)
            $this->general();
        return $this->targetContainer;
    }

    private $serviceLocator;
    private $defaultContainerClass = 'SelfLibrary\Infrastructure\Session\Storage\NormalSessionStorage';
    private $targetContainer;


} 