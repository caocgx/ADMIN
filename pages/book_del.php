<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//获取ID
$id = intval($id);

//删除语句（主表）
$sql = "DELETE FROM cgx_book WHERE id=$id";

$msql->execute($sql);

$as = $msql->affectedRows();

//如果主表数据删除成功了
if ($as > 0) {
    $sql = "SELECT coverurl FROM cgx_cover WHERE bookid=$id";
    $msql->execute($sql);
    while ($res = $msql->fetchquery()) {

        //文件路径
        $path = $res['coverurl'];

        //删除封面（文件）
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

//删除封面（数据）
$sql = "DELETE FROM cgx_cover WHERE bookid=$id";
$msql->execute($sql);
$as = $msql->affectedRows();
if($as>0){
    $result = '删除成功，返回图书列表<a href="main.php?go=booklist">back</a>';
}

// 跳转到列表页面
include 'pages/templates/book_del.html';
