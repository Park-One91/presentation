<?php
    $con = mysqli_connect("localhost", "root", "qwer", "php_db");
    mysqli_query($con,'SET NAMES utf8');

    $writer = $_POST['writer'];
    $title = $_POST['title'];
	$content = $_POST['content'];

	if(!$writer)
	{
		echo "<script>alert('작성자를 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$title)
	{
		echo "<script>alert('제목을 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$content)
	{
		echo "<script>alert('내용을 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}   
	
	$hit = 0;
    $statement = mysqli_prepare($con, "INSERT INTO board VALUES (null,?,?,?,now(), ? )");
    mysqli_stmt_bind_param($statement, "sssi", $title, $writer, $content, $hit );
    mysqli_stmt_execute($statement);

    echo "<script>alert('게시물이 등록되었습니다');</script>"; 
    echo("<script>location.href='./board.php';</script>"); 
?> 

