<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
  

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
// Note: MD5 is not secure, consider using more secure hashing methods
    
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['is_admin'] = $row['is_admin']; // Set admin status from database
        
        // Redirect based on user role
        if($_SESSION['is_admin'] == 'admin'){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: homepage.php");
        }
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>