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
      #msg {
              border-radius: 5px;
              border: 1px solid white;
              padding: 10px;
              padding-left: 20px;
              margin: 10px;
              width: 600px;
              height: 250px;
              font-size: 14px;
              text-align: left;
              float: left;
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
            $("#txtYear").val(newDate.getFullYear());
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
                            str = str + $(this).find("rank").text() + " 위    ";
														//제목
														str = str + $(this).find("movieNm").text();
                            //관객수
														str = str + "  <관객수 :  " + $(this).find("audiAcc").text() + " 명>    (";
														//증감
                            var rankInten = parseInt($(this).find("rankInten").text());
                            if(rankInten > 0) str = str + "▲";
                            else if(rankInten < 0) str = str + "▼";
                            str = str + rankInten + ")" + "</a><br>";
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

            //날짜 선택 후 확인버튼 클릭 시 동작
            $("#bt1").click(function(){
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
                            alert("해당 날짜의 집계가 완료되지 않았습니다");
                            return;
                        }
                        $(data).find("dailyBoxOffice").each(function() {
                            //링크 만들기
                            str = str + "<a href='#detail' onclick='javascript:show("+$(this).find("movieCd").text()+")'>"
                            //순위
                            str = str + $(this).find("rank").text() + " 위    ";
														//제목
														str = str + $(this).find("movieNm").text();
                            //관객수
														str = str + "  <관객수 :  " + $(this).find("audiAcc").text() + " 명>    (";
														//증감
                            var rankInten = parseInt($(this).find("rankInten").text());
                            if(rankInten > 0) str = str + "▲";
                            else if(rankInten < 0) str = str + "▼";
                            str = str + rankInten + ")" + "</a><br>";
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
								
								<br>
								<div class="field half">
									<select name="demo-category" id="demo-category">
										<option value="">일간</option>
										<option value="1">주간</option>
									</select>
								</div>
								<br>

								<section>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Rank</th>
													<th>Title</th>
													<th>Score</th>
													<th>U/D</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>100만</td>
													<td>0</td>
												</tr>
												<tr>
													<td>2</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>1000만</td>
													<td>▼-2</td>
												</tr>
												<tr>
													<td>3</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>2만</td>
													<td>0</td>
												</tr>
												<tr>
													<td>4</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>34만</td>
													<td>▲+2</td>
												</tr>
												<tr>
													<td>5</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>40만</td>
													<td>0</td>
												</tr>
												<tr>
													<td>6</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>7만</td>
													<td>▲+1</td>
												</tr>
												<tr>
													<td>7</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>52만</td>
													<td>▼-1</td>
												</tr>
												<tr>
													<td>8</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>43만</td>
													<td>0</td>
												</tr>
												<tr>
													<td>9</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>8만</td>
													<td>▼-1</td>
												</tr>
												<tr>
													<td>10</td>
													<td>제목제목제목제목제목제목제목</td>
													<td>20만</td>
													<td>0</td>
												</tr>
											</tbody>
											
										</table>
									</div>
								</section>
              
                <form name="myform">
                  <div class="box2">
                    <input type="text" name="txtYear" id="txtYear" size="6">년
                      <select id="selMon">
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
                      <select id="selDay">
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
	                  <input type="button" value="확인" id="bt1">
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
								<a href=".\Review.php">Review</a>
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>