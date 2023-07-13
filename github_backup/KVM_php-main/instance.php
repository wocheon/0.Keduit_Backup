<!DOCTYPE html>
<html>

<head>
	<title>CREATE VM INSTANCE</title>
	<link rel="stylesheet" href="css1.css" type="text/css">
</head>
	
		
<body>
<!-- 메뉴바 -->
<?php include 'include/menu.php'?>

<!-- 본문-->	
	<h1>Create KVM Instance</h1><hr><br>
				
	<div style="text-align: center;">		             
		<b>step1.SELECT OPTION</b> > step2 > step3<br><br>
				
		<div id="center1">		             
			<form action="createvm.php" method="post">
                		VMname : &nbsp;&nbsp;<input type="text" name="vmname" style="font-size : 25px; width: 150px;"/><br><br>
                	
				VCPUS :&nbsp;&nbsp;
                	<select name="vcpus" style="font-size : 25px;">
                        	<option value="1">1 core</option>
                        	<option value="2">2 core</option>
                	</select><br><br>
                		
				VRAM :&nbsp;&nbsp;
                	<select name="ram" style="font-size : 25px;">
				<option value="512">0.5 GB</option>
                        	<option value="1024">1 GB</option>
                        	<option value="2048">2 GB</option>
                	</select><br><br>
                		Network Setting :&nbsp;&nbsp;
                	
			<select name="network" style="font-size : 25px;">
                        	<option value="bridge">Directly connect</option>
                        	<option value="nat">USE NAT</option>
                        	<option value="host-only">NULL</option>
                	</select><br><br><br>
				
		 	<input type="reset" value="reset" style="font-size : 20px;">&nbsp;&nbsp;
                	<input type="submit" value="Next" style="font-size : 20px;" onclick="alert('start create KVM instance!')">
               	</form>
		</div>

<!-- 하단 연락처-->
<?php include 'include/bottom.html'?>
	
</body>
</html>
