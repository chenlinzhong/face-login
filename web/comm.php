<?php
ini_set('display_errors','on');
class Pic
{
    const FACE_SERVER_IP='10.210.234.203';
    const FACE_SERVER_PORT=9999;
    static function search_pic($pic)
    {
        $pic = str_replace('./images', './web/images', $pic);
        $arr=array(
            'cmd'=>'search',
            'pic'=>$pic
        );
        return self::getResult($arr);
    }

    static function add_face($id,$pic){
        $pic = str_replace('./images', './web/images', $pic);
        $arr=array(
            'cmd'=>'add_index',
            'pic'=>$pic,
            'id'=>$id,
        );
        return self::getResult($arr);
    }

    static function detect_face($pic){
        $pic = str_replace('./images', './web/images', $pic);
        $arr=array(
            'cmd'=>'face_detect',
            'pic'=>$pic,
        );
        return self::getResult($arr);
    }

    static function getResult($arr){
        $fd = self::connect();
        if($fd){
            list($len,$data) = self::format_data($arr);
            if(socket_write($fd,$data,$len)){
                $n_len = socket_read($fd,4);
                if($n_len>0){
                    $data=socket_read($fd,$n_len);
                    $data = str_replace("'",'"',$data);
                    $data = str_replace('(','[',$data);
                    $data = str_replace(')',']',$data);
                    return json_decode($data,true);
                }
            }

        }else{
            throw  new Exception('occer error');
        }
    }

    static function connect()
    {
        $fd = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        //1s内没处理完直接返回
        socket_set_option($fd, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 5, "usec" => 0));
        if (!is_resource($fd)) {
            return false;
        }
        if (!socket_connect($fd, self::FACE_SERVER_IP, self::FACE_SERVER_PORT)) {
            return false;
        }
        return $fd;
    }

    public static function format_data($params){
        $str = json_encode($params);
        $len = strlen($str);
        $packageData=sprintf('%04d%s',$len,$str);
        return array($len+4,$packageData);
    }
}



