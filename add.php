<!DOCTYPE html>
<?php

include_once("connections/connection.php");

$con = connection();

if(isset($_POST['submit'])){

    // $uname = $_POST['username'];
    // $pword = $_POST['password'];

    $uname = mysqli_real_escape_string($con, $_POST['username']);
    $pword = mysqli_real_escape_string($con, $_POST['password']);
    $pword1 = mysqli_real_escape_string($con, $_POST['password1']);
    $program = mysqli_real_escape_string($con, $_POST['program']);
    $yearlevel = mysqli_real_escape_string($con, $_POST['year-level']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $school_year = mysqli_real_escape_string($con, $_POST['school_year']);

    if ($pword != $pword1) {?>            
    <div id="error-message"><p style="text-align: center; margin-top: 23px;">Password didn't match</p>
        </div><?php }else{
        $user_check_query = "SELECT * FROM student_docs WHERE username='$uname' LIMIT 1";
        $result = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // if user exists
            if ($user['username'] === $uname) {?>
            <div id="error-message"><p style="text-align: center; margin-top: 23px;">Account already exist !</p></div>
            <?php }
        }else{
            $sql = "INSERT INTO `student_docs`(`username`, `password`,`program`,`year_level`,`gender`,`school_year`)
            VALUES ('$uname','$pword','$program','$yearlevel','$gender','$school_year')";
    
            $con->query($sql) or die($con->error);
            echo header("Location: login.php");
            }
    }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Log In</title>
    <link rel="stylesheet" href="styles/SignUp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1a1f89beb9.js" crossorigin="anonymous"></script>
    <style>
        body {
          background-image: url('img/bg1.jpg');
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="left-header"> DoCapture</div>
        <div><button class="right-header">About us</button></div>
    </div>
    <a href="login.php">
        <button class="back">&#8592</button>
    </a>
    <div class="container-div">
        <div class="container">
            <form method="post" name="myform" onsubmit="return validation()">
            <div class="signUp">Create an account</div>
            <div><p class="format">LAST NAME┃FIRST NAME┃MIDDLE NAME</p></div>
            <div class="inputField">
                <div><i class="fa-solid fa-user"></i></div>
                <input type="text" name="username" id="username" pattern="[A-Z Ñ]{1,}"
                 autocomplete="off" required placeholder="Enter fullname" >
            </div>
            <div class="inputField">
                <div><i class="fa-solid fa-unlock"></i></div>
                <input type="password" name="password" id="password" 
                 required placeholder="Enter password" autocomplete="off">
            </div>
            <div id="error"><p class="error">Password must be atleast 8 characters</p></div>
            <div class="inputField" autocomplete="off">
                <div><i class="fa-solid fa-lock"></i></div>
                <input type="password" name="password1" id="password1" required placeholder="Confirm password" autocomplete="off">
            </div>
            <div class="selection">
                <select name="program" id="program" required>
                    <option value="">Choose Program</option>
                    <option value="BSCpE">BSCpE</option>
                    <option value="BSCS">BSCS</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSE">BSE</option>
                    <option value="BSIndT">BSIndT</option>
                    <option value="BSHM">BSHM</option>
                    <option value="BSBM">BSBM</option>
                </select>
                <select name="year-level" id="year-level" required>
                    <option value="">Choose Year Level</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                </select>
            </div>
            <div class="selection" required>
                <select name="gender" id="gender">
                    <option value="">Choose Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <select id="school_year" name="school_year" required>
                    <option value="">Choose School Year</option>
                    <script>
                        const numYears = 4; 
                        const currentYear = new Date().getFullYear();
                        
                        for (let i = 0; i <= numYears; i++) {
                            
                            const year = currentYear + i;

                            const option = document.createElement('option');
                            option.value = `${year} - ${year + 1}`;
                            option.text = `${year} - ${year + 1}`;

                            document.getElementById('school_year').appendChild(option);
                        }
                    </script>
                 </select>
            </div>
            <div class="button-div">
                <a href="http://localhost/StudentLogIn/login.php">
                    <button class="signup-button" type="submit" name="submit">Sign Up</button>
                </a>
            </div>
            </form>
            <button class="showpass" onclick="showpass()">&#128065;</button>
            <button class="showpass1" onclick="showpass1()">&#128065;</button>
        </div>
    </div>
    <div class="virtual-keyboard" id="virtual-keyboard">
            <div>
                <button onclick="typeKey('1')">1</button>
                <button onclick="typeKey('2')">2</button>
                <button onclick="typeKey('3')">3</button>
                <button onclick="typeKey('4')">4</button>
                <button onclick="typeKey('5')">5</button>
                <button onclick="typeKey('6')">6</button>
                <button onclick="typeKey('7')">7</button>
                <button onclick="typeKey('8')">8</button>
                <button onclick="typeKey('9')">9</button>
                <button onclick="typeKey('0')">0</button>
            </div>
            <div>
                <button onclick="typeKey('Q')">Q</button>
                <button onclick="typeKey('W')">W</button>
                <button onclick="typeKey('E')">E</button>
                <button onclick="typeKey('R')">R</button>
                <button onclick="typeKey('T')">T</button>
                <button onclick="typeKey('Y')">Y</button>
                <button onclick="typeKey('U')">U</button>
                <button onclick="typeKey('I')">I</button>
                <button onclick="typeKey('O')">O</button>
                <button onclick="typeKey('P')">P</button>
            </div>
            <div>
                <button onclick="typeKey('A')">A</button>
                <button onclick="typeKey('S')">S</button>
                <button onclick="typeKey('D')">D</button>
                <button onclick="typeKey('F')">F</button>
                <button onclick="typeKey('G')">G</button>
                <button onclick="typeKey('H')">H</button>
                <button onclick="typeKey('J')">J</button>
                <button onclick="typeKey('K')">K</button>
                <button onclick="typeKey('L')">L</button>
                <button onclick="deleteKey()"><-</button>
            </div>
            <div>
                <button onclick="typeKey('Z')">Z</button>
                <button onclick="typeKey('X')">X</button>
                <button onclick="typeKey('C')">C</button>
                <button onclick="typeKey('V')">V</button>
                <button onclick="typeKey('B')">B</button>
                <button onclick="typeKey('N')">N</button>
                <button onclick="typeKey('M')">M</button>
                <button onclick="typeKey('Ñ')">Ñ</button>
                <button onclick="hideKeyboard()">Ok</button>
            </div>
            <div>
                <button class="space" onclick="typeKey(' ')">Space</button>
            </div>
        </div>
        
        <script>
            const virtualKeyboard = document.getElementById('virtual-keyboard');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const password1Input = document.getElementById('password1');
            let activeInput = null;

            function showKeyboard(inputField) {
                activeInput = inputField;
                virtualKeyboard.style.display = 'block';
                const rect = inputField.getBoundingClientRect();
                }

            function hideKeyboard() {
                virtualKeyboard.style.display = 'none';
                activeInput = null;
            }

            function typeKey(key) {
                if (activeInput) {
                    activeInput.value += key;
                }
            }

            function deleteKey() {
                if (activeInput && activeInput.value.length > 0) {
                    activeInput.value = activeInput.value.slice(0, -1);
                }
            }

            usernameInput.addEventListener('focus', () => showKeyboard(usernameInput));
            passwordInput.addEventListener('focus', () => showKeyboard(passwordInput));
            password1Input.addEventListener('focus', () => showKeyboard(password1Input));

            document.addEventListener('click', (event) => {
                if (!virtualKeyboard.contains(event.target) && event.target !== usernameInput && event.target !== passwordInput && event.target !== password1Input) {
                    hideKeyboard();
                }
            });
        </script>

    <script>
        const errorMessage = document.getElementById('error-message');
        var password=document.forms['myform']['password'];
        const error = document.getElementById('error');
        
        function validation(){
            if(password.value.length<8){
                error.style.display = 'flex'
                setTimeout(() => {
                    error.style.display = 'none';
                }, 3000);
                return false;
            }return true;
        }

        errorMessage.style.display = 'block';
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 3000);
    </script>
    <script>
        const username = document.getElementById('username');
        
        username.addEventListener("input", ()=>{
            username.value = username.value.toUpperCase();
        });
    </script>
    <script>
        function showpass(){
            document.getElementById('password').type = 'text';
        setTimeout(() => {
            document.getElementById('password').type = 'password';
        }, 700);
        }
        function showpass1(){
            document.getElementById('password1').type = 'text';
        setTimeout(() => {
            document.getElementById('password1').type = 'password';
        }, 700);
        }
    </script>
</body>
</html>
