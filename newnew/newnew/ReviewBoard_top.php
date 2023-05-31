<?php
    $con = mysqli_connect("localhost", "pdy1201", "AA1205dnflwlq!!", "pdy1201");
    mysqli_query($con, 'SET NAMES utf8');
    if (!session_id()) {
        session_start();
    }
    $select_query = "SELECT COUNT(*) AS size FROM board";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_array($result);
    $nums = $row['size'];
    $listSize = 10;
    $blockSize = 10;
    $prevBlock = "";
    $nextBlock = "";
    $totalListCount = ceil($nums / $listSize);
    $no = $nums - $start;
    $totalBlockCount = ceil($totalListCount / $blockSize);
    
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>REVIEW MY CINEMA</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <noscript><link rel="stylesheet" href="assets/css/noscript.css"/></noscript>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">
    <!-- 로그인시 아이디와 이름을 표시해줌 -->
    <?php
    if ($_SESSION['login_check'] == true) {
        ?>
        <div class="logInfo">
            <pre><code>ID&nbsp:&nbsp<span
                            style="color: #f77777;"><?php echo $_SESSION["id"] ?></span>&nbsp&nbsp&nbsp Name&nbsp:&nbsp<span
                            style="color: #f77777;"><?php echo $_SESSION["name"] ?></span></code></pre>
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
                <h1>Top Review</h1>
                <ul class="actions">
                    <li><a href="#" onclick="event.preventDefault();" class="button primary2">TOP 5</a></li>
                    <li><a href=".\ReviewBoard.php" class="button2">ALL</a></li>
                    <li><a href=".\ReviewBoard_mine.php" class="button2">MY</a></li>
                    <li><button class="button small2" onclick="boardWrite()" type="button">Make Review</button></li>
                </ul>
                <section>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Writer</th>
                                <th>Title</th>
                                <th>Hit</th>
                            </tr>
                            </thead>
                            <?php
                            $query = "SELECT * FROM board ORDER BY CAST(hit AS UNSIGNED) DESC LIMIT 5";
                            $result = $con->query($query);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tbody>
                                <tr>
                                    <td><?= $row["idx"] ?></td>
                                    <td><?= $row["writer"] ?></td>
                                    <td><a href=".\ReviewShow.php?idx=<?= $row["idx"] ?>"><?= $row["title"] ?></a></td>
                                    <td><?= $row["hit"] ?></td>
                                </tr>
                                </tbody>
                                <?php
                            }
                            ?>
                        </table>
                        <div>
                            <div>
                                <div id="sub1_2_divPaging1">
                                    <?php
                                    for ($i = $startPage; $i <= $endPage; $i++) {
                                        $active = $page == $i ? "disabled" : "";
                                        echo "<div class='pagingbox'>
                                        <a " . $active . "' href='./ReviewBoard.php?page=" . $i . "'>" . $i . "</a>
                                        </div>";
                                    }
                                    ?>
                                
                                </div>
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
                    if ($_SESSION['login_check'] == true) {
                        ?>
                        <a class="menuLink" href=".\index-afterlogin.php">Home</a>
                        <?php
                    } else {
                        ?>
                        <a class="menuLink" href=".\index.html">Home</a>
                        <?php
                    }
                    ?></li>
                <!-- 메뉴 박스오피스 버튼 세션  -->
                <?php
                if ($_SESSION['login_check'] == true) {
                    ?>
                    <li class="nav-item">
                        <a href=".\BoxOfficeday.php">BoxOffice</a>
                    </li>
                    <?php
                }
                ?>
                <!-- 메뉴 리뷰버튼 세션 -->
                <?php
                if ($_SESSION['login_check'] == true) {
                    ?>
                    <li class="nav-item">
                        <a href=".\ReviewBoard.php" onclick="event.preventDefault();">Review</a>
                    </li>
                    <?php
                }
                ?>
                <!-- 메뉴 검색버튼 세션 -->
                <?php
                if ($_SESSION['login_check'] == true) {
                    ?>
                    <li class="nav-item">
                        <li><a href=".\search.php">Search</a></li>
                    </li>
                    <?php
                }
                ?>
                <!-- 메뉴 문의버튼 세션 -->
                <?php
                if ($_SESSION['login_check'] == false) {
                    ?>
                    <li class="nav-item">
                        <li><a href="#contact">Contact us</a></li>
                    </li>
                    <?php
                }
                ?>
                <!-- 메뉴 로그인 로그아웃 버튼 세션 -->
                <li><?php
                    if ($_SESSION['login_check'] == true) {
                        ?>
                        <a class="menuLink" href="#logout">LogOut</a>
                        <?php
                    } else {
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
                    <li><input type="button" onclick="location.href='logout.php'" value="Log Out" class="primary" />
                    </li>
                    <li><input type="button" onclick="location.href='ReviewBoard.php'" value="Back" /></li>
                </ul>
            </form>
        </article>
    </div>
    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy;
            Made By P.D.Y</p>
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
        location.href = "ReviewWrite.php";
    }
</script>
</body>

</html>
