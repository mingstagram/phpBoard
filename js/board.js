var title;
var content;

function save() {
  let data = {
    title: $("#title").val(),
    content: $("#content").val(),
  };

  $.ajax({
    type: "post",
    url: "write_process.php",
    data: data,
    dataType: "JSON",
    success: function (res) {
      console.log(res);
      if (res.result == "success") {
        alert("글쓰기 완료");
        location.href = "/";
      } else {
        console.log(res);
        alert("글쓰기 실패");
      }
    },
    error: function (err) {
      console.log(err);
      alert("텅신x");
    },
  });
}

function update() {
  let data = {
    title: $("#title").val(),
    content: $("#content").val(),
    boardId: $("#boardId").val(),
  };

  $.ajax({
    type: "POST",
    url: "update_process.php",
    data: data,
    dataType: "JSON",
    success: function (res) {
      console.log(res);
      if (res.result == "success") {
        alert("글수정 완료");
        location.href = "/board/board_detail?id=" + data.boardId;
      } else {
        console.log(res);
        alert("수정 실패");
      }
    },
    error: function (err) {
      console.log(err);
      alert("텅신x");
    },
  });
}

function searchBoard() {
  var page = $("#page").val();
  var searchText = $("#search").val();
  let data = {
    page: page,
    search: searchText,
  };
  $.ajax({
    type: "get",
    url: "index.php",
    data: data,
    success: function (res) {
      console.log(res);
    },
    error: function (err) {
      console.log(err);
      alert("텅신x");
    },
  });
}

// function Change(idx){
//   var pagenum = idx;
//   var nowPaging = $("#pageUnit option:selected").val();

//   if(nowPaging == 10){
//       location.href="${path}/onlinecounsel/counselhistory/list.do?pageIndex="+pagenum+"&pageUnit="+nowPaging;
//   }else if(nowPaging == 20){
//       location.href="${path}/onlinecounsel/counselhistory/list.do?pageIndex="+pagenum+"&pageUnit="+nowPaging;
//   }else if(nowPaging == 30){
//       location.href="${path}/onlinecounsel/counselhistory/list.do?pageIndex="+pagenum+"&pageUnit="+nowPaging;
//   }
// }
