import datetime
from db_handler import db_tables
from db_handler import db_handler

date_list = [
    [datetime.time(8, 30),datetime.time(10,5)],
    [datetime.time(10, 15), datetime.time(11, 50)],
    [datetime.time(11, 55), datetime.time(13, 30)]
]

class shadule_handler:

    #Constructor
    def __init__(self, db_hand):
        self.current_datetime = datetime.datetime.now()
        self.db = db_hand
        self.current_shedule = list()

    #Public methods
    def get_group_by_cabinet(self, cabinet_num):
        return 0

    #Private methods
    def __get_current_time(self):
        return datetime.datetime.now()

    def __date_to_current_lesson_num(self, datetime):
        return 0

#using example
#sorry

#TODO
# 1. Somthing good
# 2. Die