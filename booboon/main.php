<html>
      <head>
            <title>회원관리사이트</title>
            <meta charset="utf-8">
      </head>
       
<center>

<body bgcolor = '#ece6d4' >

      <style>
            h1 {
                  color:#5a4146; 
                  border-style: solid; 
                  border-width: 2px;  
                  width : 380px; 
                  height: 70px; 
                  font-size: 50px;  
                  font-family: "Times New Roman", Times, Sans-serif;
            }
            form {
                  color:#5a4146; 
                  display: inline; 
                  font-size: 30px; 
                  font-family: "Times New Roman", Times, Sans-serif ;
            }
            input {
                  color:#5a4146; 
                  font-size: 25px; 
                  font-family: "Times New Roman", Times, Sans-serif ;
            }
            body {
                  border-style: dashed; 
                  border-width: 6px;
            }
            /* h2{border-style: solid; border-width: 2px;  width : 800px; height: 68px;} */
            p {
                  border-style: solid; 
                  border-width: 2px;  
                  width : 800px; 
                  height: 460px;
            }
            #title {
                  text-align: center;
            }
            #menu {
                  height: 40px;
                  width: auto;
                  margin-left: auto;
                  margin-right: auto;
            }
            #menu ul li {
                  list-style: none;
                  color: #4F4F4F;
                  background-color: white;
                  float: left;
                  line-height: 35px;
                  vertical-align: middle;
                  text-align: center;
            }
            #menu ul li:hover {
                  text-decoration: none;
                  color: #4F4F4F;
                  border-bottom: 1px solid #4F4F4F;
                  display: block;
                  width: 100pxs;
                  font-size: 13px;
                  font-weight: bolder;
                  font-family: verdana;
                  outline: 0;
            }
            #menu .menuLink {
                  text-decoration: none;
                  color: #4F4F4F;
                  display: block;
                  width: 100px;
                  font-size: 13px;
                  font-weight: bold;
                  font-family: verdana;
            }
      </style>

<h2>회원관리 사이트</h2>

<div id="menu">
  <ul>
    <li><a class="menuLink" href=".\index.html">Home</a></li>
    <li><a class="menuLink" href=".\login1.php">로그인</a></li>
    <li><a class="menuLink" href="#">회원목록</a></li>
    <li><a class="menuLink" href=".\edit.php">회원수정</a></li>
    <li><a class="menuLink" href=".\join1.php">회원가입</a></li>
    <li><a class="menuLink" href="#">기타</a></li>
  </ul>
</div>
      
      <br>
      <br>
      <br>

      <h1>메 인 페 이 지</h1>

      <br>

      <h2>

            <form method="post" action="main.php">
                  <button style="background-color:#5a4146; font-size: 50px; border:none; border-radius: 15px; color:white">회원목록</button>
            </form>

            <form method="post" action="edit.php">
                  <button style="background-color:#5a4146; font-size: 50px; border:none; border-radius: 15px; color:white">회원수정</button>
            </form>

            <form method="post" action="ect.php">
                  <button style="background-color:#5a4146; font-size: 50px; border:none; border-radius: 15px; color:white">　기타　</button>
            </form>

      </h2>

      <p>

      순번 아이디 이름 연락처 이메일
      <br>
      <br>
      <br>
      순번 아이디 이름 연락처 이메일 <button>수정</button> <button>삭제</button>

      </p>

</body>

</center>

</html>