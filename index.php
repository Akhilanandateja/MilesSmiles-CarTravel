<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp & SignIn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
  /* General styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 40px;
    width: 320px;
}

.form-title {
    text-align: center;
    margin-bottom: 20px;
}

.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group i {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #aaa;
}

.input-group input {
    width: calc(100% - 30px);
    padding: 10px;
    padding-left: 30px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.input-group label {
    position: absolute;
    top: 10px;
    left: 40px;
    color: #999;
    pointer-events: none;
    transition: 0.3s ease;
}

.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label {
    top: -10px;
    left: 40px;
    font-size: 12px;
    color: #333;
    background-color: white;
    padding: 0 5px;
}

.input-group .toggle-password {
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
}

.icons {
    text-align: center;
    margin-bottom: 20px;
}

.icons i {
    font-size: 24px;
    margin: 0 10px;
    color: #FF4C4C;
    cursor: pointer;
}

.links {
    text-align: center;
}

.links p {
    color: #999;
}

.links button {
    border: none;
    background-color: transparent;
    padding: 0;
    font-size: 16px;
    color: #FF4C4C;
    cursor: pointer;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}

.or {
    text-align: center;
    color: #999;
    margin-top: 20px;
    margin-bottom: 10px;
}
.btn {
    display: inline-block;
    padding: 10px 20px;
    width:100%;
    background-color: #FF4C4C;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color:black;
}
.container {
    margin: 20px;
    font-family: Arial, sans-serif;
}

label {
    display: block;
    font-size: 16px;
    margin-bottom: 10px;
}

input[type="checkbox"] {
    margin-right: 10px;
}

  </style>
</head>
<body>

    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="" required>
                <label for="fName">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="" required>
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                    <i class="fas fa-eye-slash" id="togglePasswordIcon"></i>
                </span>
            </div>
          
        <label for="agreeCheckbox">
            <input type="checkbox" id="agreeCheckbox" required>
            I agree to the Terms and Conditions</a>
        </label>
   
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">----------or---------</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
            <p>Already Have Account ?</p><br><br><br>
            <button id="signInButton">Sign In</button>
        </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signInEmail" placeholder="" required>
                <label for="signInEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="signInPassword" placeholder="" required>
                <label for="signInPassword">Password</label>
                <span class="toggle-password" onclick="togglePasswordVisibility('signInPassword')">
                    <i class="fas fa-eye-slash" id="toggleSignInPasswordIcon"></i>
                </span>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">----------or---------</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
            <p>Don't have account yet?</p><br><br><br>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var eyeIcon = document.getElementById(inputId === 'password' ? 'togglePasswordIcon' : 'toggleSignInPasswordIcon');
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>
