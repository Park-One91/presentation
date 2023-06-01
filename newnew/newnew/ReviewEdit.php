<?php
  $con = mysqli_connect("localhost", "pdy1201", "AA1205dnflwlq!!", "pdy1201");
  // $con = mysqli_connect("localhost", "root", "qwer", "web_booboon");
  mysqli_query($con,'SET NAMES utf8');	
  //세션 데이터에 접근하기 위해 세션 시작
  if (!session_id()) 
    {
      session_start();
    }
    $idx = $_GET['idx'];                                             
    $sql = "select * from board where idx ='$idx'"; 
    $result = mysqli_query($con, $sql); 
    $row = mysqli_fetch_array($result);  
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" href="assets/css/main.css" />
      <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
      <title>REVIEW MY CINEMA</title>
      
    </head>
    <body bgcolor = '#ece6d4'>

        <!-- 게시판 쓰기 -->
        <center> 
        <form action="ReviewEdit_result.php" enctype="multipart/form-data" method="post">
          <div id="board_write">
            <table>
              <colgroup>
                <col width="20%">
                <col>
              </colgroup>
          
              <tbody>
                <tr>
                  <th>작성자</th>					
                  <td><input type="text" name="writer" class="form-control" value="<?php echo $row['writer']?>" detect="" detect-check="true" readonly="true"></td>
                </tr>
                
                <tr>
                  <th>제목</th>
                  <td><input type="text" name="title" id="subject" class="form-control" value="<?php echo $row['title']?>" detect="" detect-check="true"></td>
                </tr>

                <tr>
                  <td colspan="2" class="editor"><textarea name="content" rows="20" title="내용"><?php echo $row['content']?></textarea></td>
                </tr>
                
                <tr>
                  <th>첨부파일</th>
                  <td>
                    <div class="file_box">
                      <input type="text" class="file_name" readonly="readonly"></input>
                      <label for="uploadBtn" class="btn_file">찾아보기</label>
                      <input type="file" id="uploadBtn" value="1" name="b_file" class="uploadBtn"></input>
                    </div>
                  </td>
                </tr>				
              </tbody>
        
            </table>
          </div>

              <!-- 수정대상 글 idx 보내기 -->
              <input type="hidden" id="idx" name="idx" value="<?php echo $row['idx']?>">

              <!-- //게시판 쓰기 -->
              <div class="btn_edit_body">
                <div class="btn_edit">
                  <br>
                  <br>
                  <button type="submit" class="btn_edit gray" return false;> Done</button> 
                  <input type="button" value="Cancel" onClick="history.go(-1)">   
                  <br>
                  <br>
                </div>
              </div>
        </form>
        </center>
    </body>

  </html>
