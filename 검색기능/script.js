$(document).ready(function() {
    $('#searchButton').click(function() {
        var searchQuery = $('#searchInput').val();
        searchMovie(searchQuery);
    });
});

function searchMovie(query) {
    $.ajax({
        url: 'http://www.omdbapi.com/',
        type: 'GET',
        dataType: 'json',
        data: {
            apikey: '9ad2611b',  // '당신의_OMDB_API_키' 부분을 실제 API 키로 대체해주세요
            s: query
        },
        success: function(data) {
            $('#searchResults').empty();
            if (data.Response === 'True') {
                $.each(data.Search, function(index, movie) {
                    var title = movie.Title;
                    var releaseYear = movie.Year;
                    var posterUrl = movie.Poster;
                    var movieElement = '<div class="movie"><h3><a href="#" onclick="getMovieDetails(\'' + movie.imdbID + '\')">' + title + '</a></h3><p>개봉 연도: ' + releaseYear + '</p>';
                    movieElement += '<img src="' + posterUrl + '" alt="영화 포스터"></div>'; // 포스터 이미지 추가
                    $('#searchResults').append(movieElement);
                });
            } else {
                $('#searchResults').append('<p>영화를 찾을 수 없습니다.</p>');
            }
        },
        error: function() {
            $('#searchResults').empty();
            $('#searchResults').append('<p>오류가 발생했습니다.</p>');
        }
    });
}

function getMovieDetails(movieId) {
    // 상세 영화 정보를 가져오는 로직을 구현합니다.
    // movieId를 사용하여 API 요청을 보내고, 상세 정보를 표시하는 등의 작업을 수행할 수 있습니다.
    // 이 부분은 필요에 따라 원하는 방식으로 구현하시면 됩니다.
}
