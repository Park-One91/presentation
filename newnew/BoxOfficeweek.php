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
              margin: 10px;
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
            $("#txtYear").val(newDate.getFullYear());
            // 월 미리 설정
            var mon = newDate.getMonth()+1;
            if(mon < 10) mon = "0"+mon;
            $("#selMon").val(mon);
            // 일 미리 설정
            var day = newDate.getDate()-7;
            if(day < 10) day = "0"+day;
            $("#selDay").val(day);
        }

        // 상세정보 미리 표시
        function result() {
            var url = "https://kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchWeeklyBoxOfficeList.xml?key=f5eef3421c602c6cb7ea224104795888";
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
                        if($(data).find("weeklyBoxOffice").text()=="") {
                            alert("집계가 완료되지 않았습니다");
                            return;
                        }
                        $(data).find("weeklyBoxOffice").each(function() {
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

            //날짜 선택 후 확인버튼 클릭 시 동작
            $("#bt1").click(function(){
                var url = "https://kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchWeeklyBoxOfficeList.xml?key=f5eef3421c602c6cb7ea224104795888";
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
                        if($(data).find("weeklyBoxOffice").text()=="") {
                            alert("해당 날짜의 집계가 완료되지 않았습니다");
                            return;
                        }
                        $(data).find("weeklyBoxOffice").each(function() {
                             //주차
                             str = str + $(this).find("yearWeekTime").text() + "";
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
							<h1>Box Office <span style="color: #f77777;">a Week</span></h1>
								
							<ul class="actions">
								<li><a href=".\BoxOfficeday.php" class="button primary">일간</a></li>
								<li><a href=".\BoxOfficeweek.php" onclick="event.preventDefault();"" class="button">주간</a></li>
							</ul>
              
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
            <div id="msg"></div><br>
            <div class="cardClear"></div><br>
        </form>
                
							</div>
						</div>
						<nav>
							<ul>
								<li><a href=".\index-afterlogin.php">Home</a></li>
								<li><a href=".\BoxOfficeday.php">BoxOffice</a></li>
								<li><a href=".\ReviewBoard.php">Review</a></li>
								<li><?php
									if($_SESSION['login_check']==true)
									{
									?>				
									<a href=".\search.php">Search</a>
									<?php                 
									}else
									{
									?>
									<?php                 
									}
									?></li>
								<li><a href=".\logout.php">Logout</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
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

						<!-- Guide -->
							<article id="Guide">
								<h2 class="major">Guide</h2>
								<span class="image main"><img src="images/pic01.jpg" alt="" /></span>
								<p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. By the way, check out my <a href="#work">awesome work</a>.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus. Pellentesque aliquam maximus risus, vel sed vehicula.</p>
							</article>

							<!-- Contact -->
							<article id="Contact">
								<h2 class="major">Contact</h2>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>
								<center><p>전화번호 이메일 주소 등등</p></center>
							</article>

							<!-- BoxOffice -->
							<article id="BoxOffice">
								<h2 class="major">BoxOffice</h2>
								<span class="image main"><img src="images/pic01.jpg" alt="" /></span>
								<p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. By the way, check out my <a href="#work">awesome work</a>.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus. Pellentesque aliquam maximus risus, vel sed vehicula.</p>
							</article>

							<!-- Review -->
							<article id="Review">
								<h2 class="major">Review</h2>
								<span class="image main"><img src="images/pic01.jpg" alt="" /></span>
								<p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. By the way, check out my <a href="#work">awesome work</a>.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus. Pellentesque aliquam maximus risus, vel sed vehicula.</p>
							</article>

						<!-- Board -->
							<article id="Board">
								<h2 class="major">Board</h2>
								<span class="image main"><img src="images/pic02.jpg" alt="" /></span>
								<p>Adipiscing magna sed dolor elit. Praesent eleifend dignissim arcu, at eleifend sapien imperdiet ac. Aliquam erat volutpat. Praesent urna nisi, fringila lorem et vehicula lacinia quam. Integer sollicitudin mauris nec lorem luctus ultrices.</p>
								<p>Nullam et orci eu lorem consequat tincidunt vivamus et sagittis libero. Mauris aliquet magna magna sed nunc rhoncus pharetra. Pellentesque condimentum sem. In efficitur ligula tate urna. Maecenas laoreet massa vel lacinia pellentesque lorem ipsum dolor. Nullam et orci eu lorem consequat tincidunt. Vivamus et sagittis libero. Mauris aliquet magna magna sed nunc rhoncus amet feugiat tempus.</p>
							</article>

						<!-- Search -->
							<article id="Search">
								<h2 class="major">Search</h2>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>
								<p>Lorem ipsum dolor sit amet, consectetur et adipiscing elit. Praesent eleifend dignissim arcu, at eleifend sapien imperdiet ac. Aliquam erat volutpat. Praesent urna nisi, fringila lorem et vehicula lacinia quam. Integer sollicitudin mauris nec lorem luctus ultrices. Aliquam libero et malesuada fames ac ante ipsum primis in faucibus. Cras viverra ligula sit amet ex mollis mattis lorem ipsum dolor sit amet.</p>
							</article>

							<!-- Login -->
							<article id="Login">
								<h2 class="major">Login</h2>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>

								<?php
									//세션 데이터에 접근하기 위해 세션 시작
									session_start();
									$id = $_SESSION['id'];
									$name = $_SESSION['name'];
								?>
									
								<p>Please Enter Your Information Correctely<br/>
									
									<span>아 이 디 : <input type="text" name="id" style="text-align: bottom; width: 200px; height: 30px; font-size : 18px" value="">
                  비밀번호 : <input type="password" name="pw" style="text-align: bottom; width: 192px; height: 30.5px; font-size : 18px" value=""></span>
								
									<br>
									<input id="btn" type="submit" style="WIDTH: 90pt; HEIGHT: 30pt; font-size:20px;"  value="로그인">
                  <input id="btn" type="Button" style="WIDTH: 90pt; HEIGHT: 30pt; font-size:20px;"  value="회원가입">
								</p>
							</article>

							<!-- Join -->
							<article id="Join">
								<h2 class="major">Join</h2>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>
								<p>Lorem ipsum dolor sit amet, consectetur et adipiscing elit. Praesent eleifend dignissim arcu, at eleifend sapien imperdiet ac. Aliquam erat volutpat. Praesent urna nisi, fringila lorem et vehicula lacinia quam. Integer sollicitudin mauris nec lorem luctus ultrices. Aliquam libero et malesuada fames ac ante ipsum primis in faucibus. Cras viverra ligula sit amet ex mollis mattis lorem ipsum dolor sit amet.</p>
							</article>

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

						<!-- Elements -->
							<article id="elements">
								<h2 class="major">Elements</h2>

								<section>
									<h3 class="major">Text</h3>
									<p>This is <b>bold</b> and this is <strong>strong</strong>. This is <i>italic</i> and this is <em>emphasized</em>.
									This is <sup>superscript</sup> text and this is <sub>subscript</sub> text.
									This is <u>underlined</u> and this is code: <code>for (;;) { ... }</code>. Finally, <a href="#">this is a link</a>.</p>
									<hr />
									<h2>Heading Level 2</h2>
									<h3>Heading Level 3</h3>
									<h4>Heading Level 4</h4>
									<h5>Heading Level 5</h5>
									<h6>Heading Level 6</h6>
									<hr />
									<h4>Blockquote</h4>
									<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan faucibus. Vestibulum ante ipsum primis in faucibus lorem ipsum dolor sit amet nullam adipiscing eu felis.</blockquote>
									<h4>Preformatted</h4>
									<pre><code>i = 0;

while (!deck.isInOrder()) {
    print 'Iteration ' + i;
    deck.shuffle();
    i++;
}

print 'It took ' + i + ' iterations to sort the deck.';</code></pre>
								</section>

								<section>
									<h3 class="major">Lists</h3>

									<h4>Unordered</h4>
									<ul>
										<li>Dolor pulvinar etiam.</li>
										<li>Sagittis adipiscing.</li>
										<li>Felis enim feugiat.</li>
									</ul>

									<h4>Alternate</h4>
									<ul class="alt">
										<li>Dolor pulvinar etiam.</li>
										<li>Sagittis adipiscing.</li>
										<li>Felis enim feugiat.</li>
									</ul>

									<h4>Ordered</h4>
									<ol>
										<li>Dolor pulvinar etiam.</li>
										<li>Etiam vel felis viverra.</li>
										<li>Felis enim feugiat.</li>
										<li>Dolor pulvinar etiam.</li>
										<li>Etiam vel felis lorem.</li>
										<li>Felis enim et feugiat.</li>
									</ol>
									<h4>Icons</h4>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
									</ul>

									<h4>Actions</h4>
									<ul class="actions">
										<li><a href="#" class="button primary">Default</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
									<ul class="actions stacked">
										<li><a href="#" class="button primary">Default</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
								</section>

								<section>
									<h3 class="major">Table</h3>
									<h4>Default</h4>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Name</th>
													<th>Description</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Item One</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Two</td>
													<td>Vis ac commodo adipiscing arcu aliquet.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Three</td>
													<td> Morbi faucibus arcu accumsan lorem.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Four</td>
													<td>Vitae integer tempus condimentum.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Five</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td>100.00</td>
												</tr>
											</tfoot>
										</table>
									</div>

									<h4>Alternate</h4>
									<div class="table-wrapper">
										<table class="alt">
											<thead>
												<tr>
													<th>Name</th>
													<th>Description</th>
													<th>Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Item One</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Two</td>
													<td>Vis ac commodo adipiscing arcu aliquet.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Three</td>
													<td> Morbi faucibus arcu accumsan lorem.</td>
													<td>29.99</td>
												</tr>
												<tr>
													<td>Item Four</td>
													<td>Vitae integer tempus condimentum.</td>
													<td>19.99</td>
												</tr>
												<tr>
													<td>Item Five</td>
													<td>Ante turpis integer aliquet porttitor.</td>
													<td>29.99</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td>100.00</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</section>

								<section>
									<h3 class="major">Buttons</h3>
									<ul class="actions">
										<li><a href="#" class="button primary">Primary</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
									<ul class="actions">
										<li><a href="#" class="button">Default</a></li>
										<li><a href="#" class="button small">Small</a></li>
									</ul>
									<ul class="actions">
										<li><a href="#" class="button primary icon solid fa-download">Icon</a></li>
										<li><a href="#" class="button icon solid fa-download">Icon</a></li>
									</ul>
									<ul class="actions">
										<li><span class="button primary disabled">Disabled</span></li>
										<li><span class="button disabled">Disabled</span></li>
									</ul>
								</section>

								<section>
									<h3 class="major">Form</h3>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="demo-name">Name</label>
												<input type="text" name="demo-name" id="demo-name" value="" placeholder="Jane Doe" />
											</div>
											<div class="field half">
												<label for="demo-email">Email</label>
												<input type="email" name="demo-email" id="demo-email" value="" placeholder="jane@untitled.tld" />
											</div>
											<div class="field">
												<label for="demo-category">Category</label>
												<select name="demo-category" id="demo-category">
													<option value="">-</option>
													<option value="1">Manufacturing</option>
													<option value="1">Shipping</option>
													<option value="1">Administration</option>
													<option value="1">Human Resources</option>
												</select>
											</div>
											<div class="field half">
												<input type="radio" id="demo-priority-low" name="demo-priority" checked>
												<label for="demo-priority-low">Low</label>
											</div>
											<div class="field half">
												<input type="radio" id="demo-priority-high" name="demo-priority">
												<label for="demo-priority-high">High</label>
											</div>
											<div class="field half">
												<input type="checkbox" id="demo-copy" name="demo-copy">
												<label for="demo-copy">Email me a copy</label>
											</div>
											<div class="field half">
												<input type="checkbox" id="demo-human" name="demo-human" checked>
												<label for="demo-human">Not a robot</label>
											</div>
											<div class="field">
												<label for="demo-message">Message</label>
												<textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Send Message" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</form>
								</section>

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

	</body>
</html>
