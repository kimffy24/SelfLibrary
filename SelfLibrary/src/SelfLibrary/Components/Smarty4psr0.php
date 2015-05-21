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

        //调用父类构造函数的会出现$this为null的错误
        //parent::__construct();
        
        /***///smarty自身构造函数的内容===>
        $this->smarty = $this;
        if (is_callable('mb_internal_encoding')) {
        	mb_internal_encoding(Smarty::$_CHARSET);
        }
        $this->start_time = microtime(true);
        // set default dirs
        $this//->setTemplateDir('.' . DS . 'templates' . DS)
        //->setCompileDir('.' . DS . 'templates_c' . DS)
        ->setPluginsDir(SMARTY_PLUGINS_DIR)
        //->setCacheDir('.' . DS . 'cache' . DS)
        //->setConfigDir('.' . DS . 'configs' . DS)
        ;
        
        //$this->debug_tpl = 'file:' . dirname(__FILE__) . '/debug.tpl';
        if (isset($_SERVER['SCRIPT_NAME'])) {
        	$this->assignGlobal('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);
        }
        /***///<===smarty自身构造函数的内容

        $workPath = dirname(__DIR__).DS.'..'.DS.'..'.DS.'work'.DS.'smarty';
        $viewPath = dirname(__DIR__).DS.'..'.DS.'..'.DS.'view';
        $pluginPath = dirname(__DIR__).DS.'..'.DS.'..'.DS.'ext_lib'.DS.'smartyExtension';

        $this
            ->setCompileDir($workPath.DS.'templates_c'.DS)
            ->setConfigDir($workPath.DS.'configs'.DS)
            ->setCacheDir($workPath.DS.'cache'.DS)
            ->addPluginsDir($pluginPath);
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        //$this->caching = false;


    }
    
    public function setTemplateDir($template_dir){
        $tinyBSRoute = $this->getServiceLocator()->get('TinyBS\RouteMatch\Route');
        $analyze = explode('\\', $tinyBSRoute->getMatchController());
        $controller = end($analyze);
        
        parent::setTemplateDir($template_dir.strtolower($controller).DS);
    }

    public function display($template=null, $cache_id=null, $compile_id=null, $parent=null){
    	$config = $this->getConfig();
    	$suffix = '.'.((isset($config['templateSuffix']) && !empty($config['templateSuffix']))?
    		$config['templateSuffix']:
    		'phtml');
        $template = strtolower(((is_null($template))?
                $this->getServiceLocator()->get('TinyBS\RouteMatch\Route')->getMatchAction():
                $template).$suffix);
        parent::display($template, $cache_id, $compile_id, $parent);
    }

    public function getConfig(){
    	return $this->smartyConfig;
    }
    public function setConfig($config = null){
    	if($config == null) return $this;
    	$this->smartyConfig = $config;
    	$this->configTemplateDir($config);
    	return $this;
    }

    /**
     * please set this function modifier to public 
     * if you wanna set something on you own plugins or extensions
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceLocator(){
    	return $this->serviceLocator;
    }

    private function configTemplateDir($config){
    	if(isset($config['templateDir']) && !empty($config['templateDir']))
    		$this->setTemplateDir($config['templateDir']);
    }
    private $smartyConfig;
    private $serviceLocator;
}