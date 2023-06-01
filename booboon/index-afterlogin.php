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
            <a class="menuLink" href=".\index-afterlogin.php">Home</a>  
            <a class="menuLink" href=".\goude.php">가이드</a>
            <a class="menuLink" href=".\board.php">게시판</a>
            <a class="menuLink" href=".\join.php">회원가입</a>
            <a class="menuLink" href=".\logout.php">로그아웃</a>
            <a class="menuLink" href=".\my.php">내 정보</a>
          </div>

          <!-- 사이드 컨텐츠 -->
          <div class="side">
            
            <!-- 사이드 상단 묶음 -->
            <div class="content1_3">

              <div class="content_logo_text2">
                <a href=".\">MENU</MENU></a>
              </div>

              <!-- 사이드 상단 항목 -->
              <div class="content_logo">
                <a href=".\guide.php">
                  <img id="logo" src="img/confusion-unscreen.gif" lt="이미지" ></img>
                </a>
                <div class="content_logo_text">
                  <a href=".\guide.php">분리수거</a>
                </div>
              </div>
              
              <div class="content_logo">
                <a href=".\trash.php">
                  <img id="logo" src="img/trashcan-unscreen.gif" lt="이미지" ></img>
                </a>
                <div class="content_logo_text">
                  <a href=".\guide.php">일반쓰레기</a>
                </div>
              </div>

              <div class="content_logo">
                <a href=".\food.php">
                  <img id="logo" src="img/fishbone-unscreen.gif" lt="이미지" ></img>
                </a>
                <div class="content_logo_text">
                  <a href=".\guide.php">음식물쓰레기</a>
                </div>
              </div>

              <div class="content_logo">
                <a href=".\recycle.php">
                  <img id="logo" src="img/recycling-unscreen.gif" lt="이미지" ></img>
                </a>
                <div class="content_logo_text">
                  <a href=".\guide.php">재활용쓰레기</a>
                </div>
              </div>

              <div class="content_logo">
                <a href=".\big.php">
                  <img id="logo" src="img/big-unscreen.gif" lt="이미지" ></img>
                </a>
                <div class="content_logo_text">
                  <a href=".\guide.php">대형폐기물</a>
                </div>
              </div>

            </div>

            <!-- 사이드 하단 -->
            <div class="content1_4">

              <div class="content1_4_1">
                정보공유 게시판 최신글
              </div>

                <!-- 항목 -->
                <div class="content1_5">
                <?php
                        $query = "select * FROM board ORDER BY idx desc LIMIT $start, $listSize";
                        $result = $con->query($query);		
                        while($row = $result->fetch_assoc()){
                      ?>
                        <li  style="list-style: none;">
                          <ul id ="board_list_table">
                            <ul style="list-style: none;">
                              <li style="list-style: none;"><a href="board_detail.php?idx=<?php echo $row['idx']?>"> <?=$row["idx"]?></a></li>
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
                
              
            </div>
          </div>

          <!-- 컨텐츠 1 -->
          <div class="content1">
            <div class="content1_1">
              content1-1
            </div>
            <div class="content1_1">
              content1-1
            </div>
            <div class="content1_1">
              content1-1
            </div>
            <div class="content1_2">
              content1-2
            </div>
            <div class="content1_2">
              content1-2
            </div>
            <div class="content1_2">
              content1-2
            </div>
            <div class="content1_1">
              content1-1
            </div>
            <div class="content1_1">
              content1-1
            </div>
            <div class="content1_1">
              content1-1
            </div>
            <div class="content1_2">
              content1-2
            </div>
            <div class="content1_2">
              content1-2
            </div>
            <div class="content1_2">
              content1-2
            </div>
          </div>
          
          <!-- 컨텐츠 2 -->
          <div class="content2">content2</div>
            
          <!-- footer -->
          <div class="footer1">
            <a class="menuLink" href=".\">사업자정보</a>
            <a class="menuLink" href=".\">채용정보</a>
            <a class="menuLink" href=".\">주소</a>
            <a class="menuLink" href=".\">전화번호</a>
            <a class="menuLink" href=".\">이메일</a>
            <a class="menuLink" href=".\">고객센터</a>
          </div>
          <br>
          <div class="footer2"></div>
      </div>
  </body>
</html>




