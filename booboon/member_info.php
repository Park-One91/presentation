<?php
  $con = mysqli_connect("localhost", "root", "qwer", "php_db");
  mysqli_query($con,'SET NAMES utf8');

  //세션 데이터에 접근하기 위해 세션 시작
  if(!session_id()) 
    {
      session_start();
    }
	$search_name = $_GET['search_name'];
	//echo "<script>alert('받은값 : $search_name');</script>"; 
	$query = "select * from member where name = '".$search_name."'";
	$result = $con->query($query);
	$row = $result->fetch_assoc();
	//$id = $row["id"];
	//echo "<script>alert('받은값 :$id ');</script>";
?>

<!DOCTYPE html>
<html dir="ltr" lang="ko">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>회원정보 페이지</title>
    <style>
      
      p {
        text-align: center;
      }
      div {
        text-align: center;
      }
      #btn {
        width:100px;
        margin:auto;
        display:block;
      }
      img {
        width:350px;
        height:350px;
        margin:auto;
        display:block;
      }
      #title {
        text-align: center;
      }
      #menu {
        height: 40px; 
        width: auto; 
        margin-left: auto; 
        margin-right: auto; 
        display: inline-block;
      }
      #menu ul li {
        list-style: none;
        color: #4f4f4f;
        background-color: #ece6d4;
        float: left;
        line-height: 35px;
        vertical-align: middle;
        text-align: center;
      }
      #menu ul li:hover {
        text-decoration: none;
        color: #4f4f4f;
        border-bottom: 1px solid #4f4f4f;
        display: block;
        width: 100pxs;
        font-size: 13px;
        font-weight: bolder;
        font-family: verdana;
        outline: 0;
      }
      #menu .menuLink {
        text-decoration: none;
        color: #4f4f4f;
        display: block;
        width: 100px;
        font-size: 13px;
        font-weight: bold;
        font-family: verdana;
      }

    </style>

  </head >

  <body bgcolor = '#ece6d4'>

    <h2><p id="title">◀ 회원관리 사이트 ▶</p></h2>
        
      <center>
        <div id="menu">
          <ul>
                    <?php
                    if($_SESSION['login_check']==true)
                    {
                    ?>				
                    <li><a class="menuLink" href=".\index-afterlogin.php">Home</a></li>
                    <?php                 
                    }else
                    {
                    ?>
                    <li><a class="menuLink" href=".\index.html">Home</a></li>
                    <?php                 
                    }
                    ?>
                    <li><a class="menuLink" href=".\board.php">게시판</a></li>
                    <li><a class="menuLink" href=".\member_list.php">회원목록</a></li>
                    <li><a class="menuLink" href=".\member_info.php">회원수정</a></li>
                    <li><a class="menuLink" href=".\join.php">회원가입</a></li>
                    <?php
                    if($_SESSION['login_check']==true)
                    {
                    ?>				
                    <li><a class="menuLink" href=".\logout.php">로그아웃</a></li>
                    <?php                 
                    }else
                    {
                    ?>
                    <li><a class="menuLink" href=".\login.php">로그인</a></li>
                    <?php                 
                    }
                    ?>
          </ul>
        </div>
      </center>

      <h1><p>EDIT</p></h1>

      <img src="img/pencil-unscreen.gif" lt="이미지" ></img>
      
      <div>
        <form  method="get" action="search_info.php">	
          <input type="search" id="search_input" name="search" value="<?php echo $_SESSION["name"]?>" placeholder="이름 입력">
          <button onclick="searchFunc()" class="favorite styled" type="button">불러오기</button>
        </form>

        <script>
            function searchFunc() 
              {
                var name = document.getElementById('search_input').value;		
                location.href="member_info.php?search_name="+name;
              }  
        </script>
      </div>
      <br>
      <form method="POST" action="edit_result.php">
        <p>아 이 디 : <input type="text" name="id" value="<?=$row["id"]?>"></p>
        <p>비밀번호 : <input type="password" name="pw" value="<?=$row["pw"]?>"></p>
        <p>비밀번호 확인 : <input type="password" name="pw2" value="<?=$row["pw"]?>"></p>
        <p>이    름 : <input type="text" name="name" value="<?=$row["name"]?>"></p>
        <p>연 락 처 : <input type="text" name="hp" value="<?=$row["hp"]?>"></p>
        <p>이 메 일 : <input type="text" name="email" value="<?=$row["email"]?>"></p>
        <input id="btn" type="submit" value="수정하기"><br/>
      </form>
  </body>
</html>