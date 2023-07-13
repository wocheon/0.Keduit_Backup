<!DOCTYPE html>
<html>
<head>
        <title> mysqlcontest </title>
        <link rel="stylesheet" href="css1.css" type="text/css">
</head>

<body>
<!-- ��~T�~I���~T-->
<?php include 'include/menu.php'?>
<?php include 'include/mariadbcon.php'?>
<!-- 1.Mariadb�~Y~@ �~W�결 �~W���~@ �~Y~U�~]�, view�~E~L�~]���~T�~W~P�~D~\ ��~G��~D�~]� �~B~X�~X��~J~T��~@ �~Y~U�~]�-->
        <p>
        <?php
        //$con = mysqli_connect("172.17.0.3", "root", "diak1351!","testdb") or die ("Mysql connection fail !!!");
        //echo ("DB SEVER ON!!");
        $sql = "SELECT * FROM comment";
       $ret = mysqli_query($con, $sql);

        ?>
        </p>
        <div id="center1">
                <form action="comment1.php" method="post">
                Comment : &nbsp;&nbsp;<br><input type="text" name="comment" style="font-size : 23px; width: 350px; height: 100px;"/>
                <input type="submit" value="OK" style="font-size : 20px;" >
                        </form>
        </div>



<!-- 2.��~H�~_��~X� �~M��~]��~D�를 �~]��~Z��~U~X�~W� �~E~L�~]���~T �~C~]�~D�-->
        <div align="center">
                <h1> Comment </h1>

                <?php
                echo"<TABLE>";
                echo"<TR>";
                echo "<TH>ID</TH><TH>Comment</TH>";
                echo"</TR>";

                while($row = mysqli_fetch_array($ret)) {
                        echo "<TR>";
                        echo "<TD>".$row['id']."</TD>";
                        echo "<TD>".$row['comment']."</TD>";
                        echo "</TR>";
                }
                echo"</TABLE>";
                mysqli_close($con);
                ?>
        </div>

<!-- �~U~X�~K� �~W��~]���~X-->
<?php include 'include/bottom.html'?>
</body>
</html>
