<?php
    $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
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

<!DOCTYPE HTML>

<html>
	<head>
		<title>REVIEW MY CINEMA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
        #msg1 {
					border-radius: 5px;
              border: 1px solid white;
              padding: 10px;
              margin-top: 20px;
              margin-bottom: 20px;
              width: 100%;
              height: 100%;
              font-size: 14px;
              text-align: left;
              float: right;
              font-size : 100%;
        }
    </style>
	</head>

	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-gem"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Review</h1>
								<br>
								<br>
								<article id="contact">
								<form action="ReviewWrite_result.php" enctype="multipart/form-data" method="post">
										<div class="fields">
											
											<div class="field quarter">
												<input type="text" name="writer" id="writer" value="<?php echo $_SESSION["name"]?>"/>
											</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
											<div class="starRev">
												<!-- 편의 상 가장 첫번째의 별은 기본으로 class="on"이 되게 설정해주었습니다. -->
												<span class="starR on">★</span>
												<span class="starR">★</span>
												<span class="starR">★</span>
												<span class="starR">★</span>
												<span class="starR">★</span>
											</div>
											<div class="field">
												<input type="text" name="title" id="title" placeholder="Title"/>
											</div>
											<div class="field">
												<textarea name="content" id="content" rows="8" placeholder="Contents"></textarea>
											</div>

											<section>
												<div class="table-wrapper">
													<table>
														<thead>
															<tr>
		                          <th></th>
															<th></th>
															<th></th>
															<th></th>
														</tr>
											</thead>
										
											<?php	
												$query = "select * FROM comment ORDER BY idx desc LIMIT $start, $listSize";
												$result = $con->query($query);		
												while($row = $result->fetch_assoc())
												{
												?>   
													<tbody>
														<tr>                                
															<td><?=$row["idx"]?></td>
															<td><?=$row["name"]?></td>
															<td><?=$row["comment"]?></td>
															<td><?=$row["date"]?></td>
														</tr>
													</tbody>
											<?php
												}
												?>
            
										</table>


										
										
										
											<div>

											
											<div>
                                    <div id="sub1_2_divPaging1">
                                      <div style="font-size:0.8em;">◁</div>
                                      <?php									
                                        for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active = $page == $i ? "disabled" : "";
                                        echo "<div class='pagingbox'>
                                        <a  ".$active."' href='./ReviewShow.php?page=".$i."'>".$i."</a>
                                        </div>";
                                        }
                                       ?>
                                      <div style="font-size:0.8em;">▷</div>
                                </div>
											
													
											</div>
											
													
									</div>

									<br>

									<div class="asd1">
												<input type="text" id="searchInput" placeholder="댓글을 입력하세요">&nbsp&nbsp
												<button id="searchButton">Comment</button>
												<br>
												<br>
												<div id="searchResults"></div>
										</div>
													

								</section>
											
										</div>
										<ul class="actions">
											<li><input type="submit" value="back" class="primary" /></li>
										</ul>
									</form>
								</article>
							</div>
						</div>
							
						<nav>
							<ul>
								<!-- 메뉴 홈 버튼 세션  -->
								<li><?php
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
						 ?></li>
							
							<!-- 메뉴 박스오피스 버튼 세션  -->
							<?php
								if($_SESSION['login_check']==true)
								{
							?>				
							<li class="nav-item">
								<a href=".\BoxOfficeday.php">BoxOffice</a>
							</li>
							<?php                 
								}
							?>

							<!-- 메뉴 리뷰버튼 세션 -->
							<?php
								if($_SESSION['login_check']==true)
								{
							?>				
							<li class="nav-item">
								<a href=".\ReviewBoard.php">Review</a>
							</li>
							<?php                 
								}
							?>

							<!-- 메뉴 검색버튼 세션 -->
							<?php
								if($_SESSION['login_check']==true)
								{
							?>				
							<li class="nav-item">
							<li><a href=".\search.php">Search</a></li>
							</li>
							<?php                 
								}
							?>

							<!-- 메뉴 문의버튼 세션 -->
							<?php
								if($_SESSION['login_check']==false)
								{
							?>				
							<li class="nav-item">
								<li><a href="#contact">Contact us</a></li>
							</li>
							<?php                 
								}
							?>

							<!-- 메뉴 로그인 로그아웃 버튼 세션 -->
							<li><?php
								if($_SESSION['login_check']==true)
								{
							?>				
							<a class="menuLink" href="#logout">LogOut</a>
							<?php                 
								}else
								{
							?>
							<a class="menuLink" href=".\login.php">LogIn</a>
							<?php                 
								}
						 ?></li>
							</ul>
						</nav>
					</header>

					<!-- Main -->
					<div id="main">

          <!-- Log out -->
						<article id="logout">
								<h2 class="major">Log Out</h2>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="email">로그아웃 하시겠습니까?</label>
										</div>
									</div>
									<ul class="actions">
										<li><input type="button" onclick="location.href='logout.php'" value="Log Out" class="primary" /></li>
										<li><input type="button" onclick="location.href='ReviewWrite.php'" value="Back"/></li>
									</ul>
								</form>
							</article>

						</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Made By P.D.Y</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/star.js"></script>

	</body>
</html>