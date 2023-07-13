<!DOCTYPE html>
<html>
<head>
        <title> mysqlcontest </title>
        <link rel="stylesheet" href="css1.css" type="text/css">
</head>

<body>
<!-- 메뉴바-->        
<?php include 'include/menu.php'?>
<?php include 'include/mariadbcon.php'?>
        
<!-- 1.Mariadb와 연결 여부 확인, view테이블에서 몇줄이 나오는지 확인-->        
        <p>
        <?php
       // $con = mysqli_connect("192.168.1.101", "user1", "user1","testdb") or die ("Mysql connection fail !!!");
        echo ("MYSQL CON success!!");
        $sql = "SELECT * FROM vm_view";
        $ret = mysqli_query($con, $sql);

        if ($ret) {
        echo "(".mysqli_num_rows($ret), "rows serch)"."<br>"."<br>";
        }

        else {
        echo "데이터 조회실패!!"."<br>";
        exit();
        }
        ?>
        </p>

<!-- 2.불러온 데이터를 이용하여 테이블 생성-->
        <div align="center">
                <h1> vm list </h1>

                <?php
                echo"<TABLE>";
                echo"<TR>";
                echo "<TH>Hostname</TH><TH>HostIP</TH><TH>cpurate</TH><TH>vmname</TH><TH>vcpus</TH><TH>vram</TH>";
                echo"</TR>";

                while($row = mysqli_fetch_array($ret)) {
                        echo "<TR>";
                        echo "<TD>".$row['hostname']."</TD>";
                        echo "<TD>".$row['ipaddr']."</TD>";
                        echo "<TD>".$row['cpurate']."</TD>";
                        echo "<TD>".$row['vmname']."</TD>";
                        echo "<TD>".$row['vcpus']."</TD>";
                        echo "<TD>".$row['vram']."</TD>";
                        echo "</TR>";
                }
                echo"</TABLE>";
                mysqli_close($con);
                ?>
        </div>

<!-- 하단 연락처-->        
<?php include 'include/bottom.html'?>
</body>
</html>
