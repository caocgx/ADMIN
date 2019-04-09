<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//初始化
$datas = '';

//查询语句
$sql = "SELECT id,title,photo,gourl FROM cgx_swiper";

//执行语句
$msql -> execute($sql);

//抓取数据
while($res = $msql -> fetchquery()){

    $datas .= '        
    <tr>
    <td>' . $res['id'].'</td>
    <td>' . $res['title']. '</td>
    <td>' . $res['photo']. '</td>
    <td>' . $res['gourl'] . '</td>
    <td><a href ="main.php?go=swiper_view&id='.$res['id'].'">预览</a>|<a href ="main.php?go=swiper_edit&id='.$res['id'].'">修改</a>|
    <a href ="main.php?go=swiper_del&id='.$res['id'].'">删除</a></td>
    </tr>
    ';

}

//载入模板
include 'pages/templates/swiper.html';
 