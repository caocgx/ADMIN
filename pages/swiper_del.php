<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//接收ID
$id = intval($id);

//删除文件
$sql = "SELECT photo FROM cgx_swiper WHERE id = $id LIMIT 1";

$msql->execute($sql);

$res = $msql->fetchquery();

//轮播封面地址
$photoUrl = $res['photo'];


//判断文件是否存在，如果存在则删除
if (file_exists($photoUrl)) {
    @unlink($photoUrl);
}


//删除数据
$sql = "DELETE FROM cgx_swiper WHERE id = $id";

//执行语句
$msql->execute($sql);

$as = $msql->affectedRows();
if ($as > 0) {
    $result = '删除成功！';
} else {
    $result = '删除失败！';
}

// 载入模板
include 'pages/templates/swiper_del.html';

