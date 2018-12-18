<?php
ini_set('display_errors','on');

$imgBase64=$_POST['img'];

$arr=array(
    'code'=>10000,
    'data'=>array('file_path'=>base64_image_content($imgBase64,'./images/')),
);

echo json_encode($arr);exit;

function base64_image_content($base64_image_content,$path){
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $new_file = $path."/";
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700,true);
        }
        $new_file = $new_file.time().".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            return $new_file;
        }else{
            return false;
        }
    }else{
        return false;
    }
}