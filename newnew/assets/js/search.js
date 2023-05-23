$(document).ready(function () {
  $("#searchButton").click(function () {
    var searchQuery = $("#searchInput").val();
    searchMovie(searchQuery);
  });
});

function searchMovie(query) {
  $.ajax({
    url: "https://api.themoviedb.org/3/search/movie",
    type: "GET",
    dataType: "json",
    data: {
      api_key: "f31e7eeafff2fd6a01fd509ef87968ed",
      query: query,
    },
    success: function(data) {
        $('#searchResults').empty();
        if (data.results.length > 0) {
          // 개봉년도 최신 순으로 정렬
          data.results.sort(function(a, b) {
            return new Date(b.release_date) - new Date(a.release_date);
          });
      
          // 검색결과 갯수 제한
          var resultsCount = Math.min(data.results.length, 15);
      
          for (var i = 0; i < resultsCount; i++) {
            var movie = data.results[i];
            var title = movie.title;
            var originalTitle = movie.original_title;
            var releaseYear = movie.release_date.substring(0, 4);
            var posterUrl = 'https://image.tmdb.org/t/p/w300' + movie.poster_path;
            var movieElement = '<div><h3><a href="#detail" onclick="searchMovie(' + movie.id + ', event)">' + title + '</a></h3>';
            if (title !== originalTitle) {
              movieElement += '<p>원어 제목: ' + originalTitle + '</p>';
            }
            movieElement += '<p>개봉 연도: ' + releaseYear + '</p>';
            movieElement += '<img src="' + posterUrl + '" alt="영화 포스터"></div>'; // 포스터 이미지 추가
            $('#searchResults').append(movieElement);
          }
        } else {
          $('#searchResults').append('<p>영화를 찾을 수 없습니다.</p>');
        }
      },
      
    error: function () {
      $("#searchResults").empty();
      $("#searchResults").append("<p>오류가 발생했습니다.</p>");
    },
  });
}

//상세정보
function tail(movieCd) {
  var url = "https://api.themoviedb.org/3/search/movie";
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
        str = str + "등급 : " + $(data).find("watchGradeNm").text()+"<br>";
        str = str + "런닝타임 : " + $(data).find("showTm").text()+"분"+"<br>";
        str = str + "장르 : " + $(data).find("genreNm").text()+"<br>";
        str = str + "제작국가 : " + $(data).find("nations").text()+"<br>";
        str = str + "제작년도 : " + $(data).find("prdtYear").text()+"년"+"<br>";
        str = str + "제작사 : " + $(data).find("companyNm").text()+"<br><br>";
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