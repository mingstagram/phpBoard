<?php 
    include("../layout/header.php"); 
    require_once("../db/connect.php");
    $boardId = $_GET['id']; 
    $sql = "SELECT * FROM board_tb WHERE BOARD_ID=$boardId"; 
    $connEntity = new Connect();
    $conn = $connEntity->load_connect();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
<div class="container">

    <form>
        <input type="hidden" id="boardId" value="<?= $row['BOARD_ID'] ?>">
        <div class="mb-3 mt-3">
            <label for="title">Title:</label> <input type="text" class="form-control" placeholder="Enter Title"
                id="title" name="title" value="<?= $row['BOARD_TITLE'] ?>">
        </div>
        <div class="mb-3">
            <label for="content">Content:</label>
            <textarea class="form-control" rows="5" id="content" name="content"><?= $row['BOARD_CONTENT'] ?></textarea>
        </div>
    </form>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="update();">수정하기</button>
        <button class="btn btn-danger" onclick="history.back()" style="text-align:right;">취소</button>
    </div>
</div>
<script src="/js/board.js"></script>
<?php include("../layout/footer.php");?>