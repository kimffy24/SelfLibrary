<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/9/15
 * Time: 9:49 AM
 */

namespace SelfLibrary\Ddd\Aggregate;

use SelfLibrary\Ddd\Aggregate\Utils\EasyProperties;
use SelfLibrary\Ddd\Aggregate\Utils\AggregateInterface;
use SelfLibrary\Ddd\Repository\Utils\PersistInterface;

abstract class AbstractAggregateRoot implements AggregateInterface,PersistInterface{

    /**
     * @desc 获取聚合根对象标识
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @desc 设置聚合根对象标识
     * @param $id
     */
    public function setId($id){
        $this->id = $id;
    }

    private $id;
} 