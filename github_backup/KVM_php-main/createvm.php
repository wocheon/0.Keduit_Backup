<!DOCTYPE html>
<html>
<head>
        <title>가상머신 생성 페이지</title>
</head>


<body>
<!-- 메뉴바-->
<?php include 'include/menu.php'?>

<!-- 본문-->

        <h1>Create KVM Instance</h1><hr><br>

        <div style="text-align: center;">
                step1 > <b>step2.Check Your Select</b> > step3<br><br>
        </div><br><br>

        <h2> [selected setting]<br> </h2>

<!-- 1.post로 받은 변수 표현 -->
        <h1>
                <?php
                $vmname=$_POST["vmname"];
                $vcpus=$_POST["vcpus"];
                $ram=$_POST["ram"];
                $network=$_POST["network"];
                echo "vmname : "."$vmname"."<br>";
                echo "vmcpus : "."$vcpus"."<br>";
                echo "vram : "."$ram"."<br>";
                echo "network : "."$network"."<br>";
                ?>
        </h1>

<!-- 2.취소하고 이전 페이지로 이동-->
        <div id="center">
                <form action="instance.html" method="post">
                        <input type="submit" value="cancel" style="font-size : 26px; witdh: 50px; display: inline;">
                </form>

<!-- 3.post로 변수 전달-->
                <form action="loading.php" method="post" >
                        <input type=hidden name=vmname value=<?=$vmname?>>
                        <input type=hidden name=vcpus value=<?=$vcpus?>>
                        <input type=hidden name=ram value=<?=$ram?>>
                        <input type=hidden name=network value=<?=$network?>>
                        <input type="submit" value="install" style="font-size : 26px;  display: inline; witdh: 50px;" >
                </form>
        </div>


<!-- 하단 연락처-->
<?php include 'include/bottom.html'?>
</body>
</html>
