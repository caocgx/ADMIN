<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//定义变量
$tempStr ='';

//查询语句
$sql = "SELECT b.id,b.cid,ccid,bookname,author,publicer,price,descript,dt,p.cname as pname,c.cname as cname FROM cgx_book as b LEFT JOIN
        cgx_class_parent as p ON(b.cid = p.id) LEFT JOIN cgx_class_child as c ON(c.id = b.ccid)";

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
        <td>' . $res['cname'] . '</td>
        <td>' . $res['bookname'] . '</td>
        <td>' . $res['author'] . '</td>
        <td>' . $res['publicer'] . '</td>
        <td>' . $res['price'] . '</td>
        <td>' . $date . '</td>
        <td><a href ="main.php?go=book_view&id='.$res['id'].'">预览</a>|<a href ="main.php?go=book_edit&id='.$res['id'].'">修改</a>|
        <a href ="main.php?go=book_del&id='.$res['id'].'">删除</a></td>
        </tr>
        ';
}

//载入模板
include 'pages/templates/booklist.html';
 