<!DOCTYPE html>
<link rel="stylesheet" href="styles/login.css">
<?php
if(!isset($_SESSION)){

    session_start();    
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

        $sql = "SELECT * FROM student_docs
         WHERE binary username = '$username'
         AND binary password = '$password'";

        $user = $con->query($sql) or die($con->error);
        $row = $user->fetch_assoc();
        $total = $user->num_rows;
   
        if($total == 0){?>
            <div class="error-message" id="error-message"><p style="text-align: center; margin-top: 23px;">Account doesn't exist</p></div>
        <?php }else{
            $_SESSION['UserLogin'] = $row['username'];
            $_SESSION['UserPassword'] = $row['password'];
            echo header('Location: index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Log In</title>
    <link rel="stylesheet" href="styles/login.css">
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
    <a href="Main.html">
        <button class="back">&#8592</button>
    </a>
    <div class="container-div">
        <div class="container">
            <div class="login">Log In</div>
                <div><p class="format">LAST NAME┃FIRST NAME┃MIDDLE NAME</p></div>
                <form method="post" >
                <div class="inputField">
                    <div><i class="fa-solid fa-user"></i></div>
                    <input type="text" name="username" id="username" 
                     autocomplete="off" placeholder="Enter fullname" required>
                </div>
                <div class="inputField">
                    <div><i class="fa-solid fa-lock"></i></div>
                    <input type="password" name="password" id="password" 
                     placeholder="Enter password" required autocomplete="off">
                </div> 
                <div class="button-div">
                    <button type="submit" name="login" class="login-button">Log In</button>
                </div>
                </form>
                <a href="add.php" class = "sign-up-div">
                    <button class="login-button signup">Create an account</button>
                </a>
                <button class="showpass" onclick="showpass()">&#128065;</button>

                <div class="note">
                    <p>Note: <br> The username will serve as your folder name.</p>
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

            document.addEventListener('click', (event) => {
                if (!virtualKeyboard.contains(event.target) && event.target !== usernameInput && event.target !== passwordInput) {
                    hideKeyboard();
                }
            });
        </script>

    <script>
        const errorMessage = document.getElementById('error-message');
        
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
    </script>
</body>
</html>