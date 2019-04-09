<?php

//引入公用文件
require_once('../include/common.in.php');

//接收数据($catagory/$pid)

//查询
switch ($catagory) {

    case 'book':
        $sql = "SELECT bookname as pname FROM cgx_book WHERE id=$pid LIMIT 1";
        break;

    case 'music':
        $sql = "SELECT musicname as pname FROM cgx_music WHERE id=$pid LIMIT 1";
        break;

    case 'movie':
        $sql = "SELECT moviename as pname FROM cgx_movie WHERE id=$pid LIMIT 1";
        break;
}

//执行语句
$msql -> execute($sql);

//获取数据
$res = $msql -> fetchquery();

//返回JSON
echo json_encode($res);

