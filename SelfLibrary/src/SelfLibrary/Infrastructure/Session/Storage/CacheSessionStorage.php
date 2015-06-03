<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 6/3/15
 * Time: 11:42 AM
 */

namespace SelfLibrary\Infrastructure\Session\Storage;

use \Zend\Cache\Storage\StorageInterface;
use SelfLibrary\Infrastructure\Session\Storage\Utils\AbstractSessionStorage;

class CacheSessionStorage extends AbstractSessionStorage {
    const mcNamespace = 'session_';
    const liftTime = 3600;

    function __construct(StorageInterface $cacheHandler) {
        $this->cacheHandler = $cacheHandler;
    }

    function open($path=null, $name=null) {
        return true;
    }

    function close() {
        return true;
    }

    function read($phpSessionId) {
        $out=$this->getCacheHandler()->getItem(self::createSessionKey($phpSessionId));
        if($out===false || $out == null)
            return '';
        return $out;
    }

    function write($phpSessionId, $data) {
        $method=/*$data ? */'setItem'/*:'replaceItem'*/;
        return call_user_func_array(
            array($this->getCacheHandler(), $method),
            array(self::createSessionKey($phpSessionId), $data, MEMCACHE_COMPRESSED, self::liftTime)
        );
    }

    function destroy($phpSessionId) {
        $this->getCacheHandler()->removeItem(self::createSessionKey($phpSessionId));
    }

    function gc() {
        return true;
    }

    private $cacheHandler;

    /**
     * @return \Zend\Cache\Storage\StorageInterface
     */
    private function getCacheHandler(){
        return $this->cacheHandler;
    }

    static private function createSessionKey($phpSessionId){
        return self::mcNamespace.$phpSessionId;
    }
}