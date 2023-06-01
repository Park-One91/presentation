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
    <h1><p id="title">&nbsp&nbsp◀ 회원관리 사이트 ▶</p></h1>
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
      <div id="submenu2_1_container1">
          <div class="sub2_1_con1_wrap">
            <img src="img/optometrist-unscreen.gif" lt="이미지" ></img>
              <!-- 제목-->
              <div class="title_box">
                <br>
                <div class="add_info_table_lt_view">
                </div>
                <table border="3" bordercolor="#000000">
                  <br>
                  <h2>Title <?php echo $row['title']?></h2>
                  <p>작성자 : <?php echo $row['writer']?></p>
                  <th colspan="2" style="box-sizing:border-box;">Contents</th>
                  <tr>
                    <td colspan="1" class="textarea">
                      <p><?php echo $row['content']?></p>
                      <br>
                      <br>
                      <br>
                      
                    </td>
                  </tr>
                </table>
          </div>
      </div>
      <br>
      <br>
      <div class="btn_edit_body">
        <div class="btn_edit">
                    <?php
                    if($_SESSION['login_check']==true)
                    {
                    ?>				
                    <button type="button" class="btn_edit gray" onclick="location.href='/ct/board_modi.php?idx=<?=$idx?>'; return false;"> 수정</button> 
                    <?php                 
                    }
                    ?>
                    <?php
                    if($_SESSION['login_check']==true)
                    {
                    ?>				
                    <button type="button" class="btn_edit gray" onclick="location.href='/ct/board_del_result.php?idx=<?=$idx?>'; return false;"> 삭제</button>  
                    <?php                 
                    }
                    ?>

                    <!--  <?php echo "<script>alert('삭제하시겠습까?');</script>"; ?>    -->
                    <!-- <script type="text/javascript">
                    if (confirm("이 버튼에 대한 동작을 수행합니다. 계속합니까?")) {
                    // 확인 버튼 클릭 시 동작
                    alert("동작을 시작합니다.");
                    } else {
                    // 취소 버튼 클릭 시 동작
                    echo("<script>history.back();</script>");
                    }
                    </script> -->
  
        </div>
      </div>
    </center>
  </body>
</html>

