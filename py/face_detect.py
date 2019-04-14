import cv2
import dlib
import face_recognition

class face_detect:
  def __init__(self, faces, frames):
    self.frames = frames
    self.faces = faces
    
     
  def fit(self):
    recognized_id = []
    for frame in self.frames:
      face_locations = face_recognition.face_locations(frame, model="cnn")
      face_encodings = face_recognition.face_encodings(frame, face_locations)
      for keys, values in self.faces.items():
        for known_enc in face_encodings:
          match_list = face_recognition.compare_faces(values, known_enc, tolerance = 0.50)#change values ->
          
          for res in match_list:
            if res and keys not in recognized_id:
              recognized_id.append(keys)
              break
        
    return recognized_id
