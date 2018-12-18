#coding=utf-8
import  face_comm
import  face_detect
import  cv2
import  numpy as np
import  os
import  time
import  random

class Alignment:
    def align_face(self,opic,faceKeyPoint):
        img = cv2.imread(opic)
        faceKeyPoint = faceKeyPoint[0]

        #根据两个鼻子和眼睛进行3点对齐
        eye1 = faceKeyPoint[0]
        eye2 = faceKeyPoint[1]
        noise = faceKeyPoint[2]
        source_point = np.array(
            [eye1, eye2, noise], dtype=np.float32
        )

        eye1_noraml= [int(x) for x in face_comm.get_conf('alignment','left_eye').split(',')]
        eye2_noraml=[int(x) for x in face_comm.get_conf('alignment','right_eye').split(',')]
        noise_normal=[int(x) for x in face_comm.get_conf('alignment','noise').split(',')]
        #设置的人脸标准模型

        dst_point = np.array(
            [eye1_noraml,
             eye2_noraml,
             noise_normal],
            dtype=np.float32)

        tranform = cv2.getAffineTransform(source_point, dst_point)

        imagesize=tuple([int(x) for x in face_comm.get_conf('alignment','imgsize').split(',')])
        img_new = cv2.warpAffine(img, tranform, imagesize)
        new_image= os.path.abspath(face_comm.get_conf('alignment','aligment_face_dir'))
        new_image= new_image+'/'+'%d_%d.png'%(time.time(),random.randint(0,100))
        if cv2.imwrite(new_image, img_new):
            return new_image
        return None

if __name__=='__main__':
    pic='/Users/chenlinzhong/Downloads/laji.png'
    detect = face_detect.Detect()
    result = detect.detect_face(pic)
    if len(result['boxes']):
        align  = Alignment()
        print 'align face: '+ align.align_face(pic,result['face_key_point'])
    else:
        print 'not found face'