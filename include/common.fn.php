<?php
    //检查登录权限
function checkAuthor()
{
    //获取session  //如果session不符合规则
    if (!$_SESSION['admin'] && !preg_match('^/[A-Z]{6}/', $_SESSION['admin'])) {
        //跳转函数
        jump('login.html');
        //阻止代码继续执行
        die();
    }
}

function jump($go, $time = '1000')
{
    echo '<script>';
    echo 'setTimeout(function(){location.href="' . $go . '";},' . $time . ')';
    echo '</script>';
}

function uploadFile($arrFile,$dir='upload')
{   
    
    //判断路径是否存在，不存在则创建
    if(!file_exists($dir)){
        mkdir($dir);
    }

    //确保提交了数据
    if(is_array($arrFile['name'])){//上传多个文件

        //上传的文件名
        $arrFn = $arrFile['name'];

        //临时文件
        $arrTemp = $arrFile['tmp_name'];

        
        //定义临时数组
        $tempDestArr = array();

        //遍历临时文件
        foreach ($arrTemp as $key => $item) {

            //临时文件名
            $tempFile = $item;

            //新文件名
            $newFileName = time() . mt_rand(1, 100);

            //旧文件名
            $oldFileName = $arrFn[$key];

            //扩展名
            $pathInfo = pathinfo($oldFileName);
            $extension = $pathInfo['extension'];

            //完整的服务文件路径
            $destFile = $dir.'/' . $newFileName . '.' . $extension;

            //执行上传
            if (move_uploaded_file($tempFile, $destFile)) {

                $tempDestArr[] = $destFile;
            }
        }
        
        //只返回上传成功的文件
        return $tempDestArr;

    }else{//上传单个文件
           
        //临时文件
        $tempFile = $arrFile['tmp_name'];

        //新文件名
        $newFileName = time() . mt_rand(1, 100);

        //旧文件名
        $oldFileName = $arrFile['name'];

        //扩展名
        $pathInfo = pathinfo($oldFileName);
        $extension = $pathInfo['extension'];

        //完整的服务文件路径
        $destFile = $dir.'/' . $newFileName . '.' . $extension;

          //执行上传
          if (move_uploaded_file($tempFile, $destFile)) {
            return $destFile;
        } else {
            return '上传失败！<br />';
        }
    }
}
 