<?php
    $con = mysqli_connect("localhost", "pdy1201", "AA1205dnflwlq!!", "pdy1201");
		// $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
    mysqli_query($con,'SET NAMES utf8');
		
		//세션 데이터에 접근하기 위해 세션 시작
		if (!session_id()) {
			session_start();
		}

		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		
    $statement = mysqli_prepare($con, "INSERT INTO contact VALUES (null,?,?,?)");
		mysqli_stmt_bind_param($statement, "sss", $name, $email, $message);
    mysqli_stmt_execute($statement);

    echo "<script>alert('메시지가 전송되었습니다');</script>"; 
    echo("<script>location.href='./index.html';</script>"); 
?> 