<?php
    $con = mysqli_connect("localhost", "root", "qwer", "php_db");
    mysqli_query($con,'SET NAMES utf8');	
    //세션 데이터에 접근하기 위해 세션 시작
    if (!session_id()) 
      {
        session_start();
      }
    $page = (isset($_GET["page"]) && $_GET["page"]) ? $_GET["page"] : 1;
    if (empty($page)) { $page = 1; }
    $select_query = "select COUNT(*) as size FROM board";        
    $result = mysqli_query($con, $select_query); 
    $row = mysqli_fetch_array($result);
    $nums = $row['size'];
    //화면에 목록 줄수
    $listSize = 10;
    //페이지 표시 최대 숫자
    $blockSize = 10; // 추가 !!
    $prevBlock="";
    $nextBlock="";
    $start = ($page - 1) * $listSize;
    $totalListCount = ceil($nums/ $listSize); // 추가해주기
    $no = $nums - $start; // 추가
    $totalBlockCount = ceil($totalListCount/$blockSize);
    $currentBlock = ceil($page / $blockSize);
    $startPage = ($currentBlock - 1) * $blockSize + 1;
    if ($currentBlock >= $totalBlockCount) 
      {
        $endPage = $totalListCount;
      }
    else
      {
        $endPage = $currentBlock * $blockSize;
      }
    if ($currentBlock > 1) 
      {
        $prevBlock = "
          <a class='page-link' href='./member_list.php?page=".($startPage - 1)."' aria-label='Previous'>
          <span aria-hidden='true'>&laquo;</span>
          </a>";
      }
    if ($currentBlock < $totalBlockCount) 
      {
         $nextBlock = "
          <a class='page-link' href='./member_list.php?page=".($endPage + 1)."' aria-label='Next'>
          <span aria-hidden='true'>&raquo;</span>
          </a>";
      }
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
            <?php
            if($_SESSION['login_check']==true)
            {
            ?>				
            <a class="menuLink" href=".\index-afterlogin.php">Home</a>
            <?php                 
            }else
            {
            ?>
            <a class="menuLink" href=".\index.html">Home</a>
            <?php                 
            }
            ?>
            <a class="menuLink" href=".\giude.php">가이드</a>
            <a class="menuLink" href=".\board.php">게시판</a>
            <a class="menuLink" href=".\join.php">회원가입</a>
            <?php
            if($_SESSION['login_check']==true)
            {
            ?>				
            <a class="menuLink" href=".\logout.php">로그아웃</a>
            <?php                 
            }else
            {
            ?>
            <a class="menuLink" href=".\login.php">로그인</a>
            <?php                 
            }
            ?>
             <a class="menuLink" href=".\mypage.php">내 정보</a>
          </div>
          
          <!-- 리스트 -->
          <div class="board">
              
              <div class="board_left">

                <div class="board_list_all">
                  <div class="board_list_blank">
                    
                  </div>
                  <div class="board_list_title">
                    COMMUNITY
                  </div>
                  <!-- <div class="board_list_menu">
                    글번호&nbsp&nbsp제목&nbsp&nbsp작성일&nbsp&nbsp조회수
                  </div> -->
                  
                  <div class="board_list_contents">
                 
                 <?php
                        $query = "select * FROM board ORDER BY idx desc LIMIT $start, $listSize";
                        $result = $con->query($query);		
                        while($row = $result->fetch_assoc()){
                      ?>
                        <li  style="list-style: none;">
                          <ul id ="board_list_table">
                            <ul style="list-style: none;">
                              <li style="list-style: none; backgound-color:green;"><a href="board_detail.php?idx=<?php echo $row['idx']?>"> <?=$row["idx"]?></a></li>
                              <li style="list-style: none;"><a href="board_detail.php?idx=<?php echo $row['idx']?>"> <?=$row["title"]?></a></li>
                              <li style="list-style: none;"><a href="board_detail.php?idx=<?php echo $row['idx']?>"> <?=$row["reg_date"]?></a></li>
                              <li style="list-style: none;"><a href="board_detail.php?idx=<?php echo $row['idx']?>"> <?=$row["hit"]?></a></li>
                            </ul>
                          </ul>
                        </li>
                      <?php
                        }
                      ?>
               
                </div>

                  <!-- 페이징
                  <li>
                    <div style="font-size:0.8em;color:#005b91; ">◀</div>
                    <?php									
                      for ($i = $startPage; $i <= $endPage; $i++) 
                      {
                        $active = $page == $i ? "disabled" : "";
                        echo "<div class='pagingbox'><a  ".$active."' href='./board.php?page=".$i."'>".$i."</a></div>";
                      }
                    ?>
                    <div style="font-size:0.8em; color:#005b91;">▶</div>
                  </li> -->

                </div>

              </div>
          </div>
            
          <!-- footer -->
          <div class="footer_board1">
            <a class="menuLink" href=".\">사업자정보</a>
            <a class="menuLink" href=".\">채용정보</a>
            <a class="menuLink" href=".\">주소</a>
            <a class="menuLink" href=".\">전화번호</a>
            <a class="menuLink" href=".\">이메일</a>
            <a class="menuLink" href=".\">고객센터</a>
          </div>
          <br>
          <!-- <div class="footer_board2"></div> -->
      </div>

  </body>
</html>






