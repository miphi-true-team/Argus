class face_detect:

  
  def __init__(self, faces, frames):
    self.frames = frames
    self.faces = faces
    
     
  def fit(self):
    ndet_names = set()
    known_faces_enc = list(self.faces.values())#Конверт из dicts_values в list
    known_faces_id = list(self.faces.keys())
    for frame in self.frames:
      face_locations = face_recognition.face_locations(frame, model="cnn")
      face_encodings = face_recognition.face_encodings(frame, face_locations)
      for face_encoding in face_encodings:
        match = face_recognition.compare_faces(known_faces_enc, face_encoding, tolerance=0.50)
    
      for i in range(len(match)):
        if (match[i]):
          ndet_names.add(known_faces_id[i])
    ndet_names = set(known_faces_id) - ndet_names#Вычитаем из множества всей группы отсутствующих. Это сделано для случая опоздания/погрешности
    for key in ndet_names:
      self.faces.pop(key)
        
    return self.faces
