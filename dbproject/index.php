<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
    <title>
    ARMS
    </title>
    <link rel="icon" href="https://www.birchstreetsystems.com/wp-content/uploads/2016/04/restaurant-icon-2.png">

<!-- this gives time on the top of the page-->
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>

<link href="style.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<style>

h2{
color:BlACK;
}
.row{
	background:black;
	opacity:0.6;
}
.row:hover{
	opacity:0.8;
	transition-delay:0.3s;
	transition:opacity 0.3s;
	}

.form-control{
	width:280px;
}

body{
background-image:url("bk.jpg");
background-repeat:no-repeat;
color:white;
margin:20px;}
</style>

</head>
<body onload="startTime()">

<div id="time" align="right"></div>

<?php
include("connect.php");
// ---------Validation Checks on data------------------//
$sqlq=$name =$err= $email = $gender  = $website = $Dish1 = $Dish2= $Dish3= $mypass="";
$nameErr = $emailErr = $genderErr = $websiteErr = $errDish1= $errDish2= $errDish3= $errpass="";
if(isset($_POST["submit"])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "Name is also required";
  } else {
    $name = ($_POST["name"]);
  }

  if (empty($_POST["mynumber"])) {
    $emailErr = "Number is also required";
  } else {
    $number = ($_POST["mynumber"]);
  }

	if (empty($_POST["gender"]))  {
    $genderErr = "Gender is also required";
	} else {
    $gender = ($_POST["gender"]);
	}

	if (empty($_POST["mypass"]))  {
    $errpass= "Password is also required";
	} else {
     $mypass = ($_POST["mypass"]);
	}

	if (empty($_POST["dish1"]) )  {            //dish 1
    $errDish1 = ($_POST["dish1"]);
	} else {
    $Dish1 = ($_POST["dish1"]);
	 }


	 if (empty($_POST["dish2"]) )  {        //dish2
    $errDish2 = ($_POST["dish2"]);
	} else {
    $Dish2 = ($_POST["dish2"]);
	 }


	 if (empty($_POST["dish3"]) )  {            //dish3
    $errDish3 = ($_POST["dish3"]);
	} else {
    $Dish3 = ($_POST["dish3"]);
	 }
	 //------------------insert data in database---------------------------//
   if(!empty($name) && !empty($gender) && !empty($number) && !empty($mypass)) {
     $checkno= mysqli_query($con,"SELECT * FROM hotel1.customer WHERE MobileNumber='$number'");
       if(mysqli_num_rows($checkno)>0){
         echo "<script type='text/javascript'>alert('Phone Number is already register Try With Different Number!!')</script>";
         goto a;
       }
    $encryptpass=md5($mypass);
      $insertvalue=("INSERT INTO hotel1.customer(Name,MobileNumber,Gender) VALUES ('{$name}','{$number}','{$gender}')");
   //'{$encryptpass}'
   if ($con->query($insertvalue) === TRUE) {
     }else {
   echo "Error Occured ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
   }

   $status="customer";

   //----------------inset in login form --------------------//
  $Logindata=("INSERT INTO hotel1.login(Mnumber,Password,Status) VALUES('{$number}','{$encryptpass}','{$status}') ");
   if ($con->query($Logindata) === TRUE) {
     }else {
   echo "Error Occured in login form ðŸ˜ž : " . $sqlq . "<br>" . mysqli_error($con);
   }



   //--------------insert favourite dishes--------------------//
   if(!empty($Dish1)){$insertvalue1=mysqli_query($con,("INSERT INTO hotel1.favdish(Num,DishId) VALUES ('$number','$Dish1') "));}
   if(!empty($Dish2)){$insertvalue2=mysqli_query($con,("INSERT INTO hotel1.favdish(Num,DishId) VALUES ('$number','$Dish2') "));}
   if(!empty($Dish3)){$insertvalue3=mysqli_query($con,("INSERT INTO hotel1.favdish(Num,DishId) VALUES ('$number','$Dish3') "));}

   echo "<script type='text/javascript'>alert('You are registered Successfully !!')</script>";


   //----------------select the menu --------------------------//

  }
  a:
}
}?>

    <h2><b>Welcome To Automated Restaurant Management System (ARMS)</b></h2>
<br>
<div class="row" style="margin:35px;">
<div class="col-md-6" style="border:10px solid black;border-right:5px solid gray;padding-left:8%;width:50%;">
<h2 style="color:white">Register Yourself</h2>


<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name:*
  <input class="form-control" type="text" name="name" placeholder="Enter Your Name" maxlength="20">
  <span class="error"><?php echo $nameErr;?></span>
  Number:*
  <input class="form-control" type="text" name="mynumber" placeholder="03XXXXXXX" maxlength="11" required pattern="[0-9]{11}">
  <span class="error"><?php echo $emailErr;?></span>

   <?php $menu1=mysqli_query($con,"SELECT * FROM hotel1.menu");
		$menu2=mysqli_query($con,"SELECT * FROM hotel1.menu");
		$menu3=mysqli_query($con,"SELECT * FROM hotel1.menu");?>
  Gender:*
  <input  type="radio" name="gender" value="F">Female
  <input  type="radio" name="gender" value="M">Male
  <span class="error"><?php echo $genderErr;?></span>



  <br>
  Favourite Dish 1:
<select class="form-control" name="dish1">

 <option value="">select the option</option>
 <?php while ($favmenu1=mysqli_fetch_array($menu1)):;?>
  <option value="<?php echo $favmenu1[0];?>"><?php echo $favmenu1[1];?></option>
  <?php endwhile;?>

</select>

Favourite Dish 2:
<select class="form-control" name="dish2">

 <option value="">select the option</option>
 <?php while ($favmenu2=mysqli_fetch_array($menu2)):;?>
  <option value="<?php echo $favmenu2[0];?>"><?php echo $favmenu2[1];?></option>
  <?php endwhile;?>

</select>

Favourite Dish 3:
<select  class="form-control" name="dish3">

   <option value="">select the option</option>
 <?php while ($favmenu3=mysqli_fetch_array($menu3)):;?>
  <option value="<?php echo $favmenu3[0];?>"><?php echo $favmenu3[1]; ?></option>
  <?php endwhile;?>

</select>



  Password:* <input class="form-control" type="password" name="mypass" placeholder="Enter your Password">
  <span class="error"><?php echo $errpass;?></span>

  <br>
  <input class="btn btn-success btn-lg" type="submit" name="submit" value="Submit">
</form>
</div>

<!-------------------------------------------------------  -->
<!---------------------------- LOGIN HERE---------------- -->
<!-------------------------------------------------------* -->


<?php
include("connect.php");
if(isset($_POST['submit2'])){
 $username=$_POST['username'];
 $password=$_POST['password'];
 //Protect MySQL Injection
 $username=stripcslashes($username);
 $username=mysqli_real_escape_string($con,$username);
$username=htmlspecialchars($username);

 $password=stripcslashes($password);
 //$password=mysqli_real_escape_string($password);
 $password=htmlspecialchars($password);
 $password1=md5($password);
 //Run Query to Database
 $sql="SELECT * FROM login WHERE Mnumber='$username' AND Password='$password1'";
 $result=mysqli_query($con,$sql);
 //Counting Numbers of MySQL row [if user Found row must be 1]
 $row=mysqli_num_rows($result);
 //Fetching User Informaiton from Database
 $userinfo=mysqli_fetch_assoc($result);
 $role=$userinfo['Status'];
 if($row==1){
  //Initilizing SESSION with Differents user Role
  $_SESSION["number1"]= $username;
  $_SESSION['status']=$role;

  if($role=='employee'){
    $URL="http://localhost:/dbproject/employee.php"; // refresh the page so that it will eliminate the delivered product
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  }
  if($role=='customer'){
    $URL="http://localhost:/dbproject/customer/customerform.php"; // refresh the page so that it will eliminate the delivered product
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  }
  if($role=='manager'){
    $URL="http://localhost:/dbproject/manager.php"; // refresh the page so that it will eliminate the delivered product
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  }
 }else{
	$err="No User is found on given credentials, Check User name and Password";
 }
}
?>
 <div class="col-md-6" style="border:10px solid black;padding-right:100px;padding-left:100px;">
<h2 style="color:white">Login Here</h2><br><br>
<link rel="stylesheet" href="style.css" type="text/css"/>
<div class="form-group">
<form  method="POST" action="">
<label>Phone Number:</label>

<input class="form-control" type="text" name="username" maxlength="11"/>

<label>Password:</label>

<input class="form-control" type="password" name="password"/>
 <br>
<input class="btn btn-success btn-lg" type="submit" name="submit2" value="LogIn"/>

<p><?php
	echo $err;
?></p>
</form>
</div>
</div>
</div>



<?php
$host="localhost";//Host Name
$username="root"; //MySQL username. root is Default.
$password=""; //MySQL Password
$dbname="hotel1"; //Your Database Name
//Connecting To The Server
$con=mysqli_connect($host,$username,$password)or die("Failed To Connect");
//Selecting Database
mysqli_select_db($con,$dbname)or die("Failed to select database");
?>

</body>
</html>
