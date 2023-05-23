// 댓글 작성 이벤트 핸들러
document.getElementById("comment-form").addEventListener("submit", function(event) {
  event.preventDefault(); // 폼 제출 기본 동작 방지

  // 작성된 댓글 데이터 가져오기
  var name = document.getElementById("name").value;
  var content = document.getElementById("content").value;

  // 댓글 생성 및 추가
  var comment = createComment(name, content);
  addComment(comment);

  // 입력 필드 초기화
  document.getElementById("name").value = "";
  document.getElementById("content").value = "";
});

// 댓글 생성 함수
function createComment(name, content) {
  var comment = {
    name: name,
    content: content,
    timestamp: new Date().getTime() // 댓글 작성 시간 저장
  };

  return comment;
}

// 댓글 추가 함수
function addComment(comment) {
  var commentContainer = document.getElementById("comment-container");

  // 댓글 요소 생성
  var commentElement = document.createElement("div");
  commentElement.classList.add("comment");

  var nameElement = document.createElement("strong");
  nameElement.textContent = comment.name;

  var contentElement = document.createElement("p");
  contentElement.textContent = comment.content;

  var timestampElement = document.createElement("span");
  timestampElement.textContent = formatDate(comment.timestamp);

  // 댓글 요소에 추가
  commentElement.appendChild(nameElement);
  commentElement.appendChild(contentElement);
  commentElement.appendChild(timestampElement);
  commentContainer.appendChild(commentElement);
}

// 시간 포맷 변환 함수
function formatDate(timestamp) {
  var date = new Date(timestamp);
  var year = date.getFullYear();
  var month = String(date.getMonth() + 1).padStart(2, "0");
  var day = String(date.getDate()).padStart(2, "0");
  var hours = String(date.getHours()).padStart(2, "0");
  var minutes = String(date.getMinutes()).padStart(2, "0");

  return year + "-" + month + "-" + day + " " + hours + ":" + minutes;
}
