<?php

//编码
header("Content-type:text/html;charset=utf8");


//接收表单数据


//二级分类ID
$cclass = intval($cclass);

//歌名
$musicname = trim($musicname);

//歌手
$singer = trim($singer);

//编曲
$composer = trim($composer);

//填词
$writer = trim($writer);

//价格
$price = trim($price);

//封面
$poster = $_FILES['poster'];

//音乐
$music = $_FILES['music'];

//歌词
$words = trim($words);

//上架日期(转换为时间戳)
$dt = strtotime($dt);

////////////////////////////////////////////////////////////////////////////////////////

//上传文件
//上传封面

$destPosterUrl = uploadFile($poster);

//上传音乐
$destMusicUrl = uploadFile($music, 'upload/music');

if (!$musicname) {
    $result = '您有未填项！';
} else {

    //数据入库
    //语句
    $sql = "INSERT INTO cgx_music(cid,ccid,musicname,singer,composer,writer,price,words,musicurl,coverurl,dt) VALUES(21,$cclass,
           '" . $musicname . "','" . $singer . "','" . $composer . "','" . $writer . "',$price,'" . $words . "','" . $destMusicUrl . "','" . $destPosterUrl . "',$dt)";

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
include 'pages/templates/music_add_do.html';
