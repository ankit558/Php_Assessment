<html>
    <head>
    <title>Home Page</title>
<style>
    div{
        margin:15%;
        text-align:center;
        font-size:30px;
        color:white;
    }
    h1{
        text-align:center;
        color:#149863;
        font-size:50px;
    }
    a{
        color:white;
    }
</style>    
</head>
    <body background="image/welcome.jpg" style="background-size: 100%;">
    <h1>Welcome to Home Page</h1>
    <?php
           $host="localhost";
           $dbusername ="root";
           $dbpassword ="";
           $dbname = "db_xyz";     
           $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
           session_start();
       if (mysqli_connect_error())
       {
           die('Connect Error ('. mysqli_connect_errno() .')'
           . mysqli_connect_error());
       }
        echo "<div>Welcome:" .$_SESSION["Name"]."<br>";
        echo "Email:" .$_SESSION["Email"]."<br>";
        echo "Phone No.:" .$_SESSION["Phone"]."<br>";
        echo "Gender:" .$_SESSION["Gender"]."</div><br>";
    ?>
        <a href="contact.php">Contact_Us</a>
    </body>
</html>