<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 6/3/15
 * Time: 3:30 PM
 */

namespace SelfLibrary\Infrastructure\Session\Storage\Utils;


interface SessionStorageInterface {

    public function read($sid);
    public function write($sid, $data);
    public function destroy($sid);
    public function open($path=null, $name=null);
    public function close();
    public function gc();
} 