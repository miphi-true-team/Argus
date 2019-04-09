
from configparser import ConfigParser
import psycopg2
from enum import Enum

class db_tables(Enum):
    groups = 1
    students = 2
    cabinets = 3
    faces_journal = 4
    mephi_journal = 5

class db_handler:
# Public class interface 

    def table_to_text(self, table_type):
        if table_type == db_tables.groups:
            return 'groups'
        elif table_type == db_tables.students:
            return 'students'
        elif table_type == db_tables.cabinets:
           return 'cabinets'
        elif table_type == db_tables.faces_journal:
            return 'faces_journal'
        elif table_type == db_tables.mephi_journal:
            return 'mephi_journal'
        else:
            raise Exception("Unsupported table type")

    def insert_row(self, table_type, values):
        self.__insert_row(table_type, values)

    def insert_rows(self, table_type, insertion_values_list):
        for ins_val in insertion_values_list:
            self.__insert_row(table_type, ins_val, False)
        self.__connection.commit()

    def get_row_by_id(self, table_type, id):
        cursor = self.__connection.cursor()

        cursor.execute("""SELECT * FROM %s WHERE id=%%s;""" % self.table_to_text(table_type), [id])
        return cursor.fetchone()

#No Thread safety here! Do not pass cursor to another thread! 
    def get_all_rows(self, table_type):
        cursor = self.__connection.cursor()

        cursor.execute("""SELECT * FROM %s;""" % self.table_to_text(table_type))
        return cursor

#No Thread safety here! Do not pass cursor to another thread! 
    def exec_custom_request(self, request):
        cursor = self.__connection.cursor()

        cursor.execute(request)
        return cursor

    def get_log(self):
        return list(self.__log)

    def __init__(self):
        self.__connection = None
        self.__log = list()
        self.__db_connect()

    def __del__(self):
        if self.__connection is not None:
              self.__connection.close()
# Private class interface 
    def __insert_row(self, table_type, values, do_commit = True):
        cursor = self.__connection.cursor()

        if table_type == db_tables.groups:
            cursor.execute("""INSERT INTO %s (name) VALUES (%%s);""" 
            % self.table_to_text(db_tables.groups), [values[0]])
        elif table_type == db_tables.students:
            cursor.execute("""INSERT INTO %s (sn, fn, pt, group_id) VALUES (%%s, %%s, %%s, %%s);"""
            % self.table_to_text(db_tables.students), (values[0], values[1], values[2], values[3]))
        elif table_type == db_tables.cabinets:
            cursor.execute("""INSERT INTO %s (name, camera_address) VALUES (%%s, %%s);""" 
            % self.table_to_text(db_tables.cabinets), (values[0], values[1]))
        elif table_type == db_tables.faces_journal:
            cursor.execute("""INSERT INTO %s (student_id, encoding, picture_link) VALUES (%%s,%%s,%%s);""" 
            % self.table_to_text(db_tables.faces_journal), (values[0], values[1], values[2]))
        elif table_type == db_tables.mephi_journal:
            cursor.execute("""INSERT INTO %s (cabinet_id, student_id, date, para_num) VALUES (%%s,%%s,%%s,%%s);"""
            % self.table_to_text(db_tables.mephi_journal), (values[0],values[1],values[2], values[3]))
        else:
            raise Exception("Unsupported table type")

        if do_commit:
            self.__connection.commit()

    def __add_log_event(self, msg):
        self.__log.append(msg)

    def __db_config(self, filename='../database.ini', section='postgresql'):
        # create a parser
        parser = ConfigParser()
        # read config file
        parser.read(filename)

        self.__add_log_event("Attempt to read ini file")
        # get section, default to postgresql
        db = {}
        if parser.has_section(section):
            params = parser.items(section)
            for param in params:
                db[param[0]] = param[1]
        else:
            raise Exception('Section {0} not found in the {1} file'.format(section, filename))
    
        return db

    def __db_connect(self):
        self.__add_log_event("Connect to the PostgreSQL database server")

        if self.__connection is not None:
            self.__connection.close()
            self.__connection = None
        try:
            # read connection parameters
            params = self.__db_config()
    
            # connect to the PostgreSQL server
            self.__add_log_event('Connecting to the PostgreSQL database...')

            self.__connection = psycopg2.connect(**params)
    
            # create a cursor
            cursor = self.__connection.cursor()
            
            # execute a test statement
            cursor.execute('SELECT version()')
    
            # display the PostgreSQL database server version
            db_version = cursor.fetchone()
            self.__add_log_event(db_version)

        except (Exception, psycopg2.DatabaseError) as error:
            self.__add_log_event(error)
            if self.__connection is not None:
                self.__connection.close()
                self.__add_log_event('Database connection closed.')
            raise error
