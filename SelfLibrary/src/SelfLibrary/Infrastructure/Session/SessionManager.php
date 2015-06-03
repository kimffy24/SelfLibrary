<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:16 PM
 */
namespace SelfLibrary\Infrastructure\Session;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Cache\Storage\Adapter\AbstractAdapter;

use SelfLibrary\Infrastructure\Session\Storage\Utils\AbstractSessionStorage;

class SessionManager {
    public function __construct(ServiceLocatorInterface $sl){
        $this->serviceLocator = $sl;

        if (session_status()==0)
            throw new SessionStorageException("Session can't use on this request!");
        else if (session_status()==2)
            throw new SessionStorageException("Session has initialize on this request!");
        return;
    }

    public function general(){
        // @todo 获取配置文件，初始化Container；
        $this->targetContainer = new $this->defaultContainerClass();
    }

    public function setContainer(AbstractSessionStorage $container){
        if($this->targetContainer)
            throw new SessionStorageException("Session has initialize on this request!");
        $this->targetContainer = $container;
    }

    public function getContainer(){
        if(!$this->targetContainer)
            $this->general();
        return $this->targetContainer;
    }

    private $serviceLocator;
    private $defaultContainerClass = '\SelfLibrary\Infrastructure\Session\Storage\NormalSessionStorage';
    private $targetContainer;


} 