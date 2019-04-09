<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}
//给模板提供数据 
$datas = ' ';

//读取数据语句
$sql = "SELECT id,cname FROM cgx_class_parent";

// 2.执行语句

$msql->execute($sql);

while ($res = $msql->fetchquery()) {

    $datas .= '<option value="'.$res['id'].'">'.$res['cname'].'<option>';
}


//载入模板
include 'pages/templates/classchildadd.html';
 