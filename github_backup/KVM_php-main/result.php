<!DOCTYPE HTML>
<html>
<head>
        <title>  install result </title>
<head>

<body>
<!-- 메뉴바-->
<?php include 'include/menu.php'?>

<!-- 본문-->
        
        <h1>Create KVM Instance</h1><hr><br>

        <div style="text-align: center;">                
                step1 > step2 > <b>step3.Finished</b><br><br>
        </div>

        <div id="center"> <h1>result</h1> </div> <hr>

<!-- 1.post로 받은 변수로 echo출력 및 ins1.sh(DB에 입력)실행 -->
        <h2>
                <?php
                $vmname=$_POST["vmname"];
                $vcpus=$_POST["vcpus"];
                $ram=$_POST["ram"];
                $network=$_POST["network"];

                exec("/bin/bash /var/www/html/ins1.sh $vmname $vcpus $ram");
                echo "vmname : "."$vmname"."<br>";
                echo "vmcpus : "."$vcpus"."<br>";
                echo "vram : "."$ram"."<br>";
                echo "network : "."$network"."<br>";
                ?>
        </h2>

<!-- 2.post로 받은 변수로 ins2.sh(virt-builder/install)실행 -->
        
        <h2>
                <?PHP
                $vmname1=$_POST["vmname"];
                $vcpus1=$_POST["vcpus"];
                $ram1=$_POST["ram"];
                $network1=$_POST["network"];
                exec("/bin/bash /var/www/html/ins2.sh $vmname1 $vcpus1 $ram1");
                $a1=" Install Finished !!";
                ?>
        </h2>
        
        <hr>
        <h3><?=$a1?></h3>

<!-- 3.DB리스트 이동버튼 -->        
        <div id="center">
                <form action="mysqlcon.php" method="post">
                <input type="submit" value="go to VM list" style="font-size : 20px; witdh: 50px;">
        </div>

<!-- 하단 연락처 -->                        
    <?php include 'include/bottom.html'?>
</body>
</html>
