<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
    include("layout/header.php");  
    require_once("db/connect.php");
    include("util/pagination.php");
    $connEntity = new Connect();
    $pageEntity = new Pagination();

    $conn = $connEntity->load_connect(); 
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT count(*) as board_count FROM board_tb";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total = $row['board_count'];
 
    /* paging : 현재 페이지 */
    $pageEntity->list_num = 5; // 한 페이지 당 데이터 갯수
    $pageEntity->page_num = 3; // 한 블럭 당 페이지 수
    $page = isset($_GET["page"])? $_GET["page"] : 1;  
    $page_arr = $pageEntity->paging_proc($total, $page);
    $start = $page_arr['start'];
    $s_pageNum = $page_arr['s_pageNum'];
    $e_pageNum = $page_arr['e_pageNum'];
    $total_page = $page_arr['total_page'];
    $list_num = $pageEntity->list_num;

    $sql = "SELECT * FROM board_tb ORDER BY BOARD_ID desc LIMIT $start, $list_num"; 
    $result = mysqli_query($conn, $sql);

    /* paging : 글번호 */
    $cnt = $start + 1;
    
    $list = '';
    while($row = mysqli_fetch_array($result)){
        $list .= '<div class="card m-1" >';
        $list .= '<div class="card-body">';
        $list .= '<h4 class="card-title">'.$row['BOARD_TITLE'].'</h4>';
        $list .= '<a href="board/board_detail.php?id='.$row['BOARD_ID'].'" class="btn btn-primary">상세보기</a>';
        $list .= '<h6 style="float:right">조회수 : '.$row['BOARD_COUNT'].'</h6>'; 
        $list .= '</div>';
        $list .= '</div>';
    }

    $pageHtml = '';
    if($page <= 1){
        $pageHtml .= '<li class="page-item disabled"><a class="page-link" href="index.php?page=1">&laquo;</a></li>';
    } else {
        $pageHtml .= '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'">&laquo;</a></li>';
    }
    
    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
        $pageHtml .= '<li class="page-item"><a class="page-link" href="index.php?page='.$print_page.'">'.$print_page.'</a></li>';
    }

    if($page >= $total_page){
        $pageHtml .= '<li class="page-item disabled"><a class="page-link" href="index.php?page='.$total_page.'">&raquo;</a></li>';
    } else {
        $pageHtml .= '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'">&raquo;</a></li>';
    }

?>

<div class="container">
    <?= $list ?>
    <ul class="pagination justify-content-center">
        <?= $pageHtml ?>
    </ul>
</div>

<?php include("layout/footer.php");?>