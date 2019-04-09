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
# День недели (Скорее всего должен быть запрос к БД, получить расписание на сегодня)
# Бит чётности :)
# Номер пары  //Временной интервал 8:30 - 10:05 (Необходимо только для запросов)
# Номер группы
# Кабинет
# Название предмета (Игнорируется)
# Имя преподавателя (Игнорируется)


class ScheduleRecord:
    def __init__(self):
        self.lesson_num = 0
        self.group_number = 0
        self.cab_number = 0
        self.teacher_fam = ""
        self.dis_name = ""


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
        for itt in range(0, len(self.current_schedule)):
            if cabinet_num == self.current_schedule[itt].cab_number:
                return self.current_schedule[itt].group_number
        return -1

    def time_to_current_lesson_num(self):
        for itt in range(0, len(date_list)):
            if date_list[itt][0] <= self.current_datetime.time() <= date_list[itt][1]:
                return itt + 1
            elif self.current_datetime.time() < date_list[itt][1]:
                return -1
        return -1

    # Private methods
    def __get_actual_schedule(self):
        schedule_tmp = self.db.get_all_rows(db_tables.mephi_schedule).fetchall()
        return 0
        # Сформировать список актуальных занятий (Сегодня и сейчас)

# using example
# sorry


cur_time = datetime.time(14, 49)
test_object = ScheduleHandler('')
print(test_object.time_to_current_lesson_num())

for i in range(0, len(date_list)):
    print(str.format("{0} - {1} Пара №{2}", date_list[i][0].__str__(), date_list[i][1].__str__(), i + 1))
    if date_list[i][0] <= cur_time <= date_list[i][1]:
        print("Актуальная")

# Вероятнее всего стоит не возвращать -1 если перемена, а возвращать номер либо предыдущей, либо следующей пары!

# TODO
# 1. Запросить у БД расписание на сегодня
# 2. Закинуть в список (Может словарь), получив номер пары, записи группа <-> кабинет
# 3. Затестить всё это
# 4. Немного выпить. (Уже сделано)
