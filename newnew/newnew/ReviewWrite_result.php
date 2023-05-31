<?php
    $con = mysqli_connect("localhost", "pdy1201", "AA1205dnflwlq!!", "pdy1201");
		// $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
    mysqli_query($con,'SET NAMES utf8');
		
		//세션 데이터에 접근하기 위해 세션 시작
		if (!session_id()) {
			session_start();
		}

    // $movie = $_POST['movie'];
		$writer = $_POST['writer'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$hit = $_POST['hit'];
		
	// if(!$movie)
	// {
	// 	echo "<script>alert('영화를 선택해 주세요');</script>"; 
	// 	echo("<script>history.back();</script>"); 
	// 	return;
	// }
	// if(!$writer)
	// {
	// 	echo "<script>alert('작성자를 입력하세요');</script>"; 
	// 	echo("<script>history.back();</script>"); 
	// 	return;
	// }
	// if(!$title)
	// {
	// 	echo "<script>alert('제목을 입력하세요');</script>"; 
	// 	echo("<script>history.back();</script>"); 
	// 	return;
	// }
	// if(!$content)
	// {
	// 	echo "<script>alert('내용을 입력하세요');</script>"; 
	// 	echo("<script>history.back();</script>"); 
	// 	return;
	// }   
	
	
    $statement = mysqli_prepare($con, "INSERT INTO board VALUES (null,?,?,?,?)");
		mysqli_stmt_bind_param($statement, "ssss", $writer, $title, $content, $hit);
    mysqli_stmt_execute($statement);

    echo "<script>alert('게시물이 등록되었습니다');</script>"; 
    echo("<script>location.href='./ReviewBoard.php';</script>"); 
?> 