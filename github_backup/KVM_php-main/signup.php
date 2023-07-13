<!DOCTYPE HTML>
<html>
<head> </head>
<body>
<?php
include 'include/mariadbcon.php';
$id = $_POST['input1'];
$pass = $_POST['input2'];
$name = $_POST['input3'];
$hashpass = password_hash($pass,PASSWORD_DEFAULT);


//$con = mysqli_connect("192.168.1.101", "user1", "user1", "testdb") or die("MYSQL con fail!"); 	
$sql = "insert into usertbl (id,password,name) values ('$id','$hashpass','$name')";
$ret = mysqli_query($con, $sql);

if ($ret)
echo "<h2>sign up ok!<h2>"."<br>";

else
echo "<h2>signup fail<h2>";

mysqli_close($con);
?>


     <div id="center1">
                                <form action="index.html" method="post">
                &nbsp;&nbsp;<input type="submit" value="Go To Login">
                </form>
                </div>
</body>
</html>
