import datetime
import json
from db_handler import db_tables
from db_handler import db_handler


# Structure of lesson in Schedule:
# Day of week (we can make request by today, in future)
# Parity bit :)
# Lesson num  // for requests
# Group num
# Cab
# Lesson name (Ignore)
# Teacher Fam (Ignore)


class ScheduleRecord:
    def __init__(self):
        self.lesson_num = 0
        self.group_number = 0
        self.cab_number = 0
        self.teacher_fam = ""
        self.dis_name = ""


def str_to_time(input_str):
    dt_value = datetime.datetime.strptime(input_str, "%H:%M:%S")
    dt_value = dt_value.time()
    return dt_value


class ScheduleHandler:
    # Constructor

    # Constructor Test
    def __init__(self, db_hand, path_json='../lesson_time.json', test_time=None):
        if test_time is None:
            current_datetime = datetime.datetime.now()
        else:
            current_datetime = test_time
        self.db = db_hand

        # Load times of schedule
        with open(path_json) as json_file:
            json_data = json.load(json_file)
            classes = json_data['classes']
            for value in classes:
                value["start_time"] = str_to_time(value["start_time"])
                value["end_time"] = str_to_time(value["end_time"])

        # Get N_Lesson
        res = 0
        for value in classes:
            res = res + 1
            if value["start_time"] <= current_datetime.time() <= value["end_time"]:
                l = True
                break
            elif current_datetime.time() < value["end_time"]:
                res = -1  # Think about it
                break
        if not l:
            res = -1  # Think about it
        # Tested Worked!!!
        self.__n_lesson = res

        day_of_week = current_datetime.weekday() + 1

        request = ("""SELECT * FROM %s WHERE day=%%s and para_num=%%s;""" % self.db.table_to_text(
            db_tables.mephi_schedule) % (day_of_week, self.__n_lesson))
        req_result = self.db.exec_custom_request(request).fetchall()
        self.schedule_dict = dict()
        for value in req_result:
            self.schedule_dict[value[3]] = value[4]

    # Public methods

    def get_lesson_num(self):
        return self.__n_lesson

    def get_group_by_cabinet(self, cabinet_num):
        if cabinet_num in self.schedule_dict:
            return self.schedule_dict[cabinet_num]
        else:
            return -1


# Usage example
db_handler1 = db_handler()
cur_time = datetime.datetime(2019, 4, 15, 8, 49)
test_object = ScheduleHandler(db_handler1, "../lesson_time.json", cur_time)
t = test_object.get_group_by_cabinet(1)
print(t)
# test_object = ScheduleHandler(db_handler1, "../lesson_time.json")
# print("Start test")

# -1 - not in list or return 2007 year

# TODO
# 1. DB request
# 2. Form list (or Dict), by lesson num, elements: group <-> cabinet
# 3. Test it
# 4. Drink Blazzer. (Done)
