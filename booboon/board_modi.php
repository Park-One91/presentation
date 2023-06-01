<?php
  $con = mysqli_connect("localhost", "root", "qwer", "php_db");
  mysqli_query($con,'SET NAMES utf8');	
  //세션 데이터에 접근하기 위해 세션 시작
  if (!session_id()) 
    {
      session_start();
    }
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


      <!-- 게시판 쓰기 -->
      <center> 
      <form action="board_modi_result.php" enctype="multipart/form-data" method="post">
      <img src="img/scissors-unscreen.gif" lt="이미지" ></img>
        <div id="board_write">
          <table>
            <colgroup>
              <col width="20%">
              <col>
            </colgroup>

        
        <tbody>
          <tr>
            <th>작성자</th>					
            <td><input type="text" name="writer" class="form-control" value="<?php echo $row['writer']?>" detect="" detect-check="true" readonly="true"></td>
            
          </tr>
          
          
          
          <tr>
            <th>제목</th>
            <td><input type="text" name="title" id="subject" class="form-control" value="<?php echo $row['title']?>" detect="" detect-check="true"></td>

          </tr>
          <tr>
            
            <td colspan="2" class="editor"><textarea name="content" rows="20" title="내용"><?php echo $row['content']?></textarea></td>
            
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
            <!-- 수정대상 글 idx 보내기 -->
            <input type="hidden" id="idx" name="idx" value="<?php echo $row['idx']?>">

            <!-- //게시판 쓰기 -->
          <div class="btn_edit_body">
            <div class="btn_edit">
              <br>
              <br>
              <button type="submit" class="btn_edit gray" return false;"> 수정완료</button> 
              <button type="button" class="btn_edit gray" onclick="location.href='/board.php'; return false;"> 취소하기</button>  
              <br>
              <br>
            </div>
          </div>
          </form>

    </body>
                  </center>

  </html>
