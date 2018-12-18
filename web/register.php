<?php
include_once  'DqMysql.php';
include_once  'comm.php';

$arr=array(
    'img'=>$_GET['img'],
    'user_name'=>$_GET['user_name'],
    'email'=>$_GET['email'],
);

$code = 10000;
try {
    //检测人脸是否存在人脸
    $faceInfo = Pic::detect_face($arr['img']);
    if(count($faceInfo['data']['boxes'])<=0){
        $code = 10001;
        throw  new Exception('检测人脸失败');
    }

    //检测人脸是否已经注册过
    $registedInfo = Pic::search_pic($arr['img']);
    if(isset($registedInfo['data'][1][0])){
        if($registedInfo['data'][1][0]<1) {
            $code = 10002;
            throw  new Exception('改用户已经存在,距离：'.$registedInfo['data'][1][0]);
        }
    }

    $id = DqMysql::insertData('face_user',$arr);
    if($id){
        $result = Pic::add_face($id,$arr['img']);
        if(!$result['data']['succ']){
            $code = 10003;
            throw  new Exception('添加索引失败');
        }
    }
    echo json_encode(array('code'=>$code,'msg'=>'注册成功'));
}catch (Exception $e){
    echo json_encode(array('code'=>$code,'msg'=>$e->getMessage()));
}


