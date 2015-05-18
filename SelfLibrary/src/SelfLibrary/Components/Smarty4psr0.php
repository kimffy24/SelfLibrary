<?php
namespace SelfLibrary\Components;

/**
 * do something to use smarty libraries.
 * @author Administrator
 *
 */
if(!defined('SMARTY_DIR')){
    define('SMARTY_DIR', dirname(__DIR__).DS.'..'.DS.'..'.DS.'ext_lib'.DS.'Smarty-3.1.21'.DS.'libs'.DS);
    require(SMARTY_DIR . 'Smarty.class.php');
}

use \Smarty;
/**
 * @author Jiefzz
 *
 */
class Smarty4psr0 extends Smarty
{
    public function __construct($sm){

        $this->serviceLocator = $sm;

        parent::__construct();


        $tinyBSRoute = $sm->get('TinyBS\RouteMatch\Route');
        $analyze = explode('\\', $tinyBSRoute->getMatchController());
        $controller = end($analyze);
        //$action = $tinyBSRoute->getMatchAction();

        $workPath = dirname(__DIR__).DS.'..'.DS.'..'.DS.'work'.DS.'smarty';
        $viewPath = dirname(__DIR__).DS.'..'.DS.'..'.DS.'view';
        $pluginPath = dirname(__DIR__).DS.'..'.DS.'..'.DS.'ext_lib'.DS.'smartyExtension';

        $this->setTemplateDir($viewPath.DS.strtolower($controller).DS)
            ->setCompileDir($workPath.DS.'templates_c'.DS)
            ->setConfigDir($workPath.DS.'configs'.DS)
            ->setCacheDir($workPath.DS.'cache'.DS)
            ->addPluginsDir($pluginPath);

        /****/
        //require_once($pluginPath.DS.'function.U.php');
        //$this->registerPlugin ( "function", "U", "smarty_extension_U" );

        //$this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->caching = false;


    }

    private $serviceLocator;
    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceLocator(){
        return $this->serviceLocator;
    }
    public function display($template=null, $cache_id=null, $compile_id=null, $parent=null){
        $template = strtolower(((is_null($template))?
                $this->getServiceLocator()->get('TinyBS\RouteMatch\Route')->getMatchAction():
                $template).'.phtml');
        parent::display($template, $cache_id, $compile_id, $parent);
    }
}