<?php  
    include("layout/header.php");  ?>
<style>
p {
    line-height: 18px;
}

div {
    width: 500px;
    margin-left: auto;
    margin-right: auto;
}

#content {
    padding: 5px;
    background: #ddd;
    border-radius: 5px;
    overflow-y: scroll;
    border: 1px solid #CCC;
    margin-top: 10px;
    height: 160px;
}

#input {
    border-radius: 2px;
    border: 1px solid #ccc;
    margin-top: 10px;
    padding: 5px;
    width: 400px;
}

#status {
    width: 88px;
    display: block;
    float: left;
    margin-top: 15px;
}
</style>
</head>

<body>
    <div id="content"></div>

    <div>
        <span id="status">Connecting...</span>
        <input type="text" id="input" disabled="disabled" />
    </div>

    <script src="./client.js"></script>
</body>
<!-- <script>
// 1. 웹소켓 클라이언트 객체 생성
const webSocket = new WebSocket("ws://127.0.0.1:8081");

// 2. 웹소켓 이벤트 처리
// 2-1) 연결 이벤트 처리
webSocket.onopen = () => {
    console.log("웹소켓서버와 연결 성공");
};

// 2-2) 메시지 수신 이벤트 처리
webSocket.onmessage = function(event) {
    console.log(`서버 웹소켓에게 받은 데이터 : ${event.data}`);
    $("#chatValue").val = event.data;
};

// 2-3) 연결 종료 이벤트 처리
webSocket.onclose = function() {
    console.log("서버 웹소켓 연결 종료");
};

// 2-4) 에러 발생 이벤트 처리
webSocket.onerror = function(event) {
    console.log(event);
};

// 3. 버튼 클릭 이벤트 처리
// 3-1) 웹소켓 서버에게 메시지 보내기
let count = 1;
document.getElementById("btn_send").onclick = function() {
    if (webSocket.readyState === webSocket.OPEN) {
        // 연결 상태 확인
        webSocket.send(`증가하는 숫자를 보냅니다 => ${count}`); // 웹소켓 서버에게 메시지 전송


        count++;
    } else {
        alert("연결된 웹소켓 서버가 없습니다.");
    }
};

document.getElementById("btn_close").onclick = function() {
    if (webSocket.readyState === webSocket.OPEN) {
        // 연결 상태 확인
        webSocket.close(); // 연결 종료
    } else {
        alert("연결된 웹소켓 서버가 없습니다.");
    }
};
</script> -->

</html>
<?php include("layout/footer.php");?>