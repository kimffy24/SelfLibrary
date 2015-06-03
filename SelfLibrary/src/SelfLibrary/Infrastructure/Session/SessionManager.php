<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:16 PM
 */
namespace SelfLibrary\Infrastructure\Session;

use Zend\ServiceManager\ServiceLocatorInterface;

use SelfLibrary\Infrastructure\Session\Storage\Utils\AbstractSessionStorage;

class SessionManager {
    public function __construct(ServiceLocatorInterface $sl){
        $this->serviceLocator = $sl;
        $this->sessionStatusCheck();
        return;
    }

    public function general(){
        // @todo 获取配置文件，初始化Container；

        $this->targetContainer = new $this->defaultStorageClass();
    }

    public function setStorage(AbstractSessionStorage $container){
        return $this;
    }

    public function getContainer(){
        if(!$this->defaultStorage)
            $this->general();
        if(!$this->targetContainer)
            $this->targetContainer = new SessionArrayHandler();
        return $this->targetContainer;
    }

    private $serviceLocator;
    private $defaultStorageClass = '\SelfLibrary\Infrastructure\Session\Storage\NormalSessionStorage';
    private $defaultStorage;
    private $targetContainer;

    /**
     * 规则： 检查session是否为可用切没开启的状态
     * @throws SessionStorageException
     */
    private function sessionStatusCheck(){
        if (session_status()==0)
            throw new SessionStorageException("Session can't use on this request!");
        else if (session_status()==2)
            throw new SessionStorageException("Session has initialize on this request!");
        return true;
    }
} 