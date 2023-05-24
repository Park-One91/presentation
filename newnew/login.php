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
						<div class="">
							<span class="fa-solid fa-clapperboard fa-8x"></span> 
							<script src="https://kit.fontawesome.com/96a0c5a751.js" crossorigin="anonymous"></script>
						</div>
						<div class="content">
							<div class="inner">
							
							<form method="POST" action="login_result.php">
								<h1>Login</h1>
									<p>please enter your information <span style="color: #f77777;">Correctely<span><br/>
										<br>
										<div class="field half">
											<input type="text" name="id" id="demo-name" value="" placeholder="ID" /><br>
											<input type="password" name="pw" id="demo-name" value="" placeholder="PW" />
										</div>
										<br>
										<ul class="actions2">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
											<li><input id="btn" type="submit" name="demo-name" id="demo-name" value="Login"></li>
											<!-- <li><input id="btn" type="button" onclick="location.href='join.php'" value=" Join"></li> -->
											<li><a href=".\join.php" class="button"> &nbspJoin&nbsp </a></li>
										</ul>
									</p>
								</form>
								
								</div>
						</div>
						<nav>
							<ul>
								<li><a href=".\index.html">Home</a></li>
								<li><a href="#contact">Contact</a></li>
								<li><a href=".\login.php" onclick="event.preventDefault();">Login</a></li>
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
				function join() {
				location.href="join.php";
				}
			</script>

	</body>
</html>
