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
          // 최신 순으로 정렬
          data.results.sort(function(a, b) {
            return new Date(b.release_date) - new Date(a.release_date);
          });
      
          // 최대 10개의 결과만 표시
          var resultsCount = Math.min(data.results.length, 10);
      
          for (var i = 0; i < resultsCount; i++) {
            var movie = data.results[i];
            var title = movie.title;
            var originalTitle = movie.original_title;
            var releaseYear = movie.release_date.substring(0, 4);
            var posterUrl = 'https://image.tmdb.org/t/p/w300' + movie.poster_path;
            
            var movieElement = '<div class="movie"><h3><a href="#" onclick="getMovieDetails(\'' + movie.id + '\')">' + title + '</a></h3>';
            if (title !== originalTitle) {
              movieElement += '<p>영어 제목: ' + originalTitle + '</p>';
            }
            movieElement += '<p>제작 년도: ' + movie.release_date + '</p>';
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

function getGenres(genreIds) {
  // TMDb API에서 장르 정보를 가져와서 반환하는 로직을 구현합니다.
  // genreIds를 사용하여 API 요청을 보내고, 장르 정보를 가져오는 작업을 수행합니다.
  // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}

function getProductionCountries(countries) {
  // 제작 국가 정보를 가져와서 반환하는 로직을 구현합니다.
  // countries를 사용하여 제작 국가 정보를 가져오는 작업을 수행합니다.
  // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}

function getProductionCompanies(companies) {
  // 제작사 정보를 가져와서 반환하는 로직을 구현합니다.
  // companies를 사용하여 제작사 정보를 가져오는 작업을 수행합니다.
  // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}

function getDirector(movieId) {
  // 감독 정보를 가져와서 반환하는 로직을 구현합니다.
  // movieId를 사용하여 감독 정보를 가져오는 작업을 수행합니다.
  // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}

function getCast(movieId) {
  // 배우 정보를 가져와서 반환하는 로직을 구현합니다.
  // movieId를 사용하여 배우 정보를 가져오는 작업을 수행합니다.
  // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}

function getMovieDetails(movieId) {
  // 상세 영화 정보를 가져오는 로직을 구현합니다.
  // movieId를 사용하여 API 요청을 보내고, 상세 정보를 표시하는 등의 작업을 수행할 수 있습니다.
  // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}
