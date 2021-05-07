<!doctype html>
<?php
session_start();

$error_Fname = $First_Name= "";
$error_Lname = $Last_Name= "";
$error_email = $Email= "";
$error_pass = $Password= "";
$error_Cpass = $Confirm_pass= "";
$error_phone = $Phone_No= "";
$error_Gender = $Gender= "";

    if(count($_POST) > 0) 
    {
        $First_Name = $_POST['fname'];
        $Last_Name = $_POST['lname'];
        $Email = $_POST['email'];
        $Password = $_POST['pass'];
        $Confirm_pass = $_POST['cpass'];
        $Phone_No = $_POST['phone'];

        if(trim($First_Name) == "") 
        {
            $error_Fname = "First Name is required.<br/>";
        }
        if(trim($Last_Name == "")) 
        {
            $error_Lname .= "Last Name is required.<br/>";
        }
        function email_validation($Email) 
        {
            return (!preg_match(
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $Email))
                ? FALSE : TRUE;
        }
        if(!email_validation("$Email")) {
            $error_email .= "Invalid Email.<br/>";
        }
        if(trim($Password) == "") 
        {
            $error_pass .= "Password is required.<br/>";
        }
        if(trim($Confirm_pass) == "") 
        {
            $error_Cpass .= "Confirm password is required.<br/>";
        }
        if(!preg_match("/^\d{10}+$/", empty($Phone_No)))
        {
            $error_phone .= "Phone no. does not match";
        }
        if (empty($_POST["gender"])) 
        {
            $error_Gender = "Gender is required";
        } 
        else 
        {
            $Gender =$_POST['gender'];
        }
    }
if (!empty($First_Name) AND !empty($Last_Name) AND !empty($Email) AND !empty($Password) AND !empty($Phone_No) AND !empty($Gender))
{
    $host="localhost";
    $dbusername ="root";
    $dbpassword ="";
    $dbname = "db_xyz";
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

        $sql = "Select * from user where email='$Email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);   
    
        if (mysqli_connect_error())
    {
        die('Connect Error ('. mysqli_connect_errno() .')'
        . mysqli_connect_error());
    }
        else
        {
            if($Password == $Confirm_pass)
            {
            if($num == 0)
            {            
            $sql = "INSERT INTO user (F_Name,L_Name,email,password,phone_no,gender)
            values ('$First_Name','$Last_Name','$Email','$Password','$Phone_No','$Gender')";
        if ($conn->query($sql))
        {
            if($result)
            {         
                $_SESSION ["Name"] = $First_Name. " " .$Last_Name;
                $_SESSION ["Email"] = $Email;
                $_SESSION ["Phone"] = $Phone_No;
                $_SESSION ["Gender"] = $Gender;   
            }
            header("location: http://localhost/Php_assessment/welcome.php");
        }
        else
        {
            echo "Error: ". $sql ."
            ". $conn->error;
        }
        $conn->close();
        }
        else
        {
            echo "<p style='text-align:center;'>Email already Registered...</p>";
        }
    }
    else{
        echo "<p style='text-align:center;'>Password Does not Match</p>";
    }
}
}
?>
<html>
<head> 
    <link rel="stylesheet" href="css/register.css">
    <title>Portal</title>    
    </head>
    <body> 
            <h2>Registration Page</h2> 
            <form name="myform" action="register.php" method="POST">
                First Name*:<input type="text"  value="<?php echo $First_Name; ?>" name="fname"><?php echo $error_Fname; ?><br><br>
                Last Name*:<input type="text"  value="<?php echo $Last_Name; ?>" name="lname" ><?php echo $error_Lname; ?><br><br>
                Email*:<input type="text"  value="<?php echo $Email; ?>" name="email"><?php echo $error_email; ?><br><br>
                Password*:<input type="password" name="pass" ><?php echo $error_pass; ?><br><br>
                Confirm Password*:<input type="password" name="cpass"><?php echo $error_Cpass; ?><br><br>
                Phone No.*: <input type="text"  value="<?php echo $Phone_No; ?>" name="phone"><?php echo $error_phone; ?><br><br>
                Gender:
                <input type="radio" name="gender" <?php if (isset($Gender) && $Gender=="female") echo "checked";?> value="female">Female
                <input type="radio" name="gender" <?php if (isset($Gender) && $Gender=="male") echo "checked";?> value="male">Male
                <input type="radio" name="gender" <?php if (isset($Gender) && $Gender=="other") echo "checked";?> value="other">Other  
                <span class="error">* <?php echo $error_Gender;?></span>
                <br><br>
                <input type="submit" name="submit" value="Register"><br><br>
                <a href="login.php">Login Here</a>
            </form>
    </body>
</html>