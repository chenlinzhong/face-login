<?php
define('WEB_ROOT',dirname(__FILE__));

include_once  'comm.php';
require WEB_ROOT.'/libs/Smarty.class.php';
include_once  'DqMysql.php';
session_start();
try{
    if(isset($_SESSION['user'])){
        header('Location: /loginsucc.php');
    }

    if(isset($_GET['op']) && $_GET['op']=='identify'){
        $img =$_GET['img'];
        $result = Pic::search_pic($img);
        if(isset($result['data'][1][0]) && $result['data'][1][0]<1){
            $id = $result['data'][0][0];
            $arr=array(
                'code'=>0,
                'msg'=>'识别成功',
                'data'=>array(
                    'id'=>$id,
                    'rate'=>$result['data'][1][0],
                )
            );
            $userInfo = DqMysql::select('face_user','id='.$id);
            $_SESSION['user'] = $userInfo;
            echo json_encode($arr);
        }else{
            $arr=array(
                'code'=>1,
                'msg'=>'识别失败，重新识别或者先注册',
            );
            echo json_encode($arr);
        }
        exit(0);
    }

    $smarty = new Smarty;
    $smarty->caching = false;
    $smarty->cache_lifetime = 1;
    if(empty($_GET['op'])){
       $_GET['op']='login';
    }
    $smarty->assign('a','b');
    $smarty->assign('op',$_GET['op']);

    $smarty->assign('version',md5(rand(1,1000)));
    $smarty->display('login.tpl');
}catch (Exception $e){

}