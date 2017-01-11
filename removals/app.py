#!flask/bin/python
from flask import Flask, jsonify, request
from flask_httpauth import HTTPBasicAuth
from model import DBconn
import sys, flask
import warnings
from flask.exthook import ExtDeprecationWarning

warnings.simplefilter('ignore', ExtDeprecationWarning)

app = Flask(__name__)
auth = HTTPBasicAuth()

def spcall(qry, param, commit=False):
    try:
        dbo = DBconn()
        cursor = dbo.getcursor()
        cursor.callproc(qry, param)
        res = cursor.fetchall()
        if commit:
            dbo.dbcommit()
        return res
    except:
        res = [("Error: " + str(sys.exc_info()[0]) + " " + str(sys.exc_info()[1]),)]
    return res

@auth.get_password
def getpassword(username):
    return spcall("getpassword", (username,))[0][0]


@app.route('/')
def index():
    return "Yowzah!"

@app.route('/tasks', methods=['GET'])

def getalltasks():
    res = spcall('gettasks', ())

    if 'Error' in str(res[0][0]):
        return jsonify({'status': 'error', 'message': res[0][0]})

    recs = []
    for r in res:
        recs.append({"id": r[0], "title": r[1], "description": r[2], "done": str(r[3])})
    return jsonify({'status': 'ok', 'entries': recs, 'count': len(recs)})

#@app.route('/tasks/<int:id>/<string:title>/<string:description>/<string:done>', methods = ['GET'])
@app.route('/addtasks', methods=['POST'])
#@auth.login_required
def inserttask():
    id = request.form['id']
    title = request.form['title']
    description = request.form['description']
    done = request.form['done']

    res = spcall("newtask", (id, title, description, done =='true'), True)

    if 'Error' in res[0][0]:
         return jsonify({'status': 'error', 'message': res[0][0]})

    return jsonify({'status': 'ok', 'message': res[0][0]})

@app.route('/updatetasks', methods =['POST'])
def updatetasks():
    id = request.form['id']
    title = request.form['title']
    description = request.form['description']
    done = request.form['done']

    res = spcall("updatetasks", (id, title, description, done=='true'), True)

    if 'Error' in res[0][0]:
        return jsonify({'status':'error', 'message': res[0][0]})

    return jsonify({'status': 'ok', 'message': res[0][0]})


@app.after_request
def add_cors(resp):
    resp.headers['Access-Control-Allow-Origin'] = flask.request.headers.get('Origin', '*')
    resp.headers['Access-Control-Allow-Credentials'] = True
    resp.headers['Access-Control-Allow-Methods'] = 'POST, OPTIONS, GET, PUT, DELETE'
    resp.headers['Access-Control-Allow-Headers'] = flask.request.headers.get('Access-Control-Request-Headers',
                                                                             'Authorization')
    # set low for debugging

    if app.debug:
        resp.headers["Access-Control-Max-Age"] = '1'
    return resp

if __name__ == '__main__':
    app.run(debug=True)

