#coding=utf-8

import  ConfigParser
import  demjson

#读取配置文件
def get_conf(key,value):
    cf = ConfigParser.ConfigParser()
    cf.read('config.ini')
    return cf.get(key,value)


def embed_to_str(vector):
    new_vector = [str(x) for x in vector]
    return ','.join(new_vector)


def str_to_embed(str):
    str_list = str.split(',')
    return [float(x) for x in str_list]


def fmt_data(arrData):
    str= demjson.encode(arrData)
    str_len=len(str)
    str_len="%04d"%str_len
    return str_len+str

def trans_string(retData): 
    fp=open('json_tmp.txt','w')
    print >> fp, retData
    fp.close()
    return get_json_data()

def get_json_data():
    f = open('json_tmp.txt')
    line = f.readline()
    f.close()
    str_len = len(line)-1
    str_len = "%04d" % str_len
    return str_len + line

if __name__=='__main__':
    print get_conf('annoy','index_path')