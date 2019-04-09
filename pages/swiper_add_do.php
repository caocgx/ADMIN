<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//接收表单数据
$title = trim($title);
$url = trim($url);
$photo = $_FILES['photo'];

//上传图片
$destFile = uploadFile($photo);

//入库
$sql = "INSERT INTO cgx_swiper(title,gourl,photo) VALUES ('".$title."','".$url."','".$destFile."')";

//执行语句
$msql -> execute($sql);

//返回执行结果
$as = $msql -> affectedRows();


if($as>0 && strpos($destFile,'load')){

    $result = "图片上传成功！数据入库成功！";

}else{

    $result = '图片'.$destFile."数据入库失败！";

}


//载入模板
include 'pages/templates/swiper_add_do.html';
 