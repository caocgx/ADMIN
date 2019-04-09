<?php

//引入公用文件
require_once('../include/common.in.php');

//畅销书top3
$sql = "SELECT pid,sum(counts) as total,bookname,price FROM cgx_order as o LEFT JOIN cgx_book as b ON(o.pid=b.id) WHERE catagory='book' GROUP BY pid ORDER BY total DESC LIMIT 0,3";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {

    //获取图书封面
    $pid = $res['pid'];

    //查询封面
    $sql = "SELECT coverurl FROM cgx_cover WHERE bookid=$pid LIMIT 1";

    $msql->execute($sql, 'xxx');


    $res_cover = $msql->fetchquery('xxx');

    $res['coverurl'] = $res_cover['coverurl'];

    //处理标题(如果超过21个字符长度，则截取)
    $title = $res['bookname'];
    $titleLen  = strlen($title);
    if ($titleLen > 43) {
        $res['bookname'] = mb_substr($title, 0, 21, 'utf-8') . '...';
    }

    //处理价格
        //分割
        $price = explode('.', $res['price']);
        //整数部分
        $res['price_int']  = $price[0];
        //小数部分
        $res['price_float'] = $price[1];

    $res['titlrlength'] = strlen($title);

    $tempArr[] = $res;
}

echo json_encode($tempArr);
