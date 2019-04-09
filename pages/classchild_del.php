<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//给模板提供数据
$datas = '';

//1.获取ID
$id = intval($id);

//2.删除语句
$sql = "DELETE FROM cgx_class_child WHERE id=$id ";

//3.执行语句
$msql->execute($sql);

//4.执行结果
$res = $msql->affectedRows();

if ($res > 0) {
    $result = '删除成功！';

} else {
    $result = '删除失败！';
}


//载入模板
include 'pages/templates/classchild_del.html';
 