
from db_handler import db_handler
from db_handler import db_tables
from camera_handler import camera_handler
from face_detect import face_detect
from schedule_handler import ScheduleHandler
import multiprocessing
import concurrent.futures
import time
import datetime
import cv2#temp?


def __check_students(base_handler, sched_handler, camera_handler, cabinets_list):
    print("THREAD, CAB LIST SIZE = ", len(cabinets_list))
    
    now = datetime.datetime.now()
    result_map = dict() #map Cabinet=map Group=map Student=count

    for i in range(3):
      for cab in cabinets_list:
        #once we will get ip from cabinets table there
        frames = cam_handler.get_frames(3, 1)

        print("cab_id = ", cab[0])
        group_id = sched_handler.get_group_by_cabinet(cab[0])
        print("group_id = ", group_id)

        if group_id != -1:
          if group_id not in result_map:
            result_map[group_id] = [cab[0], dict()]

          request = str(("""SELECT * FROM %s WHERE group_id=%%s;""" % base_handler.table_to_text(
                db_tables.students) % group_id))
          students_list = base_handler.exec_custom_request(request).fetchall()

          faces_list = list()

          for student in students_list:
            request = str(("""SELECT * FROM %s WHERE student_id=%%s;""" % base_handler.table_to_text(
                db_tables.faces_journal) % student[0]))
            student_faces = base_handler.exec_custom_request(request).fetchall()

            for face in student_faces:
              faces_list.append(face)

         
          faces_dict = dict()

          
          for student in faces_list:
            if(student[1] not in result_map[group_id][1]):
              result_map[group_id][1][student[1]] = 0

            if(student[1] not in faces_dict.keys()):
              faces_dict[student[1]] = list()
            faces_dict[student[1]].append(student[2])
          
          face_detecter = face_detect(faces_dict, frames)
          fitted = face_detecter.fit()

          print("fitted = ", fitted)

          for fitted_id in fitted:
            result_map[group_id][1][fitted_id] += 1

          time.sleep(10)
    insertion_lists = list()
    for group_id, students_tuple in result_map.items():
      for student_id, count in students_tuple[1].items():
        if(count >= 2):
          insertion_list = [students_tuple[0], student_id, now.strftime("%Y-%m-%d %H:%M"), sched_handler.get_lesson_num()]
          print(insertion_list)
          insertion_lists.append(insertion_list)
        else:
          print("count for is", student_id, count)
    if len(insertion_lists) > 0:
      base_handler.insert_rows(db_tables.mephi_journal, insertion_lists)

    return True

if __name__ == '__main__':
    
  base_handler = db_handler()
  cam_handler = camera_handler("http://89.208.213.182:100/")
  sched_handler = ScheduleHandler(base_handler, "../test_lesson_time.json", datetime.datetime(2019, 4, 14, 11, 41))
  #count = 0

  '''all_students = base_handler.get_all_rows(db_tables.faces_journal).fetchall() #face_id student_id enc picture
  faces_dict = dict()
  
  for student in all_students:
    if(student[1] not in faces_dict.keys()):
        faces_dict[student[1]] = list()
    faces_dict[student[1]].append(student[2])


  while(count < 1):
    time.sleep(2)
    frames = cam_handler.get_frames(1, 1)

    count += 1
    for frame in frames:
      print("O")

    face_detecter = face_detect(faces_dict, frames)
    fitted = face_detecter.fit()
    print(fitted)'''
     
  #1. Connect to database, get list of cabinets and ips, devide them by cores number
  all_cabinets = base_handler.get_all_rows(db_tables.cabinets).fetchall()
  cpu_n = min(multiprocessing.cpu_count(), len(all_cabinets))
  k, m = divmod(len(all_cabinets), cpu_n)
  divided_cabinets = list((all_cabinets[i * k + min(i, m):(i + 1) * k + min(i + 1, m)] for i in range(cpu_n)))
  
  #2. Calculate scedule class instance 
  __check_students(base_handler, sched_handler, cam_handler, divided_cabinets[0])
  #3. Run n threads (not programs!). Pass part of cabinets, scedule reference, db handler reference 
  '''with concurrent.futures.ThreadPoolExecutor(max_workers=cpu_n) as executor:
    futures_list = {executor.submit(__check_students, base_handler, sched_handler, cam_handler, cabinets_part): cabinets_part for cabinets_part in divided_cabinets}
    for future in concurrent.futures.as_completed(futures_list):
        cabinets_part = futures_list[future]
        try:
            res = future.result()
        except Exception as exc:
            print('%r generated an exception: %s' % (cabinets_part, exc))
        else:
            print("TASK:", res)'''
