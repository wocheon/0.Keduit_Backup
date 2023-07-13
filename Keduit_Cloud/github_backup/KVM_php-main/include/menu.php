<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="css1.css" type="text/css">
</head>


<body>
<!-- 메뉴바-->
        <div id="main"> MANAGEMENT PAGE<br></div>
        <h2> HELLO <?php session_start(); echo $_SESSION['id'];?> !</h2>
        
        <ul>
        <li><a href="index1.php">Home</a></li>
        <li><a href="instance.php">CreateVM</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="mysqlcon.php">DB</a></li>
        <li><a href="comment.php">COMMENT</a></li>
        <li><a href="index.html">LOGOUT</a></li>

        </ul><br>

</body>
</html>
