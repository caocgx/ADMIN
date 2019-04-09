<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//一级分类名称入库
$sql = "INSERT INTO cgx_class_parent(cname) VALUES ('" . $title . "')";

//执行语句
$msql -> execute($sql);

//获取执行结果
$res = $msql -> affectedRows();


//判断返回结果
if($res>0){
   $result= '创建成功！';
}else{
   $result= '创建失败！';
}

//给模板提供数据
// $content = 'Welcome page!';

//载入模板
include 'pages/templates/classparentaddo.html';
 