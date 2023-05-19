<?php
  //세션 데이터에 접근하기 위해 세션 시작
  session_start();
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
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

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-gem"></span>
						</div>
						<div class="content">
							<div class="inner">
								<!-- <img src="images/up.png" alt=""> -->
								<h1><span style="color: #f77777;">r</span>eview <span style="color: #f77777;">m</span>y <span style="color: #f77777;">c</span>inema</h1><br/>
								<!-- <img src="images/bo.png" alt=""> -->
								<p>Our contents are based on the <sup>영화진흥위원회</sup></a><br/>
									Use this <a href="http://me.go.kr/home/web/main.do"target='_blank'><sup>Link</sup></a>, Check More Information</p>
								</div>
						</div>
						<nav>
							<ul>
								<li><a href="index-afterlogin.php" onclick="event.preventDefault();">Home</a></li>
							
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
										<li><input type="button" onclick="location.href='index-afterlogin.php'" value="Back"/></li>
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
				function move() {
				location.href="logout.php";
				}
			</script>

			<script type="text/javascript">
				function back() {
				
				}
			</script>

	</body>
</html>


