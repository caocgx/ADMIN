<?php

//引入公用文件
require_once('../include/common.in.php');

//引入公用函数
require_once('../include/common.fn.php');

//接收openID
$openID = $openID;

//接收小程序提交的表单数据
$uname = trim($uname);
$tel = trim($tel);
$postcode = trim($postcode);
$address = trim($address);

$photo = $_FILES['file'];


//上传头像
$remoteUrl = uploadFile($photo,'../upload');
$remoteUrl = substr($remoteUrl,3);

$dt = time();

//查询表中是否已存在该用户，如果有，则修改，否则新创建
$sql  ="SELECT id FROM cgx_user WHERE openid='".$openID."' LIMIT 1";

$msql -> execute($sql);

$res  = $msql -> fetchquery();

if(!$res['id']){

    //入库语句
    $sql = "INSERT INTO cgx_user(openid,uname,tel,address,postcode,header,dt) VALUES ('".$openID."','".$uname."'
    ,'".$tel."','".$address."','".$postcode."','".$remoteUrl."',$dt)";

}else{
    
    //修改语句
    if($photo){//修改头像
        $sql  = "UPDATE cgx_user SET uname='".$uname."',tel='".$tel."',address='".$address."',postcode='".$postcode."',
        header='".$remoteUrl."' WHERE openid = '".$openID."' ";
    }else{//不修改头像
        $sql  = "UPDATE cgx_user SET uname='".$uname."',tel='".$tel."',address='".$address."',postcode='".$postcode."' WHERE openid = '".$openID."' ";
    }

}



$msql -> execute($sql);


//获取执行结果
$as = $msql -> affectedRows();

if($as>0){
    $result = 'success';
}else{
    $result = 'fail';
}

echo $result;

 