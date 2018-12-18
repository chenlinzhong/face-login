#coding=utf-8

import  face_comm
from annoy import AnnoyIndex
import  lmdb
import  os


class face_annoy:
  
    def __init__(self):
        self.f                = int(face_comm.get_conf('annoy','face_vector'))
        self.annoy_index_path = os.path.abspath(face_comm.get_conf('annoy','index_path'))
        self.lmdb_file        =os.path.abspath(face_comm.get_conf('lmdb','lmdb_path'))
        self.num_trees        =int(face_comm.get_conf('annoy','num_trees'))

        self.annoy = AnnoyIndex(self.f)
        if os.path.isfile(self.annoy_index_path):
            self.annoy.load(self.annoy_index_path)

    #从lmdb文件中建立annoy索引
    def create_index_from_lmdb(self):
        # 遍历
        lmdb_file = self.lmdb_file
        if os.path.isdir(lmdb_file):
            evn = lmdb.open(lmdb_file)
            wfp = evn.begin()
            annoy = AnnoyIndex(self.f)
            for key, value in wfp.cursor():
                key = int(key)
                value = face_comm.str_to_embed(value)
                annoy.add_item(key,value)

            annoy.build(self.num_trees)
            annoy.save(self.annoy_index_path)

    #重新加载索引
    def reload(self):
        self.annoy.unload()
        self.annoy.load(self.annoy_index_path)

    #根据人脸特征找到相似的
    def query_vector(self,face_vector):
        n=int(face_comm.get_conf('annoy','num_nn_nearst'))
        return self.annoy.get_nns_by_vector(face_vector,n,include_distances=True)


if __name__=='__main__':
    annoy  = face_annoy()
    annoy.create_index_from_lmdb()