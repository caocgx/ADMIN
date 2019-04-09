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

//二级分类名
$className = $res['cname'];

//二级分类ID
$class_cid = $res['ccid'];

//初始化
$datas = '';

//根据ID从数据中读取该一级分类下的二级分类
$sql1 = "SELECT id,cname FROM cgx_class_child WHERE cid = 20";

//执行语句
$msql->execute($sql1);

while ($rex = $msql->fetchquery()) {

    $datas .= '<option value="' . $rex['id'] . '">' . $rex['cname'] . '</option>';

}



//接收表单数据

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
include 'pages/templates/book_edit.html';
 