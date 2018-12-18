


//初始化背景
var options={
    'canvasContainerID':"canvas-container"
}
var bg=new LogBackground(options)


var user_image_file=''




var vendorUrl = window.URL || window.webkitURL;
var video_id='video'
var canvas_id='canvas'



function init_obj(canvas_id,video_id){
    canvas = document.getElementById(canvas_id);
    context =canvas.getContext('2d');
    video = document.getElementById(video_id);
}
init_obj(canvas_id,video_id)

is_stop = 0
function open_camera() {
    //媒体对象
    navigator.getMedia = navigator.getUserMedia ||
        navagator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;
    navigator.getMedia({
        video: true, //使用摄像头对象
        audio: false  //不适用音频
    }, function (strem) {
        console.log(strem);
        video.src = vendorUrl.createObjectURL(strem);
        video.play();
    }, function (error) {
    });
    video.ontimeupdate = function () {
        if (is_stop) return
        context.drawImage(video, 0, 0, video.width, video.height);
        var base64 = canvas.toDataURL('images/png');
        $('#'+canvas_id).faceDetection({
            complete: function (faces) {
                if (faces.length == 1 && faces[0].width>60) {
                    is_stop = 1;
                    draw_face_box(faces)
                    $('.find-face').show()
                    upload(base64,faces)
                }
                console.log(faces)
            }
        });
    }
}

$('.find-face').click(function () {
    is_stop =0;
    $('.find-face').hide();
    return false;
})


$('.r-camera').click(function () {
    $('.video-container').show()
    $('#video').hide();
    open_camera()
})

//画出人脸区域
function draw_face_box(faces) {
    var rect;
    var i;
    //context.clearRect(0, 0, canvas.width, canvas.height);
    for(i=0;i<faces.length;i++) {
        rect = faces[i];
        context.strokeStyle = '#a64ceb';
        //if(rect.width<60) return
        context.strokeRect(rect.x, rect.y, rect.width, rect.height);
        context.font = '11px Helvetica';
        context.fillStyle = "#fff";
        context.fillText('x: ' + rect.x + 'px', rect.x + rect.width + 5, rect.y + 11);
        context.fillText('y: ' + rect.y + 'px', rect.x + rect.width + 5, rect.y + 22);
    }
}
//上传人脸图片
function upload(base64,face) {
    $.ajax({
        "type":"POST",
        "url":"/upload.php",
        "data":{'img':base64},
        'dataType':'json',
        beforeSend:function(){},
        success:function(result){
            console.log(result)
            user_image_file = result.data.file_path
            if($('#op').val()=='login'){
                identify(user_image_file)
            }
        }
    });
}

function identify(img) {
    $.ajax({
        "type":"GET",
        "url":"/login.php?op=identify",
        "data":{'img':img},
        'dataType':'json',
        beforeSend:function(){},
        success:function(result) {
            alert(result.msg)
            if(result.code==0){
                window.location.reload();
            }
        }
    });
}

function isNull( str ){
    if ( str == "" ) return true;
    var regu = "^[ ]+$";
    var re = new RegExp(regu);
    return re.test(str);
}


$('.btn-default').click(function () {

    var data={
        'img':user_image_file,
            'user_name':$('.user_name').val(),
            'email':$('.email').val()
        };
    if(isNull(data.img)){
        alert('请先拍照');
        return ;
    }
    if(isNull(data.user_name)){
        alert('请输入昵称');
        return ;
    }
    if(isNull(data.email)){
        alert('请输入邮箱');
        return ;
    }
    $.ajax({
        "type":"GET",
        "url":"/register.php",
        "data":data,
        'dataType':'json',
        'async':false,
        beforeSend:function(){},
        success:function(result){
            alert(result.msg)
        }
    });
});

$('.btn-tab').click(function () {
    var op = $(this).attr('data-op');
    window.location.href='/login.php?op='+op
})


$('#login-logo').click(function () {
    $(this).hide()
    video_id='video2'
    canvas_id='canvas2'
    init_obj(canvas_id,video_id)
    $('#'+video_id).hide()
    open_camera()
});



