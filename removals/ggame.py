from flask import Flask
from model import DBconn

import flask, sys

app=Flask(__name__)

def funcall(query, parameter, commit =False):
    try:
        db =DBconn()
        cursor =db.getcursor()
        cursor.callproc(query, parameter)
        result=cursor.fetchall()
        if commit:
            db.dbcommit()
        return result
    except:
        result =[('Error:'+str(sys.exc_info()[0]) + " " + str(sys.exc_info()[1]),)]
    return result




