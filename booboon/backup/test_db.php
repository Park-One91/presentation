<!DOCTYPE html>
<html dir="ltr" lang="ko">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title>디비 연동 테스트 체킹 페이지~!</title>


</head>
<body>
테스트!!


    <?php
    echo "DB 연결 테스트 <br>";

// echo "<script>alert('패스워드를 입력해주세요.')</script>";

    $db = mysqli_connect("localhost","root","qwer","php_db");



    if($db){
        echo "접속 성공 <br>";            
    }
    else
    {
        echo "접속 실패 <br>";
    }

$result = mysqli_query($db, 'SELECT VERSION() as VERSION');
$data = mysqli_fetch_assoc($result);
echo $data['VERSION'];

?>



</body>
</html>