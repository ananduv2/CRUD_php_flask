from flask import Flask, render_template, request ,redirect
from flask_mysqldb import MySQL

app = Flask(__name__)


app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'demo'

mysql = MySQL(app)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == "GET":
        cur = mysql.connection.cursor()
        cur.execute("SELECT * FROM contacts")
        contacts= cur.fetchall()
        return render_template('index.html',contacts=contacts)

@app.route('/add',methods=['POST'])
def add():
    if request.method == "POST":
        name=request.form['name']
        mob=request.form['mob']
        cur = mysql.connection.cursor()
        cur.execute("INSERT INTO contacts(name, mob) VALUES (%s, %s)", (name, mob))
        mysql.connection.commit()
        return redirect('/')


@app.route('/update', methods=['POST'])
def update():
    if request.method == "POST":
        id=request.form['id']
        mob=request.form['mob']
        cur = mysql.connection.cursor()
        cur.execute("UPDATE contacts SET mob=%s WHERE id=%s" ,[mob,id])
        mysql.connection.commit()
        return redirect('/')

@app.route('/delete', methods=['POST'])
def delete():
    if request.method == "POST":
        id=request.form['id']
        cur = mysql.connection.cursor()
        cur.execute("DELETE FROM contacts WHERE id=%s",[id])
        mysql.connection.commit()
        return redirect('/')

if __name__ == '__main__':
    app.run(debug=True,host='0.0.0.0')



