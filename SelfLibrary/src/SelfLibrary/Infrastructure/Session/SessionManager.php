<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:16 PM
 */
namespace SelfLibrary\Infrastructure\Session;

use SelfLibrary\Infrastructure\Session\Storage\Utils\SessionStorageException;
use Zend\ServiceManager\ServiceLocatorInterface;

use SelfLibrary\Infrastructure\Session\Storage\Utils\AbstractSessionStorage;

class SessionManager {
    public function __construct(ServiceLocatorInterface $sl){
        $this->serviceLocator = $sl;
        $this->isSessionCanStart();
        return;
    }

    public function setStorage(AbstractSessionStorage $container=null){
        if($this->isHasSessionStorage())
            throw new SessionStorageException("A session storage was set before this invoke!");
        if(!$container)
            $this->defaultStorage = new $this->defaultStorageClass;
        else
            $this->defaultStorage = $container;

        $this->defaultStorage->initializeSessionControl();
        return $this;
    }

    public function getContainer(){
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
    private function isSessionCanStart(){
        if (session_status()==0)
            throw new SessionStorageException("Session can't use on this request!");
        else if (session_status()==2)
            throw new SessionStorageException("Session has initialize on this request!");
        return true;
    }

    /**
     * 规则： 检查是否设置过sessionStorage
     * @return bool
     */
    private function isHasSessionStorage(){
        return (!$this->defaultStorage)?false:true;
    }
}