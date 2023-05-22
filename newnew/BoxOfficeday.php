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

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- API 데이터 가져오기 -->
    <style>
        #msg {
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
        
        a {
            text-decoration: none;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- 날짜 선택 동작 -->
    <script>
        // 오늘날짜 표시
        function init() {
            var newDate = new Date();
            // 년도 미리 설정
            // $("#txtYear").val(newDate.getFullYear());
            // 연 미리 설정
            // var year = newDate.getYear()+1;
            // $("#selYear").val(year);
            // 월 미리 설정
            var mon = newDate.getMonth()+1;
            if(mon < 10) mon = "0"+mon;
            $("#selMon").val(mon);
            // 일 미리 설정
            var day = newDate.getDate()-1;
            if(day < 10) day = "0"+day;
            $("#selDay").val(day);
        }

        // 상세정보 미리 표시
        function result() {
            var url = "http://kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchDailyBoxOfficeList.xml?key=f5eef3421c602c6cb7ea224104795888";
                url = url + "&targetDt="+ $("#selYear").val() +  $("#selMon").val() + $("#selDay").val();
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
                            str = str + "  <관객수 :  " + $(this).find("audiAcc").text() + " 명>" + "</a><br><br>";
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
                  str = str + "장르 : " + $(data).find("genreNm").text()+"<br>";
                  str = str + "제작 : " + $(data).find("nations").text()+"<br>";
                  str = str + "제작사 : " + $(data).find("companyNm").text()+"<br>";
                  str = str + "제작년도 : " + $(data).find("prdtYear").text()+"<br>";
                  str = str + "등급 : " + $(data).find("watchGradeNm").text()+"<br>";
                  str = str + "런닝타임 : " + $(data).find("showTm").text()+"분"+"<br><br>";
                  str = str + "<p>감독 : " + $(data).find("directors").text()+"</p>";
                  str = str + "출연 : " + "<ul>";
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

            //날짜 선택 후 확인버튼 클릭 시 동작
            $("#bt1").click(function(){
                var url = "http://kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchDailyBoxOfficeList.xml?key=f5eef3421c602c6cb7ea224104795888";
                url = url + "&targetDt="+ $("#selYear").val() +  $("#selMon").val() + $("#selDay").val();
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
                            alert("해당 날짜의 집계가 완료되지 않았습니다");
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
                            str = str + "  <관객수 :  " + $(this).find("audiAcc").text() + " 명>" + "</a><br><br>";
                        });
                        //결과출력
                        $("#msg").html(str);
                    } ,//성공시
                    error : function() {
                        alert("값을 가지고 올 수 없습니다");
                    } //실패시
                });
            });
        });
    </script>
<!-- API 데이터 가져오기 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

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
							<h1>Box Office <span style="color: #f77777;">a Day</span></h1>

                            <ul class="actions">
								<li><a href=".\BoxOfficeday.php" onclick="event.preventDefault();" class="button primary">일간</a></li>
								<li><a href=".\BoxOfficeweek.php" class="button">주간</a></li>
							</ul>
                            <p id="text">🎞날짜를 선택하여 해당 날짜의 박스오프스 순위를 확인하세요🎞</p>

                    <form name="myform">
                        <div class="field">
                            
                            <select class="sel1" id="selYear">
                                <option value="2023">2023년</option>
                                <option value="2022">2022년</option>
                                <option value="2021">2021년</option>
                                <option value="2020">2020년</option>
                                <option value="2019">2019년</option>
                                <option value="2018">2018년</option>
                                <option value="2017">2017년</option>
                                <option value="2016">2016년</option>
                                <option value="2015">2015년</option>
                                <option value="2014">2014년</option>
                                <option value="2013">2013년</option>
                                <option value="2012">2012년</option>
                                <option value="2011">2011년</option>
                                <option value="2010">2010년</option>
                                <option value="2009">2009년</option>
                                <option value="2008">2008년</option>
                                <option value="2007">2007년</option>
                                <option value="2006">2006년</option>
                                <option value="2005">2005년</option>
                                <option value="2004">2004년</option>
                            </select> 
                            
                            <select class="sel2" id="selMon">
                                <option value="01">1월</option>
                                <option value="02">2월</option>
                                <option value="03">3월</option>
                                <option value="04">4월</option>
                                <option value="05">5월</option>
                                <option value="06">6월</option>
                                <option value="07">7월</option>
                                <option value="08">8월</option>
                                <option value="09">9월</option>
                                <option value="10">10월</option>
                                <option value="11">11월</option>
                                <option value="12">12월</option>
                            </select>
                            
                            <select class="sel2" id="selDay">
                                <option value="01">1일</option>
                                <option value="02">2일</option>
                                <option value="03">3일</option>
                                <option value="04">4일</option>
                                <option value="05">5일</option>
                                <option value="06">6일</option>
                                <option value="07">7일</option>
                                <option value="08">8일</option>
                                <option value="09">9일</option>
                                <option value="10">10일</option>
                                <option value="11">11일</option>
                                <option value="12">12일</option>
                                <option value="13">13일</option>
                                <option value="14">14일</option>
                                <option value="15">15일</option>
                                <option value="16">16일</option>
                                <option value="17">17일</option>
                                <option value="18">18일</option>
                                <option value="19">19일</option>
                                <option value="20">20일</option>
                                <option value="21">21일</option>
                                <option value="22">22일</option>
                                <option value="23">23일</option>
                                <option value="24">24일</option>
                                <option value="25">25일</option>
                                <option value="26">26일</option>
                                <option value="27">27일</option>
                                <option value="28">28일</option>
                                <option value="29">29일</option>
                                <option value="30">30일</option>
                                <option value="31">31일</option>
                            </select>
											
                            <input type="button" class="sel1" value="확인" id="bt1">
                            </div>
                    <div id="msg"></div>
                <div class="cardClear"></div>
            </form>
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
								<a href=".\BoxOfficeday.php" onclick="event.preventDefault();">BoxOffice</a>
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
								<li><input type="button" onclick="location.href='BoxOfficeday.php'" value="Back"/></li>
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

	</body>
</html>