<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//定义变量
$tempStr = '';

//查询语句
$sql = "SELECT m.id,musicname,singer,composer,writer,price,dt,cname FROM cgx_music as m LEFT JOIN cgx_class_child as c ON(m.ccid = c.id)";

//执行语句
$msql->execute($sql);

//抓取数据
while ($res = $msql->fetchquery()) {

    //上架日期
    $date = date('Y-m-d',$res['dt']);

    //给模板提供数据
    $tempStr .= '        
        <tr>
        <td>' . $res['id'] . '</td>
        <td>' . $res['cname']. '</td>
        <td>' . $res['musicname'] . '</td>
        <td>' . $res['singer'] . '</td>
        <td>' . $res['composer'] . '</td>
        <td>' . $res['writer'] . '</td>
        <td>' . $res['price'] . '</td>
        <td>' . $date . '</td>
        <td><a href ="main.php?go=music_view&id='.$res['id'].'">预览</a>|<a href ="main.php?go=music_edit&id='.$res['id'].'">修改</a>|
        <a href ="main.php?go=music_del&id='.$res['id'].'">删除</a></td>
        </tr>
        ';
}

//载入模板
include 'pages/templates/musiclist.html';
 