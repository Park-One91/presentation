<?php
 $con = mysqli_connect("localhost", "pdy1201", "AA1205dnflwlq!!", "pdy1201");
//  $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
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
	$writer= $row['writer'];
	$title= $row['title'];
	$content= $row['content'];
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>REVIEW MY CINEMA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
								<h1>Review</h1>
								<br>
								<br>
								<article id="contact">
								
										<div class="fields">
											
										<!-- 작성자 이름과 제목 -->
											<div class="field quarter">
												<pre><code><?=$title?><br>- <?=$writer?> -</code></pre>
											</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
											
											<!-- 별점 레이아웃 - 첫번째 별점은 항상 표시되게 on으로 -->
											<div class="starRev">
												<span class="starR on">★</span>
												<span class="starR">★</span>
												<span class="starR">★</span>
												<span class="starR">★</span>
												<span class="starR">★</span>
											</div>
											<br>
											<div class="field">
											<pre><code><?=$content?></code></pre>
											</div>

										<!-- 수정 삭제 버튼 :세션 이용해서 내가 쓴 글일 경우에만 보이기 -->
										<div class="btn_edit_body">
											<div class="btn_edit">
												<?php
												if($_SESSION['name']==$row["writer"])
												{
												?>				
												<button type="button" class="btn_edit gray" onclick="location.href='/newnew/ReviewEdit.php?idx=<?=$idx?>'; return false;"> edit</button> 
												<?php                 
												}
												?>
												<?php
												if($_SESSION['name']==$row["writer"])
												{
												?>				
												<button type="button" class="btn_edit gray" onclick="location.href='/newnew/ReviewDel_result.php?idx=<?=$idx?>'; return false;"> delete</button>  
												<?php                 
												}
												?>
											</div>
										</div>

									</div>
			</div>
								
								<!-- 댓글이 보여지는 영역 -->
								<div class="field" id="comment-container">
								</div>

								<form id="comment-form">
									<input type="text" id="name" placeholder="이름" required>
									<textarea id="content" placeholder="댓글 내용" required></textarea>
									<button type="submit">댓글 작성</button>
								</form>
								
								<!-- 뒤로가기 버튼 -->
								<div>
									<button type="button" class="primary" onclick="location.href='/newnew/ReviewBoard.php';"> back</button>	<br>
								</div>
								<br>
								
						</div>
						</article>

						<!-- 하단 메뉴버튼 영역 -->
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
			<script src="comment.js"></script>

	</body>
</html>