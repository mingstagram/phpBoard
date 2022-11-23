var email;
var password;
var username;

function join() {
  let data = {
    email: $("#email").val(),
    password: $("#password").val(),
    username: $("#username").val(),
  };

  $.ajax({
    type: "post",
    url: "join_process.php",
    data: data,
    dataType: "JSON",
    success: function (res) {
      if (res.result == "success") {
        location.href = "/";
      } else {
        alert("회원가입 실패(관리자에게 문의하세요.)");
      }
    },
  });
}

function login() {
  let data = {
    email: $("#email").val(),
    password: $("#password").val(),
  };

  $.ajax({
    type: "post",
    url: "login_check.php",
    data: data,
    dataType: "JSON",
    success: function (res) {
      if (res.result == "success") {
        location.href = "/";
      } else {
        alert("이메일, 비밀번호를 확인해주세요");
      }
    },
  });
}
