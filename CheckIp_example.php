<?php
include_once 'src/businiao.lib/businiao.lib.php';
$appid='12345678';
$appkey='GetAppKeyAtThe:https://www.wechaturl.us'; 
//本功能的作用是屏蔽厂商的云端检测功能
$CheckIp=new CheckIp($appid,$appkey);
$ip=get_real_client_ip();
$data=$CheckIp->CheckIp($ip);
$result=json_decode($data,true);
print_r($result);//debug
if($result['code']==1){
    //here,show  error page
    http_response_code(404);
    exit('page no found!');
}


function get_real_client_ip(){
    $real_client_ip=$_SERVER['REMOTE_ADDR'];
    $ng_client_ip=( isset($_SERVER['HTTP_X_FORWARDED_FOR'])  ?   $_SERVER['HTTP_X_FORWARDED_FOR']    :   "");//反向代理
    
    if(isset($_SERVER['HTTP_CLIENTIP'])){
        $real_client_ip=$_SERVER['HTTP_CLIENTIP'];
    }
    if($ng_client_ip!="" and strlen($ng_client_ip)>5){
        if(strstr($ng_client_ip, ',')!=""){
            $a=explode(',', $ng_client_ip);
            $real_client_ip=$a[0];
        }else{
            $real_client_ip=$ng_client_ip;
        }
    }
    return $real_client_ip;
}