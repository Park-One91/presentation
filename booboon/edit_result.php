<?php
    $con = mysqli_connect("localhost", "root", "qwer", "php_db");
    mysqli_query($con,'SET NAMES utf8');
    $id = $_POST['id'];
    $pw = $_POST['pw'];
	$pw2 = $_POST['pw2'];
    $name = $_POST['name'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
	if($pw!=$pw2)
	{
		echo "<script>alert('비밀번호가 서로 다릅니다.');</script>";
		echo("<script>history.back();</script>");  
	}
	$query  = "update member Set pw ='".$pw."', name ='".$name."', hp ='".$hp."', email ='".$email."'  
    where id ='".$id."'";
    $result = $con->query($query);    
	echo "<script>alert('정보가 수정 되었습니다');</script>";
	echo("<script>history.back();</script>");    
?>