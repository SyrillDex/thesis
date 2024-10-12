from flask import Flask, render_template
import subprocess

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('prompt.html')

@app.route('/run_script', methods=['POST'])
def run_script():
    try:
        subprocess.run(['python', 'Get_BMI.py'], check=True)
        return 'Python script executed successfully.'
    except subprocess.CalledProcessError as e:
        return f'Error executing Python script: {e}', 500


if __name__ == '__main__':
    app.run(debug=True)
