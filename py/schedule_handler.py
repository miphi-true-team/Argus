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
            self.current_datetime = datetime.datetime.now()
        else:
            self.current_datetime = test_time
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
            if value["start_time"] <= self.current_datetime.time() <= value["end_time"]:
                l = True
                break
            elif self.current_datetime.time() < value["end_time"]:
                res = -1
                break
        if not l:
            res = -1
        self.n_lesson = res

        if self.n_lesson == -1:
            self.current_schedule = dict()
        else:
            #schedule_tmp = self.db.get_all_rows(db_tables.mephi_schedule).fetchall()
            #print(schedule_tmp)
            #Dosmth()!!!!
            self.__get_actual_schedule

    # Public methods

    def get_group_by_cabinet(self, cabinet_num):
        for itt in range(0, len(self.current_schedule)):
            if cabinet_num == self.current_schedule[itt].cab_number:
                return self.current_schedule[itt].group_number
        return -1

    #def current_time_to_current_lesson_num(self):
    #    res = 0
    #    for value in classes:
    #        res = res + 1
    #        if value["start_time"] <= self.current_datetime.time() <= value["end_time"]:
    #            return res
    #        elif self.current_datetime.time() < value["end_time"]:
    #            return -1
    #    return -1

    # Private methods
    def __get_actual_schedule(self):
        schedule_tmp = self.db.get_all_rows(db_tables.mephi_schedule).fetchall()
        day_of_week = datetime.datetime.now().weekday()
        print(day_of_week)
        print(schedule_tmp)
        request = self.db.exec_custom_request("""SELECT * FROM %s WHERE id=%%s;""" % self.db.table_to_text(db_tables.mephi_schedule), [id])
        print(request)
        return 0
        # Form actual lessons


# using example
# sorry

db_handler1 = db_handler()
cur_time = datetime.time(14, 49)
test_object = ScheduleHandler(db_handler1, "../lesson_time.json")

print("Start test")

#print(test_object.current_time_to_current_lesson_num())
#print(test_object.time_to_lesson_num(cur_time))

# print(test_object.datastore)

# for i in range(0, len(self.date_list)):
#    print(str.format("{0} - {1} Пара №{2}", self.date_list[i][0].__str__(), date_list[i][1].__str__(), i + 1))
#    if self.date_list[i][0] <= cur_time <= self.date_list[i][1]:
#        print("Актуальная")

# -1 - not in list or return 2007 year

# TODO
# 1. DB request
# 2. Form list (or Dict), by lesson num, elements: group <-> cabinet
# 3. Test it
# 4. Drink Blazzer. (Done)
