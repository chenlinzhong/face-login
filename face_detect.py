# coding: utf-8
import mxnet as mx
from mtcnn.mtcnn_detector import MtcnnDetector
import cv2
import os
import time

import  numpy as np
import  face_comm

model= os.path.abspath(face_comm.get_conf('mtcnn','model'))
class Detect:
    def __init__(self):
        self.detector = MtcnnDetector(model_folder=model, ctx=mx.cpu(0), num_worker=4, accurate_landmark=False)
    def detect_face(self,image):
        img = cv2.imread(image)
        results =self.detector.detect_face(img)
        boxes=[]
        key_points = []
        if results is not None:
            #box框
            boxes=results[0]
            #人脸5个关键点
            points = results[1]
            for i in results[0]:
                faceKeyPoint = []
                for p in points:
                    for i in range(5):
                        faceKeyPoint.append([p[i], p[i + 5]])
                key_points.append(faceKeyPoint)
        return {"boxes":boxes,"face_key_point":key_points}


if __name__=='__main__':
    pic='/Users/chenlinzhong/Downloads/temp.jpeg'
    detect = Detect()
    result = detect.detect_face(pic)
    print result
    exit(0)

