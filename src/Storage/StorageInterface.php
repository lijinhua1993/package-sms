<?php

namespace Lijinhua\Sms\Storage;

/**
 * Interface StorageInterface
 */
interface StorageInterface
{
    /**
     * 设置
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value): void;

    /**
     * 获取
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default): mixed;

    /**
     * 删除
     *
     * @param $key
     */
    public function forget($key): void;
}
