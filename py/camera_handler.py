import cv2
import time

class camera_handler:

    def get_frames(self, num, delay):
        if not self.cam.isOpened():
            raise Exception("Attempt to read from unitialized cam")

        frames_list = list()
        for i in range(0, num):
            ret, frame = self.cam.read()
            print("i = ", i, "ret = ", ret)

            if not ret:
                self.cam.release()
                raise Exception("Cannot get frame")

            frames_list.append(frame)
            time.sleep(delay)

        return frames_list

    def __init__(self, camera_addr):
        self.cam = None
        self.__init_cam(camera_addr)
    
    def __del__(self):
        if self.cam.isOpened():
            self.cam.release()

    def __init_cam(self, addr):
        self.cam = cv2.VideoCapture(addr)

        #self.cam.set(3,640)
        #self.cam.set(4,480)
        if not self.cam.isOpened():
            raise Exception("Cannot connect to the camera")
        
