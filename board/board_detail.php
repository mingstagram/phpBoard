<?php 
    include("../layout/header.php"); 
    require_once("../db/connect.php");

    $connEntity = new Connect();
    $conn = $connEntity->load_connect();
    $boardId = $_GET['id'];

    $sql = "
        SELECT 
        * 
        FROM board_tb b
        WHERE  1 = 1
        AND BOARD_ID = ". $boardId;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<div class="container card">
    <div class="card-body">
        <button class="btn btn-info" onclick="history.back();">돌아가기</button>
        <a href="/board/update_form?id=<?= $boardId ?>" class="btn btn-warning">수정</a>
        <button id="btn-delete" class="btn btn-danger">삭제</button>
    </div>
    <div class="card-header" style="margin-bottom: 10px;">
        글 번호 : <span id="id"><i><?= $row['BOARD_ID'] ?></i></span> 작성자 : <span><i>asd</i></span>
        <span style="float: right;">
            <span id="blike">추천 : <?= $row['BOARD_LIKE'] ?></span> &nbsp;
            <span>조회수 : <?= $row['BOARD_COUNT'] ?></span>&nbsp;
        </span>
    </div>
    <div class="form-group card-body" style="height: 50px">
        <h3><?= $row['BOARD_TITLE'] ?></h3>
    </div>
    <hr>
    <div class="form-group card-body">
        <div><?= $row['BOARD_CONTENT'] ?></div>
    </div>
    <br /> <br /> <br />
    <div style="margin: 10px;">
        <button type="button" class="btn btn-Light" onclick="index.like()" style="border: 1px solid black;">❤
            공감</button>
        <button type="button" class="btn btn-Light" onclick="index.like()" style="border: 1px solid black;">🤍
            1</button>
        <div class="btn-group dropup" style="float: right;">
            <button type="button" class="btn btn-Light dropdown-toggle" data-toggle="dropdown"
                style="border: 1px solid black;">📤</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" id="btnFacebook" href="javascript:shareFacebook();">페이스북으로 공유</a>
                <a class="dropdown-item" id="btnKakao" href="javascript:shareKakao(${board.id});">카카오톡으로 공유</a>
                <a class="dropdown-item" id="btnTwitter" href="javascript:shareTwitter();">트위터로 공유</a>
                <a class="dropdown-item" id="link-copy" href="javascript:;">URL 복사</a>
                <input type="hidden" id="link-area" class="link-area" value="http://localhost:8000/board/${board.id}">
            </div>
        </div>
    </div>
    <div class="card">
        <form>
            <input type="hidden" id="userId" value=" ">
            <input type="hidden" id="boardId" value=" ">
            <div class="card-body">
                <textarea id="reply-content" class="form-control" rows="1"></textarea>
            </div>
            <div class="card-footer">
                <button type="button" id="btn-reply-save" class="btn btn-primary">등록</button>
            </div>
        </form>
    </div>
    <br>
    <div class="card">
        <div class="card-header">댓글 리스트</div>
        <ul id="reply-box" class="list-group">
            <li class="list-group-item d-flex justify-content-between">
                <div>댓글내용</div>
                <div class="d-flex">
                    <div class="font-italic">작성자 : 작성자1
                        &nbsp;</div>
                    <button class="badge" style="--bs-badge-color: black;">삭제</button>
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <div>댓글내용</div>
                <div class="d-flex">
                    <div class="font-italic">작성자 : 작성자1
                        &nbsp;</div>
                    <button class="badge" style="--bs-badge-color: black;">삭제</button>
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <div>댓글내용</div>
                <div class="d-flex">
                    <div class="font-italic">작성자 : 작성자1
                        &nbsp;</div>
                    <button class="badge" style="--bs-badge-color: black;">삭제</button>
                </div>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <div>댓글내용</div>
                <div class="d-flex">
                    <div class="font-italic">작성자 : 작성자1
                        &nbsp;</div>
                    <button class="badge" style="--bs-badge-color: black;">삭제</button>
                </div>
            </li>
        </ul>
    </div>
</div>
</div>
<script src="/js/board.js"></script>
<?php include("../layout/footer.php");?>