<?php


//编码
header("Content-type:text/html;charset=utf8");


//接收表单数据


//类型
$sclass = trim($sclass);

//国际
$cclass = trim($cclass);

//片名
$moviename = trim($moviename);

//导演
$director = trim($director);

//编剧
$writer = trim($writer);

//主演
$roles = trim($role);

//价格
$price = $price;

//片长
$longs = intval($long);

//封面
$poster = $_FILES['poster'];

//花絮地址
$movieurl = trim($movieurl);

//简介
$descript = trim($descript);

//上架日期(转换为时间戳)
$dt = strtotime($dt);

////////////////////////////////////////////////////////////////////////////////////////


if (!$moviename) {
    $result = '请填写影片名称！';
} else {

    //上传文件
    //上传封面
    $destPosterUrl = uploadFile($poster);

    //数据入库
    //语句
    $sql = "INSERT INTO cgx_movie(cid,class_style,class_country,moviename,director,writer,roles,price,longs,coverurl,movieurl,descript,dt) VALUES(22,'" . $sclass . "','" . $cclass . "',
           '" . $moviename . "','" . $director . "','" . $writer . "','" . $roles . "',$price,$longs,'" . $destPosterUrl . "','" . $movieurl . "','" . $descript . "',$dt)";

    //执行语句
    $msql->execute($sql);

    //获取执行结果
    $as = $msql->affectedRows();

    if ($as > 0) {
        $result = '入库成功！';
    } else {
        $result = '入库失败！';
        $msql->error();
    }
};


//载入模板
include 'pages/templates/movie_add_do.html';
