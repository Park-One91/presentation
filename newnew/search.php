<?php
  //세션 데이터에 접근하기 위해 세션 시작
  session_start();
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Dimension by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
								<h1>search</h1>
								<div class="search">
									
										<div class="asd">
											<input type="text" id="searchInput" placeholder="영화를 찾아 보세요">&nbsp&nbsp
											<button id="searchButton">검색</button>
											<br>
											<br>
											<div id="searchResults"></div>
										</div>
									
								</div>
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
							<li><a href=".\search.php" onclick="event.preventDefault();">Search</a></li>
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
									<li><input type="button" onclick="location.href='search.php'" value="Back"/></li>
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

			<!-- JavaScript 및 jQuery, AJAX 라이브러리 연결 -->
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    	<script src="assets/js/script.js"></script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>

	<!-- <script type="text/javascript">
    function idCheck() {
		var id = document.getElementById('joinId').value;		
		location.href="id_check.php?id="+id;
    //alert(name);
    //document.getElementById('joinId').value = '';
    }
  </script> -->

</html>