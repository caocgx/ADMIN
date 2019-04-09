<?php

//引入公用文件
require_once('../include/common.in.php');

// 初始化
$tempArr =  array();

if ($openID) {

    $sql = "SELECT pid,catagory FROM cgx_order WHERE openid='" . $openID . "'";
    $msql->execute($sql);

    while ($res = $msql->fetchquery()) {

        //分类
        $class = $res['catagory'];

        //产品ID
        $pid = $res['pid'];

        //根据不同的分类，去不同的表中查找该pid对应的数据（名称，封面，价格）
        if ($class == 'book') {

            $sql = "SELECT bookname,price,coverurl FROM cgx_book as b LEFT JOIN cgx_cover as c ON(b.id=c.bookid) LIMIT 1";

            $msql->execute($sql, 'book');

            $res_book = $msql->fetchquery('book');

            //产品名称
            $res_book['pname'] = $res_book['bookname'];

            //产品价格
            $pprice = $res_book['price'];

            //产品封面
            $pcover = $res_book['coverurl'];

            //分类
            $res_book['catagory'] = $class;

            //产品ID
            $res_book['pid'] = $pid;

            //上架日期
            $res_book['dt'] = date('Y-m-d', $res['dt']);

            //评论
            $sql = "SELECT stars,notes,dt FROM cgx_comment WHERE catagory = 'book' AND pid=$pid
                   AND openid='".$openID."' ORDER BY id DESC  LIMIT 1";
            $msql->execute($sql, 'book_comment');
            $res_comment = $msql->fetchquery('book_comment');
            $res_comment['date']  = date('Y-m-d', $res_comment['dt']);

            $res_book['comment'] = $res_comment;

            $msql ->error();


            $tempArr[] = $res_book;
        }

        if ($class == 'music') {

            $sql = "SELECT musicname,price,coverurl FROM cgx_music  LIMIT 1";

            $msql->execute($sql, 'music');

            $res_music = $msql->fetchquery('music');

            //产品名称
            $res_movie['pname'] = $res_movie['musicname'];

            //产品价格
            $pprice = $res_music['price'];

            //产品封面
            $pcover = $res_music['coverurl'];

            //分类
            $res_music['catagory'] = $class;

            //产品ID
            $res_music['pid'] = $pid;

            //上架日期
            $res_music['dt'] = date('Y-m-d', $res['dt']);

            //评论
            $sql = "SELECT stars,notes,dt FROM cgx_comment WHERE catagory = 'music' AND pid=$pid
             AND openid='" . $openID . "' ORDER BY id DESC  LIMIT 1";
            $msql->execute($sql, 'music_comment');
            $res_comment = $msql->fetchquery('music_comment');
            $res_comment['date']  = date('Y-m-d', $res_comment['dt']);

            $res_music['comment'] = $res_comment;

            $tempArr[] = $res_music;
        }

        if ($class == 'movie') {

            $sql = "SELECT moviename,price,coverurl FROM cgx_movie LIMIT 1";

            $msql->execute($sql, 'movie');

            $res_movie = $msql->fetchquery('movie');

            //产品名称
            $res_movie['pname'] = $res_movie['moviename'];

            //产品价格
            $pprice = $res_movie['price'];

            //产品封面
            $pcover = $res_movie['coverurl'];

            //分类
            $res_movie['catagory'] = $class;

            //产品ID
            $res_movie['pid'] = $pid;

            //上架日期
            $res_movie['dt'] = date('Y-m-d', $res['dt']);

            //评论
            $sql = "SELECT stars,notes,dt FROM cgx_comment WHERE catagory = 'movie' AND pid=$pid
             AND openid='" . $openID . "' ORDER BY id DESC  LIMIT 1";
            $msql->execute($sql, 'movie_comment');
            $res_comment = $msql->fetchquery('movie_comment');
            $res_comment['date']  = date('Y-m-d', $res_comment['dt']);

            $res_book['comment'] = $res_comment;

            $tempArr[] = $res_movie;
        }
    }
}

echo json_encode($tempArr);
