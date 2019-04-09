<?php

//引入公用文件
require_once('../include/common.in.php');

////////////////////////////////////////////////////////////////////////////////////////////////////////////

//五星图书
$sql = "SELECT b.id,pid,bookname,price,coverurl FROM cgx_comment as c LEFT JOIN cgx_book as b ON(c.pid = b.id) LEFT JOIN cgx_cover as x ON(c.pid = x.bookid) WHERE stars=5 AND catagory='book' ORDER BY c.id DESC LIMIT 1";

$msql->execute($sql);

$res = $msql->fetchquery();

//符合条件的ID
$book_pid = $res['pid'];

//根据PID统计评论数
$sql = "SELECT count(*) as total FROM cgx_comment WHERE pid=$book_pid";

$msql->execute($sql);

$res_book_count = $msql->fetchquery();

$res['counts'] = $res_book_count['total'];

$allDatasArr['book'] = $res;

/////////////////////////////////////////////////////////////////////////////////////////////////////////

//五星音乐
$sql = "SELECT b.id,pid,musicname,price,coverurl FROM cgx_comment as c LEFT JOIN cgx_music as b ON(c.pid = b.id)  WHERE stars=5 AND catagory='music' ORDER BY c.id DESC LIMIT 1";

$msql->execute($sql);

$res = $msql->fetchquery();

//符合条件的ID
$music_pid = $res['pid'];

//根据PID统计评论数
$sql = "SELECT count(*) as total FROM cgx_comment WHERE pid=$music_pid";

$msql->execute($sql);

$res_music_count = $msql->fetchquery();

$res['counts'] = $res_music_count['total'];

$allDatasArr['music'] = $res;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//五星电影
$sql = "SELECT b.id,pid,moviename,price,coverurl FROM cgx_comment as c LEFT JOIN cgx_movie as b ON(c.pid = b.id)  WHERE stars=5 AND catagory='movie' ORDER BY c.id DESC LIMIT 1";

$msql->execute($sql);

$res = $msql->fetchquery();

//符合条件的ID
$movie_pid = $res['pid'];

//根据PID统计评论数
$sql = "SELECT count(*) as total FROM cgx_comment WHERE pid=$movie_pid";

$msql->execute($sql);

$res_movie_count = $msql->fetchquery();

$res['counts'] = $res_movie_count['total'];

$allDatasArr['movie'] = $res;





echo json_encode($allDatasArr);
