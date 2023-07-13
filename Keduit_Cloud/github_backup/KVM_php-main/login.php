<!DOCTYPE HTML>
<HTML>
        <head>
                <link rel="stylesheet" href="css1.css" type="text/css">
        <head>

        <body>
<?php
        session_destroy();
        $input_id =$_POST['input1'];
        $input_password =$_POST['input2'];
        include 'include/mariadbcon.php';
        //$con = mysqli_connect("192.168.1.101", "user1", "user1","testdb") or die ("Mysql connection fail !!!");
        $sql = "SELECT password from usertbl where id ='$input_id'";
        $ret = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($ret);
        $s=$row['password'];

      if (password_verify($input_password, $s)) {
        session_start();
        $_SESSION['id'] = $input_id;
        echo("<script>location.href='index1.php';</script>");
        }
      else {
        echo("<script>location.href='index.html';</script>");
        }

        mysqli_close($con);
?>
        </body>

</HTML>
