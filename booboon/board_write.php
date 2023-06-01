<?php
  $con = mysqli_connect("localhost", "root", "qwer", "php_db");
  mysqli_query($con,'SET NAMES utf8');	
  //세션 데이터에 접근하기 위해 세션 시작
  session_start();
  $idx = $_GET['idx'];                                             
  $sql = "select * from board where idx ='$idx'"; 
  $result = mysqli_query($con, $sql); 
  $row = mysqli_fetch_array($result);  
?>

<!DOCTYPE html>
  <html lang="ko">
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>회원관리 사이트</title>
      <link rel="stylesheet" href="css/booboon.css" />
    </head>
  <body bgcolor = '#ece6d4'>

    <!-- title & navigator -->
    <h2><p id="title">&nbsp&nbsp◀ 회원관리 사이트 ▶</p></h2>
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
    <center>  

      <!-- 본문 -->
      <div class="container">	
      <h1><p>&nbspWRITE</p></h1>
      <img src="img/notebook-unscreen.gif" lt="이미지" ></img>

      <!-- 글 쓰기 -->
      <form action="write_result.php" enctype="multipart/form-data" method="post">
        <div id="board_write">
          <table>
            <colgroup>
              <col width="0%">
              <col>
            </colgroup>
            <tbody>
              <tr>
                <th>작성자</th>	
                <td><input type="text" name="writer" class="form-control" value="<?php echo $_SESSION["name"]?>" detect="" detect-check="true"></td>
              </tr>
              <tr>
                <th>제목</th>
                <?php if($answer==1) { ?>
                <td><input type="text" name="title" id="subject" class="form-control" value="ㄴ[ <?=$subject?> ]의 답변" detect="" detect-check="true"></td>
                <?php } else { ?>
                <td><input type="text" name="title" id="subject" class="form-control" value="" detect="" detect-check="true"></td>
                <?php } ?>	
              </tr>
              <tr>
                <td colspan="2" class="editor"><textarea name="content" rows="20" title="내용"></textarea></td>
              </tr>
              <tr>
                <th>첨부파일</th>
                <td>
                  <div class="file_box">
                    <input type="text" class="file_name" readonly="readonly"></input>
                    <label for="uploadBtn" class="btn_file">찾아보기</label>
                    <input type="file" id="uploadBtn" value="1" name="b_file" class="uploadBtn"></input>
                  </div>
                </td>
              </tr>				
            </tbody>
          </table>
        </div>
        
        <!-- 게시판 버튼 -->
        <div class="border_btn2">
          <button type="submit" class="btn blue" > 확인 </button> 
          <button type="button" class="btn gray" onclick="location.href='/ct/board.php'; return false;"> 취소 </button> 
        </div>
        
        <!-- //게시판 버튼 -->
        <input type="hidden" name="page" value="<?=$page_name?>" />
        <input type="hidden" name="answer" value="<?=$answer?>" />
        <? if($answer==1) { ?>
        <input type="hidden" name="idx" value="<?=$idx?>" />
        <?}?>
        </form>
      </div>
      
    </center>
  </body>
</html>