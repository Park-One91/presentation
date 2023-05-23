<?php
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
    mysqli_query($con,'SET NAMES utf8');
    //세션 시작
	session_start();
    $_SESSION['id'] = $id;
    $loginCheck=false;       
    $query = "select * from member where id = '".$id."' and pw='".$pw."'";
    $result = $con->query($query);
    while($row = $result->fetch_assoc())
        {
            $loginCheck=true; 
            //세션 변수 등록
            $_SESSION['login_check'] = "true";        
            $_SESSION['name'] = $row["name"] ;               
            $_SESSION['check'] = $row["name"] ;               
        }
    if($loginCheck == true)
        {
            echo "<script>alert('로그인 되었습니다');</script>"; 
            echo("<script>location.href='./index-afterlogin.php';</script>");
        }
    else
        {
            echo "<script>alert('아이디와 비밀번호를 확인하세요');</script>"; 
            echo("<script>history.back();</script>"); 
        }
?>