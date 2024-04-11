<?php
error_reporting(0);
include('conn.php');
$id=2;
?>
<!Doctype html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <style type="text/css" media="all">
      *{
        padding:0px;
        border: none;
        margin: 0px;
      }
      #your_details{
       background-color:rgba(0,128,255,0.3);
       height: 10vh;
       width:100vw;
       border-bottom:2px solid rgba(0,128,255,0.3);
       text-align: center;
       padding: 10px;
       font-size: 20px;
      }
      #contacts{
       background-image: linear-gradient(to bottom right,rgba(250,0,250,0.4),white);
       height: 90vh;
       width:100vw;
      }
    .delete{
      background-color: red;
      padding: 8px 12px;
      color:white;
      font-weight:bold;
      text-decoration: none;
      border-radius: 30px;
      margin-top: 50px;
    }
    a{
      text-decoration: none;
    }
    #prof_pic{
      border: 2px solid blue;
      border-radius: 50px;
      width:50px;
      height: 50px;
      margin: 5px;
    }
    #out_left{
      display: flex;
      border-bottom:3px solid rgba(0,128,255,0.3);
    }
    #out_right{
      width: 20px;
      margin-top:19px;
    }
    body{
      display: none;
    }
    </style>
<script>
    window.onload = function() {
  document.body.style.display = "block";
  if(performance.navigation.type == 2) {
    var referrer = document.referrer;
  if (referrer.includes("contacts.php")) {
     window.location.href = "login.php";
            }
        }
    }
</script>

  </head>
  <body>
    <div id="your_details">
      <?php
        include('conn.php');
        if(isset($_POST['id'])){
          $id=$_POST['id'];
          $delete=mysqli_query($conn,"DELETE FROM `login_details` WHERE `Id`='$id'");
        }
      ?>
      <?php
      $id = 1;
      $hostcheck = 0;
      
      if(isset($_GET['id']) && is_numeric($_GET['id'])) {
          $id = intval($_GET['id']);
          $query = "SELECT Name, Host FROM `login_details` WHERE `Eid` = $id";
          $result = mysqli_query($conn, $query);
      
          if($result) {
              $row = mysqli_fetch_assoc($result);
              if($row) {
                  echo "NAME :: " . $row['Name'] . " (YOU)<br>Your Id :: " . $id;
                  $hostcheck = $row['Host'];
              } else {
                  echo "User not found.";
              }
          } else {
              echo "Error executing query: " . mysqli_error($conn);
          }
      } else {
          echo "Invalid user ID.";
      }
      ?>
      
    </div>
    <div id="contacts">
      <?php
      include('conn.php');
      $query= "select*from login_details where `Eid`!=$id";
      $result=mysqli_query($conn,$query);
      $count=mysqli_num_rows($result);
      if($count>0){
  while($r=mysqli_fetch_array($result)){ 
  echo "<div id='out_left'height='35px'>
           <div style='width: 87%;'>
 <a href='index.php?id=".$r['Eid']."&userid=".$id."' style='display: flex; place-items:center;'>
<div id='prof_pic'></div>
<div style='text-align:left;padding-left: 20px; width:60%;'>".$r["Name"]."</div>
<div style='text-align:right; width:5%;'>".$r['Eid']."</div>
</a>
          </div>
 <div id='out_right'>";
if($hostcheck==1){
    echo "<a href='contacts.php?id=".$r['Eid']."' class='delete'>D</a>";
        }
echo"</div>
         </div>";
  }
}
?>
    </div>
  </body>
</html>
