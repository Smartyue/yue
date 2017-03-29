<?php
/**
 * Created by PhpStorm.
 * User: yuanjianxin
 * Date: 2017/3/29
 * Time: 下午5:39
 */
namespace App\Tools;

use Illuminate\Support\Facades\Redis;

class RedisHandler{
    //rewrite redis
    private $prefix=null;

    public function __construct()
    {
        //获取redis存储前缀
        $this->prefix=env('REDIS_PREFIX','yue');
    }

    /**
     * @param $table_name
     * @param $id
     * @return mixed|null
     */
    public function getModel($table_name,$id)
    {
        //组装要查询的redis键
        $key=$this->prefix.'_'.$table_name.':'.$id;

        //判断该键是否存在
        if(!Redis::exists($key)){
            return null;
        }

        $model=Redis::get($key);
        return json_decode($model,true);
    }

    /**
     * @param $table_name
     * @param $id
     * @param $model
     * @param bool $lock
     */
    public function setModel($table_name,$id,$model,$lock=false)
    {
        //组装要查询的redis键
        $key=$this->prefix.'_'.$table_name.':'.$id;
        //判断是否需要加锁
        if($lock){
            Redis::setnx($key,json_encode($model));
        }else{
            Redis::set($key,json_encode($model));
        }
    }

    /**
     * @param $table_name
     * @param $id
     */
    public function removeModel($table_name,$id)
    {
        //组装要查询的redis键
        $key=$this->prefix.'_'.$table_name.':'.$id;
        Redis::del($key);
    }


    /**
     * @param $method
     * @param $key
     * @param $value
     * @return null
     */
    public function redisCmd($method,$key,$value=null)
    {
        $result=null;
        switch ($method){
            case 'set':
                $result=Redis::set($key,$value);
                break;
            case 'get':
                $result=Redis::get($key);
                break;
            case 'remove':
                $result=Redis::del($key);
                break;
            default:
                $result=null;
        }
        return $result;
    }

}