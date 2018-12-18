#coding=utf-8

'''
通过facenet得到的512特征写入lmdb文件中
'''

import  lmdb
import  os
import  face_comm

class face_lmdb:
    def add_embed_to_lmdb(self,id,vector):
        self.db_file=os.path.abspath(face_comm.get_conf('lmdb','lmdb_path'))
        id = str(id)
        evn = lmdb.open(self.db_file);
        wfp = evn.begin(write=True)
        wfp.put(key=id, value=face_comm.embed_to_str(vector))
        wfp.commit()
        evn.close()    

if __name__=='__main__':
    #插入数据
    embed = face_lmdb()
    embed.add_embed_to_lmdb(12,[1,2,0.888333,0.12343430])

    #遍历
    evn = lmdb.open(embed.db_file)
    wfp = evn.begin()
    for key,value in wfp.cursor():
        print key,face_comm.str_to_embed(value)
