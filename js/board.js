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
