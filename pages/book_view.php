<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//获取ID
$id = intval($id);

//根据该ID获取数据
$sql = "SELECT b.id,b.cid,ccid,bookname,author,publicer,price,descript,dt,c.cname as cname FROM cgx_book as b 
        LEFT JOIN cgx_class_child as c ON(c.id = b.ccid) WHERE b.id=$id LIMIT 1";

//执行语句
$msql -> execute($sql);

//获取数据
$res = $msql ->fetchquery();

//接收表单数据


//分类名
$className = $res['cname'];

//书名
$bookname = $res['bookname'];

//作者
$author = $res['author'];

//出版社
$publicer = $res['publicer'];

//价格
$price = $res['price'];

//上架日期
//把时间戳转换为日期格式
$dt = date( 'Y-m-d',$res['dt']);

//介绍
$descript = $res['descript'];

//载入模板
include 'pages/templates/book_view.html';
 