<?php

namespace App\Http\Controllers;

use App\Tools\RedisHandler;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public $user;
    public $auth;
    public $client;
    public $clientIp;
    const cookiesTime=4320000;//24*60*3000 s

    const PrivateKey='Yue.';//私钥

    const AppKey='app';

    public function formatResult($dataSource,$statusCode=0)
    {
        $data['auth']=$this->auth;
        $data['result']=$dataSource;
        $data['status']=$statusCode;
        $data['servertime']=time()*1000;//服务器时间 毫秒
        return json_encode($data);
    }

    public function setUser($user){
        if($user != null){
            $this->user=$user;
            $this->refreshUserCookie();
            return true;
        }
    }

    public function refreshUserCookie()
    {
        $uid=$this->user ==null ? 0 : $this->user['id'];
        $time=time()+self::cookiesTime;
        $pkey=self::PrivateKey;
        $key="$uid|$time|$pkey";
        $key=sha1($key); //生成唯一标识

        //todo 这里以后可能要加入权限信息
        $this->auth=['uid'=>$uid,'time'=>$time,'key'=>$key];

        $authStr=json_encode($this->auth);
        //判断认证类别（app/web）
        if(isset($this->client)&&$this->client==self::AppKey){
            //如果是app请求接口，将用户身份信息写入到redis中
            $redis=new RedisHandler();
            $redis->redisCmd('set',$key,$authStr);
        }else{
             setcookie('auth_yue', $authStr, time() + self::cookiesTime, '/', $_SERVER['HTTP_HOST']);
             setcookie('auth_yue', $authStr, time() + self::cookiesTime, '/', $_SERVER['SERVER_NAME']);
        }
    }
    
    
    /**
     * 获取用户密钥
     */
    public function getUserSecretKey($username)
    {
        //获取分钟戳
        $timestamp=ceil(time()/60);
        $privateKey=self::PrivateKey;
        $str="$username|$privateKey|$timestamp";
        $str=substr(md5($str),0,6);
        $str=str_split($str);
        $secret="";
        foreach ($str as $v){
            $index=hexdec(bin2hex($v));
            $index=$index%8;
            $secret.=$index;
        }
        return $secret;
    }

}
