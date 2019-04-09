<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//1.获取ID
$id = intval($id);

//2.获取表单新值
$title = trim($title);

//3.修改语句
$sql = "UPDATE cgx_class_parent SET cname='".$title."' WHERE id=$id ";

//4.执行语句
$msql -> execute($sql);

//5.返回执行结果
$res = $msql ->affectedRows();

if($res > 0){
    $result = '修改成功！';
}else{
    $result = '修改成功！';
}

//载入模板
include 'pages/templates/classparenteditdo.html';


?>
 