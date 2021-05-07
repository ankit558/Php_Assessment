<!doctype html>
<?php

$error_email = $Email= "";
$error_pass = $Password= "";
$error_message = $Email = $Password ="";

if(count($_POST) > 0) 
{
    $Email = $_POST['email'];
    $Password = $_POST['pass'];

    function email_validation($Email) 
    {
        return (!preg_match(
    "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $Email))
            ? FALSE : TRUE;
    }
    if(!email_validation("$Email"))
    {
        $error_email .= "Invalid Email.<br/>";
    }
    if(trim($Password) == "") 
    {
        $error_pass .= "Password is required.<br/>";
    }
}
if (!empty($Email) AND !empty($Password))
{
    $host="localhost";
    $dbusername ="root";
    $dbpassword ="";
    $dbname = "db_xyz";

    $conn =mysqli_connect($host, $dbusername, $dbpassword, $dbname);
    session_start();
if (mysqli_connect_error())
{
    die('Connect Error ('. mysqli_connect_errno() .')'
    . mysqli_connect_error());
}
else
{
    $sql = "select * from user where email='".$Email."'AND Password='".$Password."'";
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) == 1)
    {
        while($row = $result->fetch_assoc()) 
        {         
            $_SESSION ["Name"] =  $row["f_name"]. " " .$row["l_name"];
            $_SESSION ["Email"] = $row["email"];
            $_SESSION ["Phone"] = $row["phone_no"];
            $_SESSION ["Gender"] =$row["gender"];
        }
        header("location: http://localhost/Php_assessment/welcome.php");
    }
    else
    {
       echo"<p style='text-align:center; color:white;'>Invalid Email and Password.<br/></p>";
    }
$conn->close();
}
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/login.css">
<title>Form site</title>
</head>
<body>   
        <h2>Login Page</h2>  
        <form name="myForm" method="post" action="login.php">
        <p>Email*: <input type="text" value="<?php echo $Email; ?>" name="email">
        <?php echo $error_email;?></P>
        <p>Password* :<input type="password" value="<?php echo $Password; ?>" name="pass" >
        <?php echo $error_pass; ?></p>
        <input type="submit" value="Log in"><br><br>
        <a href="register.php">Register Here</a>
</form>
</body>
</html>