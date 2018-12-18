#coding=utf-8

import socket
import  demjson
import  face_comm
import  face_handler

def handle_request(data):
    arrData=demjson.decode(data)
    retData={'code':0}

    #查找
    if arrData['cmd']=='search':
        retData['data'] = face_handler.query_face(arrData['pic'])

    #添加
    if arrData['cmd']=='add_index':
        if face_handler.add_face_index(arrData['id'],arrData['pic']):
            retData['data']={'succ':1}
        else:
            retData['data']={'succ':0}
    #检测
    if arrData['cmd']=='face_detect':
        retData['data']=face_handler.detect_face(arrData['pic'])
        retData['data']['boxes'] = retData['data']['boxes'].tolist()
    return face_comm.trans_string(retData)


host='0.0.0.0'
port=9999
ip_port = (host,port)

sk = socket.socket()
sk.bind(ip_port)
sk.setsockopt(socket.SOL_SOCKET,socket.SO_REUSEPORT,1)
sk.listen(5)

print 'server listening to '+host+':'+str(port)+'....'
while True:
    try:
        conn,addr = sk.accept()
        #数据长度
        len = conn.recv(4)
        data_length=int(len)

        #内容
        data=conn.recv(data_length)
        result=handle_request(data)
        conn.sendall(result)
        conn.close()
    except Exception as e:
        print e

