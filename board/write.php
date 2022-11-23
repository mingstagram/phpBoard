<?php include("../layout/header.php"); ?>
<div class="container">

    <form action="/board/write_process.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="title">Title:</label> <input type="text" class="form-control" placeholder="Enter Title"
                id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="content">Content:</label>
            <textarea class="form-control" rows="5" id="content" name="content"></textarea>
        </div>
    </form>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="save()">글쓰기 완료</button>
    </div>
</div>
<script src="/js/board.js"></script>
<?php include("../layout/footer.php");?>