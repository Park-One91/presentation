<?php
    $con = mysqli_connect("localhost", "pdy1201", "AA1205dnflwlq!!", "pdy1201");
		// $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
	
  <body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- 로그인시 아이디와 이름을 표시해줌 -->
				<?php
        if($_SESSION['login_check']==true)
        {
        ?>				
					<div class="logInfo">
						<pre><code>ID&nbsp:&nbsp<span style="color: #f77777;"><?php echo $_SESSION["id"]?></span>&nbsp&nbsp&nbsp Name&nbsp:&nbsp<span style="color: #f77777;"><?php echo $_SESSION["name"]?></span></code></pre>
					</div>
        <?php                 
        }
        ?>

				<!-- Header -->
					<header id="header">
						<div class="">
							<span class="fa-solid fa-clapperboard fa-8x"></span> 
							<script src="https://kit.fontawesome.com/96a0c5a751.js" crossorigin="anonymous"></script>
						</div>
						<div class="content">
							<div class="inner">
								<h1>My Review</span></h1>
								
								<ul class="actions">
										<li><a href=".\ReviewBoard_top.php" class="button2">TOP 5</a></li>
										<li><a href=".\ReviewBoard.php" class="button2">All</a></li>		
										<li><a href="#" onclick="event.preventDefault();" class="button primary2">MY</a></li>
										<li><button  class="button small2" onclick="boardWrite()" type="button">Make Review</button></li>
								</ul>
								
								<section>
									<div class="table-wrapper">
										<table>
											
											<thead>
												<tr>
                          <th>No</th>
                          <th>Title</th>
													<th>Writer</th>
													<th>Hit</th>
												</tr>
											</thead>
										
											<?php	
												$query = "select * FROM board ORDER BY idx desc LIMIT $start, $listSize";
												$result = $con->query($query);		
												while($row = $result->fetch_assoc()) {
													// writer 값이 현재 세션의 값과 같은 경우에만 데이터를 표시
													if ($row["writer"] == $_SESSION['name']) {
												?>
													<tbody>
														<tr>                                
															<td><?= $row["idx"] ?></td>
															<td><a href="#detail"><?= $row["movie"] ?></a></td>
															<td><a href=".\ReviewShow.php?idx=<?= $row["idx"] ?>"><?= $row["title"] ?></a></td>
															<td><?= $row["writer"] ?></td>
															<td><?= $row["date"] ?></td>
															<td><?= $row["hit"] ?></td>
														</tr>
													</tbody>
												<?php
													}
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
                                        <a  ".$active."' href='./ReviewBoard.php?page=".$i."'>".$i."</a>
                                        </div>";
                                        }
                                       ?>
                                      <div style="font-size:0.8em;">▷</div>
                                		</div>
													
											</div>
											
									</div>

								</section>
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
								<a href=".\ReviewBoard.php" onclick="event.preventDefault();">Review</a>
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

          <!-- detail -->
							<article id="detail">
								<h2 class="major">detail</h2>
								<span class="image main"><img src="images/pic01.jpg" alt="" /></span>
								<div class="box3"></div>
							</article>

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
										<li><input type="button" onclick="location.href='ReviewBoard.php'" value="Back"/></li>
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
			<script type="text/javascript">
    		function boardWrite() {		
					location.href="ReviewWrite.php";    
    		}  
  		</script>
			
	</body>
</html>