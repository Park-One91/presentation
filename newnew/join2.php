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
								<h1>join</h1>
							
								<form method="POST" action="join_result.php">
									<p style="color:#f77777;">- ( ㆍ )표시는 필수 입력사항 입니다 -</p>
									<font style="color:#9cdcfe;" size="1.5">＊6~15자의 영문 소문자, 숫자만 가능합니다</font>
									<div class="field id">
										<input type="text" name="id" id="joinId" placeholder=" ㆍ ID" value=""/>
										<input type="button" onclick="idCheck()" value="중복체크"/>
									</div><br><br>
									<!-- <div class="field check">
										
									</div><br> -->

									<font style="color:#9cdcfe;" size="1.5">＊영문자, 숫자, 특수문자의 조합, 8자리 이상으로 이루어져야 합니다</font>
									<div class="field">
										<input type="password" name="pw" id="pw" placeholder=" ㆍ PW"/>
									</div><br>
									<font style="color:#9cdcfe;" size="1.5">＊비밀번호를 한번 더 입력해 주세요</font>
									<div class="field">
										<input type="password" name="pw_r" id="pw_r" placeholder=" ㆍ PW Check"/>
									</div><br>
									<div class="field quarter">
										<input type="text" name="name" id="name" placeholder=" ㆍ Name"/>
									</div><br>
									<div class="field">
										<input type="text" name="hp" id="hp" placeholder=" ㆍ HP"/>
									</div><br>
									<div class="field">
										<input type="text" name="email" id="email" placeholder="E-Mail"/>
									</div><br>

									<input id="btn" type="submit" value="JOIN"><br/>
								</form>
								
							</div>
						</div>
						<nav>
							<ul>
								<li><a href=".\index.html">Home</a></li>
								<li><a href="#contact">Contact Us</a></li>
								<li><a href=".\login.php">Login</a></li>
							</ul>
						</nav>
					</header>

					<!-- Main -->
					<div id="main">

						<!-- Contact -->
							<article id="contact">
								<h2 class="major">Contact</h2>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" />
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="message" rows="4"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</form>
								<ul class="icons">
									<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
								</ul>
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
				function idCheck() {
				var id = document.getElementById('joinId').value;		
				location.href="join_id_check.php?id="+id;
				//alert(name);
				//document.getElementById('joinId').value = '';
				}
			</script>

	</body>
</html>