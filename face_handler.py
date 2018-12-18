#coding=utf-8

import face_detect

import  face_annoy
import  face_alignment
import  face_encoder
import  face_lmdb
detect = face_detect.Detect()
encoder = face_encoder.Encoder()
annoy = face_annoy.face_annoy()

#获得对齐人脸图片
def get_align_pic(pic):
    result = detect.detect_face(pic)
    if len(result['boxes']):
        align = face_alignment.Alignment()
        return  align.align_face(pic, result['face_key_point'])
    else:
        return None

#计算人脸特征
def get_face_embed_vector(align_pic):
    return encoder.generate_embedding(align_pic)



#添加图片索引
def add_face_index(id,pic):
    align_face = get_align_pic(pic)
    if align_face is not None:
        #获取人脸特征
        face_vector = get_face_embed_vector(align_face)
        # 插入数据
        embed = face_lmdb.face_lmdb()
        embed.add_embed_to_lmdb(id,face_vector)
        #更新索引
        annoy.create_index_from_lmdb()
        annoy.reload()
        return True
    else:
        return False


def query_face(pic):
    align_face = get_align_pic(pic)
    if align_face is not None:
        #获取人脸特征
        face_vector = get_face_embed_vector(align_face)
        return annoy.query_vector(face_vector)

def detect_face(pic):
    result = detect.detect_face(pic)
    return result

if __name__=='__main__':

    pic='/Users/chenlinzhong/Documents/v_project/t_faceproject/web/images/meizi2.jpeg'
    #add_face_index(14,pic)
    #print query_face(pic)
    #print detect_face(pic)