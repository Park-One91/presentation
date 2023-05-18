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

<!DOCTYPE HTML>

<html>
	<head>
		<title>REVIEW MY CINEMA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- 날짜 선택 동작 -->
		<script>
				

				// 상세정보 미리 표시
				function result() {
						var url = "http://kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchDailyBoxOfficeList.xml?key=f5eef3421c602c6cb7ea224104795888";
								url = url + "&targetDt="+ $("#txtYear").val() +  $("#selMon").val() + $("#selDay").val();
								console.log(url);
								// ajax 통신
								$.ajax({
										type : "GET" , //요청방식
										url : url , //주소
										success :  function(data) {
												//출력변수
												var str = "";
												//집계가 안 됐을 경우
												if($(data).find("dailyBoxOffice").text()=="") {
														alert("집계가 완료되지 않았습니다");
														return;
												}
												$(data).find("dailyBoxOffice").each(function() {
														//링크 만들기
														str = str + "<a href='#detail' onclick='javascript:show("+$(this).find("movieCd").text()+")'>"
													
														//순위
														str = str + $(this).find("rank").text() + "위 (";
														//증감
														var rankInten = parseInt($(this).find("rankInten").text());
														if(rankInten > 0) str = str + "▲";
														else if(rankInten < 0) str = str + "▼";
														str = str + rankInten + ") : ";
														
														str = str + $(this).find("movieNm").text();
														str = str + "  <관객수 :  " + $(this).find("audiAcc").text() + " 명>" + "</a><br>";
												});
												//결과출력
												$("#msg").html(str);
										} ,//성공시
										error : function() {
												alert("값을 가지고 올 수 없습니다");
										} //실패시
								});
				}

				//상세정보
				function show(movieCd) {
						var url = "https://www.kobis.or.kr/kobisopenapi/webservice/rest/movie/searchMovieInfo.xml?key=f5eef3421c602c6cb7ea224104795888";
						url = url + "&movieCd=" + movieCd;
							//결과 위치
							$(".box3").text("");
						
						$.ajax({
							type : "GET" , 
							url : url , 
							success : function(data) {
									var str = "";
									str = str + "<h1>"+$(data).find("movieNm").text()+"</h1>";
									str = str + "<h2>"+$(data).find("movieNmEn").text()+"</h2>";
									str = str + "<p>상영시간 : "+$(data).find("showTm").text()+"분"+"</p>";
									str = str + "<ul>";
											$(data).find("actor").each(function() {
													str = str + "<li>"+$(this).find("peopleNm").text()+"</li>";
													console.log(str);
											});
											str = str + "</ul>";
											$(".box3").append(str);
							} ,
							error : function() {
									alert("자료를 가지고 올 수 없습니다");
							}
						});
					}

				$(document).ready(function() {
						
						// 어제 날짜가 기본으로 나오도록
						init();
						result();

						
				});
		</script>

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
								<h1>My Review List</span></h1>
								
								<br>

								<ul class="actions">
										<li><a href=".\ReviewBoard.php" class="button primary">전체 게시물</a></li>
										<li><a href="#" class="button">내가 쓴 글</a></li>
									</ul>

									<br>

								<section>
									<div class="table-wrapper">
										<table>
											
											<thead>
												<tr>
                          <th>No</th>
                          <th>Movie</th>
													<th>Title</th>
													<th>Writer</th>
													<th>Date</th>
													<th>Hit</th>
												</tr>
											</thead>
										
											<?php	
												$query = "select * FROM board ORDER BY idx desc LIMIT $start, $listSize";
												$result = $con->query($query);		
												while($row = $result->fetch_assoc())
												{
												?>   
													<tbody>
														<tr>                                
															<td><?=$row["idx"]?></td>
															<td><a href="#detail"><?=$row["movie"]?></a></td>
															<td><?=$row["title"]?></td>
															<td><?=$row["writer"]?></td>
															<td><?=$row["date"]?></td>
															<td><?=$row["hit"]?></td>
														</tr>
													</tbody>
											<?php
												}
												?>
            
										</table>
										
											<div id="sub1_2_divPaging">
												
													<div style="font-size:0.8em;color:#005b91; ">◀</div>
													
													<?php									
														for ($i = $startPage; $i <= $endPage; $i++) {
															$active = $page == $i ? "disabled" : "";
															echo "<div class='pagingbox'><a  ".$active."' href='./board.php?page=".$i."'>".$i."</a></div>";
														}
													?>
													
													<div style="font-size:0.8em; color:#005b91;">▶</div>
												
											</div>
										
									</div>

									<div >
                     	<button  class="btn_write" onclick="boardWrite()" type="button">리뷰작성</button></p>
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
							<a class="menuLink" href=".\logout.php">LogOut</a>
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
    
					</div>

					<br>
					<br>
					<br>
					<br>

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