<!DOCTYPE HTML>
<html>
<head>
        <title> yum list installed </title>
<head>

<body>
<!-- 메뉴바-->
<?php include 'include/menu.php'?>

<!-- 본문-->

        <h1>Create KVM Instance</h1><hr><br>

        <div style="text-align: center;">
                step1 > step2 > <b>step3.Finished</b><br><br>
        </div>


        <?php
        ob_start();
        echo str_pad('', 4096);
        echo "<h1>installing....</h1>";
        echo "<h3>please wait<br>It take a few minute.</h3>";
        $vmname=$_POST["vmname"];
        $vcpus=$_POST["vcpus"];
        $ram=$_POST["ram"];
        $network=$_POST["network"];
        ?>


        <form name="hiddenform" action="result.php" method="post" >
        <input type=hidden name=vmname value=<?=$vmname?>>
        <input type=hidden name=vcpus value=<?=$vcpus?>>
        <input type=hidden name=ram value=<?=$ram?>>
        <input type=hidden name=network value=<?=$network?>>
        </form>

        <script>
        document.hiddenform.submit();
        </script>


        <?php
        ob_flush();
        flush();
        ob_end_flush();
        echo("<script>location.href='result.php';</script>");
        ?>

<!-- 하단 연락처 -->
<?php include 'include/bottom.html'?>

</body>
</html>
