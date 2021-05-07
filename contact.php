<?php

$error_title = $Title= "";
$error_desc = $Description= "";
$error_priority = $Priority ="";

if(count($_POST) > 0) 
{
    $Title = $_POST['title'];
    $Description = $_POST['descrip'];
    $Priority = $_POST['priority'];

    if(trim($Title) == "") 
    {
        $error_title .= "Title is required.<br/>";
    }
    if(trim($Description) == "") 
    {
        $error_desc .= "description is required.<br/>";
    }
    if(trim($Priority) == "") 
    {
        $error_priority .= "Priority is required.<br/>";
    }
}
if (!empty($Title) AND !empty($Description) AND !empty($Priority))
{
    $host="localhost";
    $dbusername ="root";
    $dbpassword ="";
    $dbname = "db_xyz";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
    session_start();
    $name = $_SESSION['Name'];
    if (mysqli_connect_error())
    {
        die('Connect Error ('. mysqli_connect_errno() .')'
        . mysqli_connect_error());
    }
        else
        {
            $sql = "INSERT INTO contact (name,title,priority,description)
            values ('$name','$Title','$Priority','$Description')";

        if ($conn->query($sql))
        {
            header("location: http://localhost/php_assessment/Contact.php");
        }
        else
        {
            echo "Error: ". $sql ."
            ". $conn->error;
        }
        $conn->close();
        }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="css/contact1.css">
    </head>
    <body background="image/ice2.jpg">
        <section>
            <div><h2>Contact Us</h2><p>Praesent tempus dapibus odio nec elementum.</p>          
            <form id="inputform" action="contact.php" method="POST">         
            <div class="dropdown">
                <label for="priority">Priority:</label>
                <select name="priority" id="priority">
                    <option value="">--Select--</option>
                    <option <?php if (isset($Priority) && $Priority =="High") echo "selected";?> value="High">High</option>
                    <option <?php if (isset($Priority) && $Priority =="Medium") echo "selected";?> value="Medium">Medium</option>
                    <option <?php if (isset($Priority) && $Priority =="Low") echo "selected";?> value="Low">Low</option>
                </select></br><?php echo $error_priority;?></div>

                <input type="text" id="name"  value="<?php echo $Title; ?>" name="title" placeholder="Title" style="margin-top: 5px; margin-bottom: 5px; box-sizing: border-box; width: 100%; height: 7%;"><br/>
                <?php echo $error_title;?>
                <textarea placeholder="Description"  value="<?php echo $Description; ?>" name="descrip" id="comment"  style="width: 100%; height: 30%;"></textarea>
                <?php echo $error_desc;?>
                <input type="submit" id="submit" value="Submit" style="color:white; background-color: #2e76db; border:0; letter-spacing:1px; margin-left: 82%; margin-top: 10px; font-size: 17px;">
            </form>
            </div>
            <div> <h2>123 New Street 11000, San Francisco, CA</h2>
				<img class="image" src="image/img1.jpg" style="width: 400px; height: 300px;" />
             </div>
        </section>
        <footer>
             <img src= "image/fb.jpg">
            <img src= "image/twitter.jpg">
            <img src= "image/gplus.jpg">
            <img src= "image/li.jpg">
        </footer>
        <div class="footer"><h2>Copyright &copy 2021 Your Company - design Template</h2></div>
    </body>
</html>