<?php
  //세션 데이터에 접근하기 위해 세션 시작
  if (!session_id()) 
    {
      session_start();
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="ko">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>회원가입 페이지</title>
    <style>
      p {
          text-align: center;
        }
      #size {
          text-size: medium;
        }  
      #btn {
          width:100px;margin:auto;display:block;
        }
      img {
          width:400px;height:400px;margin:auto;display:block;
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

<!-- title & navigator -->
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
          <?php
          if($_SESSION['login_check']==true)
          {
          ?>				
          <li><a class="menuLink" href=".\member_info.php">회원수정</a></li>
          <?php                 
          }
          ?>
          <?php
          if($_SESSION['login_check']==true)
          {
          ?>				
          <li><a class="menuLink" href=".\join.php">회원가입</a></li>
          <script>alert('이미 회원입니다');</script>
          <script>history.back();</script>
          <?php                 
          }else
          {
          ?>
          <li><a class="menuLink" href=".\join.php">회원가입</a></li>
          <?php                 
          }
          ?>
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
  <h1><p>JOIN US</p></h1>
  <img src="img/teamwork-unscreen.gif" lt="이미지" ></img>
  <center>
    <form method="POST" action="join_result.php">
      <p style="color:red;">- (*)표시는 필수 입력사항 입니다 -</p>
      <p>* 아 이 디 : <input type="text" id="joinId" name="id" value=""> 
      <button onclick="idCheck()" class="favorite styled" type="button">중복체크</button> </p> 
      <font style="color:blue;" size="1.5">＊6~15자의 영문 소문자, 숫자만 가능합니다</font>
      <p class="pw">* 비밀번호 : <input type="password" name="pw" value=""></p>
      <font style="color:blue;" size="1.5">＊영문자, 숫자, 특수문자의 조합, 8자리 이상으로 이루어져야 합니다</font>
      <p class="pw">* 비밀번호 확인 : <input type="password" name="pw_r" value=""></p>
      <p>* 이    름 : <input type="text" name="name" value=""></p>
      <p>* 연 락 처 : <input type="text" name="hp" value=""></p>
      <p>
        이 메 일 : <input type="text" name="email" value="">
        @
        <select name="email_domain">
          <option value="1">naver.com</option>
          <option value="2">gmail.com</option>
          <option value="3">daum.net</option>
        </select>
      </p>
      <br/>
      <input id="btn" type="submit" value="가입 완료"><br/>
    </form>
  </center>
</body>
  <script type="text/javascript">
    function idCheck() {
		var id = document.getElementById('joinId').value;		
		location.href="id_check.php?id="+id;
    //alert(name);
    //document.getElementById('joinId').value = '';
    }
  </script>
</html>