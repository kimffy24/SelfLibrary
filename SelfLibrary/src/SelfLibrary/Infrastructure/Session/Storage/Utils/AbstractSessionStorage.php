<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 6/3/15
 * Time: 3:41 PM
 */

namespace SelfLibrary\Infrastructure\Session\Storage\Utils;


abstract class AbstractSessionStorage implements SessionStorageInterface {
    public function initializeSessionControl(){

        session_set_save_handler(
            array(&$this,'open'),
            array(&$this,'close'),
            array(&$this,'read'),
            array(&$this,'write'),
            array(&$this,'destroy'),
            array(&$this,'gc')
        );
        session_cache_limiter('private, must-revalidate');

        session_start();

        header("cache-control: private");
    }
} 