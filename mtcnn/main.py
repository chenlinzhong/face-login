# coding: utf-8
import mxnet as mx
from mtcnn_detector import MtcnnDetector
import cv2
import os
import time

import  numpy as np

detector = MtcnnDetector(model_folder='model', ctx=mx.cpu(0), num_worker = 4 , accurate_landmark = False)


img = cv2.imread('/Users/chenlinzhong/Downloads/test2.png')

#run detector   
results = detector.detect_face(img)
print results
if results is not None:

    total_boxes = results[0]
    print total_boxes
    points = results[1]
    print points

    # extract aligned face chips
    chips = detector.extract_image_chips(img, points, 144, 0.8)
    #for i, chip in enumerate(chips):
        #cv2.imshow('chip_'+str(i), chip)
        #cv2.imwrite('chip_'+str(i)+'.png', chip)

    draw = img.copy()
    for b in total_boxes:
        cv2.rectangle(draw, (int(b[0]), int(b[1])), (int(b[2]), int(b[3])), (255, 255, 255))

    # 人脸对齐点
    faceKeyPoint=[]
    for p in points:
        for i in range(5):
            faceKeyPoint.append([p[i],p[i+5]])
            cv2.circle(draw, (p[i], p[i + 5]), 1, (0, 0, 255), 2)
    eye1  = faceKeyPoint[0]
    eye2  = faceKeyPoint[1]
    noise = faceKeyPoint[2]

    source_point=np.array(
     [eye1,eye2,noise],dtype=np.float32
    )
    dst_point = np.array(
        [[56, 98],
         [135, 98],
         [94, 152]],
        dtype=np.float32)

    tranform = cv2.getAffineTransform(source_point, dst_point)



    img_new = cv2.warpAffine(img, tranform, (191, 233))

    cv2.imshow('test', img_new)

    cv2.waitKey(0)


# --------------
# test on camera
# --------------


'''
camera = cv2.VideoCapture(0)
while True:
    grab, frame = camera.read()
    img = cv2.resize(frame, (760,420))

    t1 = time.time()
    results = detector.detect_face(img)
    print 'time: ',time.time() - t1

    if results is None:
        continue

    total_boxes = results[0]
    points = results[1]

    draw = img.copy()
    for b in total_boxes:
        cv2.rectangle(draw, (int(b[0]), int(b[1])), (int(b[2]), int(b[3])), (255, 255, 255))

    for p in points:
        for i in range(5):
            cv2.circle(draw, (p[i], p[i + 5]), 1, (255, 0, 0), 2)
    cv2.imshow("detection result", draw)
    cv2.waitKey(30)
'''