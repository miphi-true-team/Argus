
from db_handler import db_handler
from db_handler import db_tables
import multiprocessing
import concurrent.futures
import time


def __check_students(cabinets_lits):
    #test code
    print("THREAD, CAB LIST SIZE = ", len(cabinets_lits))
    print(cabinets_lits)

    #raise Exception("Tobi pizda")

    return True

if __name__ == '__main__':
    
  handler = db_handler()
#tests 
  #entity = [31, 20, '2006-01-01', 3]
  #handler.insert_row(db_tables.mephi_journal, entity)
  #print(handler.get_row_by_id(db_tables.mephi_journal, 4))
 # cab = [['A-101', '213.24.32.15'], ['A-102', '213.24.32.16']]
 # handler.insert_rows(db_tables.cabinets, cab)


  #for entity in handler.get_all_rows(db_tables.mephi_journal):
      #print(entity)
      
  #for entity in handler.get_all_rows(db_tables.cabinets):
        #print(entity)

         #end of tests 

  #1. Connect to database, get list of cabinets and ips, devide them by cores number
  all_cabinets = handler.get_all_rows(db_tables.cabinets).fetchall()
  cpu_n = min(multiprocessing.cpu_count(), len(all_cabinets))
  k, m = divmod(len(all_cabinets), cpu_n)
  divided_cabinets = list((all_cabinets[i * k + min(i, m):(i + 1) * k + min(i + 1, m)] for i in range(cpu_n)))

  print("CPU N = ", cpu_n)#test
  #print(divided_cabinets)
  
  
  #2. Calculate scedule class instance 
  #3. Run n threads (not programs!). Pass part of cabinets, scedule reference, db handler reference 
  with concurrent.futures.ThreadPoolExecutor(max_workers=cpu_n) as executor:
    futures_list = {executor.submit(__check_students, cabinets_part): cabinets_part for cabinets_part in divided_cabinets}
    for future in concurrent.futures.as_completed(futures_list):
        cabinets_part = futures_list[future]
        try:
            res = future.result()
        except Exception as exc:
            print('%r generated an exception: %s' % (cabinets_part, exc))
        else:
            print("TASK:", res)
