<?php

    //세션 데이터에 접근하기 위해 세션 시작
    if (!session_id()) {
        session_start();
    }
  
    $con = mysqli_connect("localhost", "root", "qwer", "php_db");
    mysqli_query($con,'SET NAMES utf8');	

    $page = (isset($_GET["page"]) && $_GET["page"]) ? $_GET["page"] : 1;

    if (empty($page)) { $page = 1; }

    $select_query = "select COUNT(*) as size FROM member";        
    $result = mysqli_query($con, $select_query); 
    $row = mysqli_fetch_array($result);
    $nums = $row['size'];

    //화면에 목록 줄수
    $listSize = 5;

    //페이지 표시 최대 숫자
    $blockSize = 5; // 추가 !!
    $prevBlock="";
    $nextBlock="";
    $start = ($page - 1) * $listSize;

    $totalListCount = ceil($nums/ $listSize); // 추가해주기

    $no = $nums - $start; // 추가

    $totalBlockCount = ceil($totalListCount/$blockSize);
    $currentBlock = ceil($page / $blockSize);

    $startPage = ($currentBlock - 1) * $blockSize + 1;

    if ($currentBlock >= $totalBlockCount) {
        $endPage = $totalListCount;
    } 
    
    else {
        $endPage = $currentBlock * $blockSize;
    }

    if ($currentBlock > 1) {
        $prevBlock = "
            <a class='page-link' href='./member_list.php?page=".($startPage - 1)."' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
            </a>";
    }

    if ($currentBlock < $totalBlockCount) {
        $nextBlock = "
            <a class='page-link' href='./member_list.php?page=".($endPage + 1)."' aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
            </a>";
    }

?>

<!DOCTYPE html>

<html lang="ko">

  <head>
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 
    <title>회원관리 사이트</title>

    <style>
        p {
        text-align: center;
      }
      #btn {
        width:100px;
        margin:auto;
        display:block;
      }
      img {
        width:400px;
        height:400px;
        margin:auto;
        display:block;
      }
      #title {
        text-align: center;
        list-style-type: none;
      }
      #menu {
        height: 40px; 
        width: auto; 
        list-style-type: none;
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
        height:auto;
        font-size: 13px;
        font-weight: bold;
        font-family: verdana;
      }

    </style>
    
  </head>

  <body bgcolor = '#ece6d4'>

    <h2><p id="title">◀ 회원관리 사이트 ▶</p></h2>

        <center>
          <div id="menu">
            <ul>
              <li><a class="menuLink" href=".\index-afterlogin.php">Home</a></li>
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

        <div>
        <h1><p>&nbspMEMBER LIST</p></h1>
        <img src="img/license-unscreen.gif" lt="이미지" ></img>
        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">	
        <!-- Custom styles for this template -->	
        <!-- <link href="css/reset_responsive.css" rel="stylesheet">     -->
        <link href="css/style.css" rel="stylesheet">
        <!--   -->
            <!-- 회원목록-->
            <div class="">
                <div class=>
                    <div id="">
                    <div class="member_list_section">
                        <span>
                            <!-- 회원목록  -->
                            <div>
                                <ul id ="member_list_table">
                                    <li>
                                        <ul>
                                            <li>번호</li>
                                            <li>아이디</li>
                                            <li>이름</li>
                                            <li>연락처</li>
                                            <li>이메일</li>
                                        </ul>
                                    </li>
                                    <!-- 회원 정보 반복 출력구간 -->
                                    <?php	
                                    $query = "select * FROM member ORDER BY idx desc LIMIT $start, $listSize";
                                    $result = $con->query($query);		
                                    while($row = $result->fetch_assoc())
                                    {
                                    ?>   
                                    <li>
                                      <ul>
                                        <li><?=$row["idx"]?></li>
                                        <li ><?=$row["id"]?></li>                               
                                        <li><?=$row["name"]?></li>
                                        <li><?=$row["hp"]?></li>
                                        <li><?=$row["email"]?></li>
                                      </ul>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                               
                            
                            <!-- 게시판 페이징 영역 -->
                                <div>
                                    <div id="sub1_2_divPaging">
                                      <div style="font-size:0.8em;color:#32ccca; ">◀</div>
                                      <?php									
                                        for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active = $page == $i ? "disabled" : "";
                                        echo "<div class='pagingbox'>
                                        <a  ".$active."' href='./member_list.php?page=".$i."'>".$i."</a>
                                        </div>";
                                        }
                                       ?>
                                      <div style="font-size:0.8em; color:#32ccca;">▶</div>
                                </div>
                              </div>
                        </span>
                    </div>
                </div>
                <!-- 게시판영역 종료-->
                </div>
            </div>
    </div>
  </body>
</html>
