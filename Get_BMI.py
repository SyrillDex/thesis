import RPi.GPIO as GPIO
import time
import statistics
import mysql.connector
from hx711 import HX711

##################################################################################################################################
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

hx = HX711(dout_pin=22, pd_sck_pin=17)

hx.zero()

hx.set_scale_ratio(23.5)

for i in range(3):
    weight = hx.get_weight_mean()
    print(((weight)/1000), "kg")
    time.sleep(0.01)
    kg = weight/1000

print(kg, "kg")
lbs = kg*2.20462
print(lbs, "lbs")

try:
    conn = mysql.connector.connect(host="localhost", user="phpmyadmin", password="docapture")
    c = conn.cursor()
    if conn.is_connected():
      print("Successfully Connected! Hahahaha")
except:
   print("Error", "Database Connectivity Issue, Please Try Again")


c.execute("use phpmyadmin")

query = "UPDATE `bmi_table` SET `kg`= %s,`lbs`= %s WHERE 1"
c.execute(query,(round(kg, 10), round(lbs, 1)))
conn.commit()
conn.close()
print("Success!", "File Transfered Successfully!")

###################################################################################################################################################

TRIG_PIN=12
ECHO_PIN=11
number_of_samples=5
sample_sleep = 0.1
calibration1 = 30
calibration2 = 1750
time_out = 0.5

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

GPIO.setup(TRIG_PIN,GPIO.OUT)
GPIO.setup(ECHO_PIN,GPIO.IN, pull_up_down=GPIO.PUD_DOWN)


samples_list = []
stack = []


def timer_call(channel) :

    now = time.monotonic()
    stack.append(now)

def trigger():

    GPIO.output(TRIG_PIN, GPIO.HIGH)
    time.sleep(0.00001)
    GPIO.output(TRIG_PIN, GPIO.LOW)

def check_distance():

    samples_list.clear()


    while len(samples_list) < number_of_samples:

        trigger()


        while len(stack) < 2:
             start = time.monotonic()
             while time.monotonic() < start + time_out:
                 pass
             trigger()

        if len(stack) == 2:
            samples_list.append(stack.pop()-stack.pop())
        elif len(stack) > 2:

            stack.clear()

        time.sleep(sample_sleep)

    return (statistics.median(samples_list)*1000000*calibration1/calibration2)




GPIO.add_event_detect(ECHO_PIN, GPIO.BOTH, callback=timer_call)

sum_ = 0

for i in range(3):
    number = abs(round(check_distance() - 213.36, 1))
    print(number, "cm")
    sum_ += float(number)
    
average = sum_ / 3
average_ft = (average)/30.48
inch = average%30.48/2.54


print('Average: ', round(average, 1),   "cm")
print('Average: ', int(average_ft), "ft", int(round(inch, 1)), "inch")


try:
    conn = mysql.connector.connect(host="localhost", user="phpmyadmin", password="docapture")
    c = conn.cursor()
    if conn.is_connected():
      print("Successfully Connected! Hahahaha")
except:
   print("Error", "Database Connectivity Issue, Please Try Again")


c.execute("use phpmyadmin")

query = "UPDATE `bmi_table` SET `cm`= %s,`ft`= %s,`inches`= %s  WHERE 1"
c.execute(query,(int(round(average, 0)), int(average_ft),int(round(inch, 0))))
conn.commit()
conn.close()
print("Success!", "File Transfered Successfully!")

x = int(kg)
y = average/100
print("wow", y)
bmi = x/((y)**2)
print(bmi)

try:
    conn = mysql.connector.connect(host="localhost", user="phpmyadmin", password="docapture")
    c = conn.cursor()
    if conn.is_connected():
      print("Successfully Connected! Hahahaha")
except:
   print("Error", "Database Connectivity Issue, Please Try Again")


c.execute("use phpmyadmin")

query = "UPDATE `bmi_table` SET `bmi`= %s WHERE 1;"
c.execute(query, (round(bmi, 1),))
conn.commit()
conn.close()
print("Success!", "File Transfered Successfully!")