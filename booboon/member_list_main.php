<?php
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
} else {
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



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>회원목록</title>

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
            #title {
                text-align: center;
            }
            img {
                width:350px;
                height:350px;
                margin:auto;
                display:block;
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
                color:#4f4f4f;
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
            #menu {
                height: 40px;
                width: auto;
                margin-left: 16px;
                margin-right: auto;
            }
            #menu ul li {
                list-style: none;
                color: #4F4F4F;
                background-color: #ece6d4;
                float: left;
                display:inline-block;zoom:1;.display:inline;
                line-height: 35px;
                vertical-align: middle;
                text-align: center;
            }
            #menu ul li:hover {
                text-decoration: none;
                color: #4F4F4F;
                border-bottom: 1px solid #4F4F4F;
                display: block;
                width: 100pxs;
                font-size: 13px;
                font-weight: bolder;
                font-family: verdana;
                outline: 0;
            }
            #menu .menuLink {
                text-decoration: none;
                color: #4F4F4F;
                display: block;
                width: 100px;
                font-size: 13px;
                font-weight: bold;
                font-family: verdana;
            } 
            #menu2 ul li {
                list-style: none;
                color: #ff0000;
                background-color: #a88859;
                float: left;
                line-height: 15px;
                vertical-align: middle;
                text-align: center;
            }
            #menu2 .menuList {
                text-decoration: none;
                color: #000000;
                display: block;
                width: 135px;
                font-size: 20px;
                font-weight: bold;
                margin-left: 110px;
                font-family: verdana;
                
            } 
            #menu2 .listItem {
                text-decoration: none;
                color: #ff0000;
                display: block;
                width: 135px;
                font-size: 15px;
                font-weight: bold;
                font-family: verdana;
                display: table-cell;
                vertical-align: middle;
            } 
            #menu3 ul li {
                list-style: none;
                color: #4F4F4F;
                background-color: #ece6d4;
                float: left;
                line-height: 35px;
                vertical-align: middle;
                margin-left: 110px;
                text-align: center;
            }
            #menu3 .menuList {
                text-decoration: none;
                color: #4F4F4F;
                display: block;
                width: 135px;
                font-size: 12px;
                font-weight: bold;
                margin-left: 200px;
                font-family: verdana;
            } 
            #menu3 .listItem {
                text-decoration: none;
                color: #4F4F4F;
                display: block;
                width: 135px;
                font-size: 12px;
                font-weight: bold;
                font-family: verdana;
                display: table-cell;
                margin-left: 200px;
                vertical-align: middle;
            } 
        </style>

    </head>

    <body bgcolor = '#ece6d4'>

        <h2><p id="title">&nbsp&nbsp◀회원관리 사이트▶</p></h2>

        <center>

            <div id="menu">
                <ul>
                <li><a class="menuLink" href=".\index.html">Home</a></li>
                <li><a class="menuLink" href=".\login.php">로그인</a></li>
                <li><a class="menuLink" href=".\member_list.php">회원목록</a></li>
                <li><a class="menuLink" href=".\member_info.php">회원수정</a></li>
                <li><a class="menuLink" href=".\join.php">회원가입</a></li>
                <li><a class="menuLink" href="#">기타</a></li>
                </ul>
            </div>

        </center>

        <h1><p>회원목록 페이지</p></h1>

        <img src="img/list-unscreen.gif" lt="이미지" ></img>

            

        <center>    
            <span>

                <span id="menu2">

                    <ul>

                        <br>
                        <br>
                        <li><p class="menuList">순번</p></li>
                        <li><p class="menuList">아이디</p></li>
                        <li><p class="menuList">이름</p></li>
                        <li><p class="menuList">연락처</p></li>
                        <li><p class="menuList">이메일</p></li>
                        <li><p class="menuList">　　　</p></li>
                        <li><p class="menuList">　　</p></li>
                        <br>

                    </ul>

                </span>

                <br>
                <br>
                <br>
                <br>

                <?php	
						$query = "select * FROM member ORDER BY idx desc LIMIT $start, $listSize";
						$result = $con->query($query);		
						while($row = $result->fetch_assoc())
						{
						?>   
                        <span>
                           <span>
                                <span><?=$row["idx"]?></span>
                                <span ><?=$row["id"]?></span>                               
                                <span><?=$row["name"]?></span>
                                <span><?=$row["hp"]?></span>
								<span><?=$row["email"]?></span>
                            </span>
                        </span>

                            
                            <script type="text/javascript">
                                function edit() {
                                location.href="member_info.php?";
                                }
                            </script>

                        <?php
						}
						?>

            </span>

            <br>
            <br>
            <br>
            <br>

            <span>
					  <span id="sub1_2_divPaging">
							
								<span style="font-size:0.8em;color:#005b91; ">◀</span>
                                <?php									
									for ($i = $startPage; $i <= $endPage; $i++) {
										$active = $page == $i ? "disabled" : "";
										echo "<div class='pagingbox'><a  ".$active."' href='./member_list.php?page=".$i."'>".$i."</a></div>";
									}

									
								?>
                                <span style="font-size:0.8em; color:#005b91;">▶</span>
							
						</span>
                </span>

            <br>
            <br>
            <br>
            <br>
            <br>

        </center>

    </body>

</html>