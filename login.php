<?php  
include('conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['name'];  
        $password = $_POST['password'];  
        $sql = "select Eid from login_details where Name = '$username' and Password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result); 
      
        if($count == 1){
          header("Location:contacts.php?id=$row[Eid]");
          exit;
        }
     }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
  body {
    margin: 0;
    padding: 0;
    background-color: #121212; /* Dark background color */
    color: #FFFFFF; /* White text color */
    font-family: Arial, sans-serif;
    align-items: center;
    text-align: center;
  }
  #container {
    text-align: center;
    width: 330px;
    height: 200px;
    border-radius: 15px;
    border: 2px solid #FFFFFF;
    font-size: 20px;
    margin: auto;
    position: relative;
    top: 130px;
    padding: 20px;
    font-weight: bold;
    background-color: #1E1E1E; 
/* Dark container background color */
    box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.3); /* White shadow */
  }
  input {
    margin-top: 10px;
    margin-bottom: 10px;
  }
  input[type=submit] {
    background-color: #4CAF50; /* Green submit button */
    width: 200px;
    padding: 8px;
    font-size: 20px;
    font-weight: bold;
    color: #FFFFFF;
    border: none;
    border-radius: 7px;
    cursor: pointer;
  }
  input[type=text],[type=password] {
    padding: 8px;
    font-size: 18px;
    border-radius: 20px;
    border: 2px solid #FFFFFF;
    background-color: #1E1E1E; /* Dark input background color */
    color: #FFFFFF;
    width: calc(100% - 20px);
  }
  p {
    font-size: 35px;
    font-weight: bold;
    color: #FFFFFF;
    margin: auto;
    position: relative;
    top: 100px;
  }
  #incorrect_msg {
    font-size: 15px;
    color: #FF5733; /* Orange color for incorrect message */
    margin-top: 10px;
  }
  #toggle-btn {
    position: relative;
    right: -90px;
    top: 40px;
    cursor: pointer;
  }
</style>
<script>
  window.onload = function() {
    document.body.style.display = "block";
    if(performance.navigation.type == 2) {
      window.open('', '_self', '');
      window.close();
    }
  }
</script>
</head>
<body>
<form name="f1" action="#" method="post" onsubmit="return validation()">
  <p>LOGIN PAGE</p>
  <div id="container">
    <label for="name">Name</label><br>
    <input type="text" placeholder="Enter your name" name="name" id="name" required/><br>
    <label for="password">Password</label>
    <span id="toggle-btn" onclick="togglePassword()">👁</span><br>
    <input type="password" name="password" id="password" placeholder="Enter your password" required>
    <input type="submit" value="LOGIN">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST['name'];  
      $password = $_POST['password'];  
      $sql = "select Eid from login_details where Name = '$username' and Password = '$password'";  
      $result = mysqli_query($conn, $sql);  
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
      $count = mysqli_num_rows($result); 
      if($count != 1) {
        echo "<div id='incorrect_msg'>Sorry, name or password is incorrect</div>";
      }
    }
    ?>
  </div>
</form>
<script>
  function validation() {  
    var name = document.f1.name.value;  
    var ps = document.f1.password.value;  
    if (ps.length != "8") {
      alert("Password must be 8 characters long");
      return false;  
    } else {  
      return true;
    }                             
  }  

  function togglePassword() {
    var passwordInput = document.getElementById("password");
    var toggleBtn = document.getElementById("toggle-btn");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleBtn.textContent = "😵";
    } else {
      passwordInput.type = "password";
      toggleBtn.innerHTML = "👁";
    }
  }
</script>
</body>
</html>
