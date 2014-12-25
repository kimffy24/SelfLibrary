<?php
namespace SelfLibrary\Ddd\Repository\Utils;

interface PersistInterface
{
    /**
     * 生成用於存儲的數據結構(php數組)
     * @return array
     */
    public function getParamsCopy();
}