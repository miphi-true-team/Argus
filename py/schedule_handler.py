import datetime
from db_handler import db_tables
from db_handler import db_handler

date_list = [
    [datetime.time(8, 30), datetime.time(10, 5)],
    [datetime.time(10, 15), datetime.time(11, 50)],
    [datetime.time(11, 55), datetime.time(13, 30)],
    [datetime.time(14, 30), datetime.time(16, 5)],
    [datetime.time(16, 15), datetime.time(17, 50)],
    [datetime.time(18, 45), datetime.time(20, 20)],
    [datetime.time(20, 25), datetime.time(22, 00)]
]


# Структура записи пары:
# Временной интервал 8:30 - 10:05 (Необходимо только для запросов)
# Номер группы
# Кабинет
# Название предмета (Игнорируется)
# Имя преподавателя (Игнорируется)


class ScheduleRecord:
    def __init__(self):
        self.group_number = 0
        self.cab_number = 0


class ScheduleHandler:
    # Constructor
    #def __init__(self, db_hand):
    #   self.current_datetime = datetime.datetime.now()
    #   self.db = db_hand
    #   self.current_schedule = list()

    # Constructor Test
    def __init__(self, db_hand, test_time = None):
        if test_time is None:
            self.current_datetime = datetime.datetime.now()
        else:
            self.current_datetime = test_time
        self.db = db_hand
        self.current_schedule = list()

    # Public methods
    def get_group_by_cabinet(self, cabinet_num):
        return 0

    def date_to_current_lesson_num(self):
        for itt in range(0, len(date_list)):
            if date_list[itt][0] <= self.current_datetime.time() <= date_list[itt][1]:
                return itt + 1
            elif self.current_datetime.time() < date_list[itt][1]:
                return -1
        return -1

    # Private methods
    def __get_actual_schedule(self):
        return 0

    def __get_current_time(self):
        return datetime.datetime.now()


# using example
# sorry

cur_time = datetime.time(14, 49)
#my_super_object = ScheduleHandler('', cur_time)
test_object = ScheduleHandler('')
print(test_object.date_to_current_lesson_num())

for i in range(0, len(date_list)):
    print(str.format("{0} - {1} Пара №{2}", date_list[i][0].__str__(), date_list[i][1].__str__(), i + 1))
    if date_list[i][0] <= cur_time <= date_list[i][1]:
        print("Актуальная")

# TODO
# 1. Something good
# 2. Die
