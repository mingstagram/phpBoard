<?php
    include("layout/header.php"); 
    require_once("db/connect.php");

    $connEntity = new Connect();
    $conn = $connEntity->load_connect();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM board_tb ORDER BY BOARD_ID desc"; 

    $result = mysqli_query($conn, $sql);
    $list = '';
    while($row = mysqli_fetch_array($result)){
        $list .= '<div class="card m-1">';
        $list .= '<div class="card-body">';
        $list .= '<h4 class="card-title">'.$row['BOARD_ID'].'</h4>';
        $list .= '<a href="board/board_detail.php?id='.$row['BOARD_ID'].'" class="btn btn-primary">상세보기</a>';
        $list .= '<h6 style="float:right">조회수 : '.$row['BOARD_COUNT'].'</h6>';
        $list .= '</div>';
        $list .= '</div>';
    }

?>

<div class="container">
    <?= $list ?>
</div>

<?php include("layout/footer.php");?>