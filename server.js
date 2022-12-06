// ********* server.js 파일

// 전역 변수
const colors = ["red", "green", "blue", "magenta", "purple", "plum", "orange"];
const clients = [];
let history = [];

// HTTP 서버(express) 생성 및 구동
// 1. express 객체 생성
const express = require("express");
const app = express();

// 2. "/" 경로 라우팅 처리
app.use("/", (req, res) => {
  res.sendFile(__dirname + "/chat.php");
}); // index.html 파일 응답

// 3. 8080 port에서 서버 구동
const HTTPServer = app.listen(8080, () => {
  console.log("Server is open at port:8080");
});

const wsModule = require("ws");
// 2. WebSocket 서버 생성/구동
const wsServer = new wsModule.Server({
  server: HTTPServer,
  // port: 8081,
  // WebSocket서버에 연결할 HTTP서버를 지정한다.
  // port: 30002 // WebSocket연결에 사용할 port를 지정한다(생략시, http서버와 동일한 port 공유 사용)
});

// connection(클라이언트 연결) 이벤트 처리
wsServer.on("connection", (ws, request) => {
  const index = clients.push(ws) - 1;
  let userName = false;
  let userColor = false;

  // 1) 연결 클라이언트 IP 취득
  const ip =
    request.headers["x-forwarded-for"] || request.connection.remoteAddress;

  console.log(`새로운 클라이언트[${ip}] 접속`);

  // 2) 클라이언트에게 메시지 전송
  if (ws.readyState === ws.OPEN) {
    // 연결 여부 체크
    ws.send(`클라이언트[${ip}] 접속을 환영합니다 from 서버`); // 데이터 전송
  }

  // 3) 클라이언트로부터 메시지 수신 이벤트 처리
  ws.on("message", (msg) => {
    if (userName === false) {
      userName = htmlEntities(msg);
      userColor = colors.shift();
      ws.send(makeResponse("color", userColor));

      console.log(`User is known as: ${userName} with ${userColor} color`);
    } else {
      console.log(`Received Message from ${userName}: ${msg}`);

      const obj = {
        time: new Date().getTime(),
        text: htmlEntities(msg),
        author: userName,
        color: userColor,
      };

      history.push(obj);
      history = history.slice(-100);

      clients.forEach((client) => client.send(makeResponse("message", obj)));
      // ws.send(makeResponse("message", obj));
    }
    console.log(`클라이언트[${ip}]에게 수신한 메시지 : ${msg}`);
  });

  // 4) 에러 처리
  ws.on("error", (error) => {
    console.log(`클라이언트[${ip}] 연결 에러발생 : ${error}`);
  });

  // 5) 연결 종료 이벤트 처리
  ws.on("close", () => {
    console.log(`클라이언트[${ip}] 웹소켓 연결 종료`);
    if (userName !== false && userColor !== false) {
      console.log(`Peer ${ws.remoteAddress} disconnected`);

      clients.splice(index, 1);
      colors.push(userColor);
    }
  });
});

// utility
const htmlEntities = (str) =>
  String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");
const makeResponse = (type, data) => JSON.stringify({ type, data });
