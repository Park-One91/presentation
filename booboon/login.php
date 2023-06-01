<?php
  //세션 데이터에 접근하기 위해 세션 시작
  session_start();
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
      <meta charset="UTF-8">
      <title>booboon</title>
      <link rel="stylesheet" href="css/booboon.css" />
  </head>
  <body>
      <div id="wrap">
          <div class="header1">
            <!-- header -->
            <!-- 로고 & 타이틀 & 메뉴 -->
            <img src="img/recycle-unscreen.gif" alt="로고" style="float:left;margin-top:20px;margin-left:30px;"></img>
            <strong>
            <?php
            if($_SESSION['login_check']==true)
            {
            ?>				
            <a href=".\index-afterlogin.php">booboon</a>
            <?php                 
            }else
            {
            ?>
            <a href=".\index.html">booboon</a>
            <?php                 
            }
            ?>
            </strong>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <a class="menuLink" href=".\index.html">Home</a>  
            <a class="menuLink" href=".\goude.php">가이드</a>
            <a class="menuLink" href=".\board.php">게시판</a>
            <a class="menuLink" href=".\join.php">회원가입</a>
            <a class="menuLink" href=".\login.php">로그인</a>
            <a class="menuLink" href=".\my.php">내 정보</a>
          </div>
          
          <!-- 메인 -->
          <div class="login">
              
              <div class="login_left">
                <img id="logo_login" src="img/login-unscreen.gif" lt="이미지" ></img>
              </div>

              <form method="POST" action="login_result.php">
                <div class="login_right">
                
                <div class="login_title">
                  <a style="text-align: center; width: 200px; height: 30px; font-size : 60px">LOG IN</a>
                </div>
                  
                <div class="login_center">
                  <div class="login_center_in">
                    아 이 디 : <input type="text" name="id" style="text-align: bottom; width: 200px; height: 30px; font-size : 18px" value="<?=$id?>">
                    <br>
                    비밀번호 : <input type="password" name="pw" style="text-align: bottom; width: 192px; height: 30.5px; font-size : 18px" value="<?=$pw?>">
                    <br>
                    <br>
                    <input id="btn" type="submit" style="WIDTH: 90pt; HEIGHT: 30pt; font-size:20px;"  value="로그인">
                    <input id="btn" type="Button" style="WIDTH: 90pt; HEIGHT: 30pt; font-size:20px;"  value="회원가입">
                  </div>
                </div>
              </form>
              
          </div>
            
          <!-- footer -->
          <div class="footer_login1">
            <a class="menuLink" href=".\">사업자정보</a>
            <a class="menuLink" href=".\">채용정보</a>
            <a class="menuLink" href=".\">주소</a>
            <a class="menuLink" href=".\">전화번호</a>
            <a class="menuLink" href=".\">이메일</a>
            <a class="menuLink" href=".\">고객센터</a>
          </div>
          <br>
          <div class="footer_login2"></div>
      </div>
  </body>
</html>






