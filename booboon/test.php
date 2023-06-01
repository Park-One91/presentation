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
<html>
  <head>
    <meta charset="UTF-8">
    <title>게시판 목록</title>
    
  </head>
  <body>
    <!-- 게시판-->
<div class="">
	<div class="container">
		 <div id="">
          <div class="board_list_section">
            <ul style="list-style: none;">
                <!-- 게시목록  -->
                <li style="list-style: none;">
                    <ul id ="board_list_table;" style="list-style: none;">
                        <li style="list-style: none;">
                            <ul style="list-style: none;">
                                <li style="list-style: none;">번호</li>
                                <li style="list-style: none;">제목</li>
                                <li style="list-style: none;">작성일</li>
                                <li style="list-style: none;">조회수</li>								
                            </ul>
                        </li>
                        <!-- 게시 정보 반복 출력구간 -->
						<?php	
						$query = "select * FROM board ORDER BY idx desc LIMIT $start, $listSize";
						$result = $con->query($query);		
						while($row = $result->fetch_assoc())
						{
						?>   
                        <li style="list-style: none;">
                           <ul style="list-style: none;">                                
                                <li style="list-style: none;"><?=$row["idx"]?></li>                                                                                                   
                                <li style="list-style: none;"><a href="board_detail.php?idx=<?php echo $row['idx']?>"> <?=$row["title"]?></a></li>                                                                  
                                <li style="list-style: none;"><?=$row["reg_date"]?></li>
                                <li style="list-style: none;"><?=$row["hit"]?></li>	
                                
                            </ul>
                        </li>
                        <?php
						}
						?>
                    </ul>
                </li>
                
  </body>
</html>








