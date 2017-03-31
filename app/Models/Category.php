<?php

namespace App\Models;

use App\Tools\RedisHandler;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //文章分类表模型(yue_category)
    protected $table='category';#表名
    protected $primaryKey='cate_id'; #主键
    public $timestamps=false;#关闭laravel自动管理时间戳列
    protected $guarded=[];#设置不可修改的字段


    public function insert($array)
    {
        if(!is_array($array))
            $array=$array->toArray();
        if(isset($array[$this->primaryKey])&&$array[$this->primaryKey]>0){
            $result=$this->where($this->primaryKey,$array[$this->primaryKey])->update($array);
            $result=$result ? $array : null;
        }else{
            $result=$this->create($array)->toArray();

        }
        $result=$result ? $result : null;
        if($result!=null){
            $redis=new RedisHandler();
            $redis->setModel($this->table,$result[$this->primaryKey],$result);
        }
        return $result;
    }

    public function get($id)
    {
        $redis=new RedisHandler();
        $result=$redis->getModel($this->table,$id);
        if(!$result){
            $result=$this->findOrFail($id)->toArray();
            $redis->setModel($this->table,$result[$this->primaryKey],$result);
        }
        return $result;
    }
}
