<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
    include("layout/header.php");  
    require_once("db/connect.php");
    $connEntity = new Connect();
    $conn = $connEntity->load_connect(); 
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT count(*) as board_count FROM board_tb";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $num = $row['board_count'];

    /* paging : 한 페이지 당 데이터 개수 */
    $list_num = 5;

    /* paging : 한 블럭 당 페이지 수 */
    $page_num = 3;

    /* paging : 현재 페이지 */
    $page = isset($_GET["page"])? $_GET["page"] : 1; 

    /* paging : 전체 페이지 수 = 전체 데이터 / 페이지당 데이터 개수, ceil : 올림값, floor : 내림값, round : 반올림 */
    $total_page = ceil($num / $list_num);

    /* paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수 */
    $total_block = ceil($total_page / $page_num);

    /* paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수 */
    $now_block = ceil($page / $page_num);

    /* paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1 */
    $s_pageNum = ($now_block - 1) * $page_num + 1;
    // 데이터가 0개인 경우
    if($s_pageNum <= 0){
        $s_pageNum = 1;
    };

    /* paging : 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수 */
    $e_pageNum = $now_block * $page_num;
    // 마지막 번호가 전체 페이지 수를 넘지 않도록
    if($e_pageNum > $total_page){
        $e_pageNum = $total_page;
    };

    /* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
    $start = ($page - 1) * $list_num;

    $sql = "SELECT * FROM board_tb ORDER BY BOARD_ID desc LIMIT $start, $list_num"; 
     
    /* paging : 쿼리 전송 */
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