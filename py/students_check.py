
from db_handler import db_handler
from db_handler import db_tables
import multiprocessing


if __name__ == '__main__':
    #tests 
  print("HALLO")

  handler = db_handler()
  log = handler.get_log()

  for msg in log:
      print(msg)

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
  cabinets = handler.get_all_rows(db_tables.cabinets).fetchall()
  cpu_n = multiprocessing.cpu_count()
  print(cabinets)
  print(cpu_n)
  #2. Calculate scedule class instance 
  #3. Run n threads (not programs!). Pass part of cabinets, scedule reference, db handler reference 

  # main code
