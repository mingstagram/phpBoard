$(function () {
  "use strict";

  var content = $("#content");
  var input = $("#input");
  var status = $("#status");

  var myColor = false;
  var myName = false;

  window.WebSocket = window.WebSocket || window.MozWebSocket;

  if (!window.WebSocket) {
    content.html(
      $("<p>", { text: "Sorry, but your browser doesn't support WebSocket." })
    );
    input.hide();
    $("span").hide();
    return;
  }

  var connection = new WebSocket("ws://127.0.0.1:8080");

  connection.onopen = function () {
    input.removeAttr("disabled");
    status.text("이름 입력:");
  };

  connection.onerror = function (error) {
    content.html(
      $("<p>", {
        text:
          "Sorry, but there's some problem with your " +
          "connection or the server is down.",
      })
    );
  };

  connection.onmessage = function (message) {
    try {
      console.log(message);
      var json = JSON.parse(message.data);
    } catch (e) {
      console.log("Invalid JSON: ", message.data);
      return;
    }

    if (json.type === "color") {
      myColor = json.data;
      status.text(myName + ": ").css("color", myColor);
      input.removeAttr("disabled").focus();
    } else if (json.type === "history") {
      for (var i = 0; i < json.data.length; i++) {
        addMessage(
          json.data[i].author,
          json.data[i].text,
          json.data[i].color,
          new Date(json.data[i].time)
        );
      }
    } else if (json.type === "message") {
      input.removeAttr("disabled");
      addMessage(
        json.data.author,
        json.data.text,
        json.data.color,
        new Date(json.data.time)
      );
    } else {
      console.log("Hmm..., I've never seen JSON like this:", json);
    }
  };

  input.keydown(function (e) {
    if (e.keyCode === 13) {
      var msg = $(this).val();

      if (!msg) {
        return;
      }

      connection.send(msg);

      $(this).val("");

      input.attr("disabled", "disabled");

      if (myName === false) {
        myName = msg;
      }
    }
  });

  setInterval(function () {
    if (connection.readyState !== 1) {
      status.text("Error");
      input
        .attr("disabled", "disabled")
        .val("Unable to communicate with the WebSocket server.");
    }
  }, 3000);

  function addMessage(author, message, color, dt) {
    content.prepend(
      '<p><span style="color:' +
        color +
        '">' +
        author +
        "</span> @ " +
        (dt.getHours() < 10 ? "0" + dt.getHours() : dt.getHours()) +
        ":" +
        (dt.getMinutes() < 10 ? "0" + dt.getMinutes() : dt.getMinutes()) +
        ": " +
        message +
        "</p>"
    );
  }
});
