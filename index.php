<?php  
    include("layout/header.php");  
    require_once("db/connect.php");
    include("util/pagination.php");
    $connEntity = new Connect();
    $pageEntity = new Pagination();

    $conn = $connEntity->load_connect(); 
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchText = $_GET['search'];  
    $searchQuery = $searchText != null ? "&search=".$searchText : '';
    $response = Array();
    $sql = "SELECT count(*) as board_count FROM board_tb  WHERE 1 = 1";
    if($searchText != null) $sql .= " AND BOARD_TITLE LIKE '%".$searchText."%'"; 

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total = $row['board_count']; 
    /* paging : 현재 페이지 */
    $pageEntity->list_num = 2; // 한 페이지 당 데이터 갯수
    $pageEntity->page_num = 3; // 한 블럭 당 페이지 수
    $page = isset($_GET["page"])? $_GET["page"] : 1;  
    $page_arr = $pageEntity->paging_proc($total, $page);
    $start = $page_arr['start'];
    $s_pageNum = $page_arr['s_pageNum'];
    $e_pageNum = $page_arr['e_pageNum'];
    $total_page = $page_arr['total_page'];
    $list_num = $pageEntity->list_num;

    $sql = "SELECT * FROM board_tb";
    if($searchText != null) $sql .= " WHERE BOARD_TITLE LIKE '%".$searchText."%'"; 
    $sql .= " ORDER BY BOARD_ID desc LIMIT $start, $list_num"; 
    $result = mysqli_query($conn, $sql);

    /* paging : 글번호 */
    $cnt = $start + 1;
    
    $list = '';
    while($row = mysqli_fetch_array($result)){
        $list .= '<div class="card m-1" >';
        $list .= '<div class="card-body">';
        $list .= '<h4 class="card-title">'.$row['BOARD_TITLE'].'</h4>';
        $list .= '<a href="board/board_detail?id='.$row['BOARD_ID'].'" class="btn btn-primary">상세보기</a>';
        $list .= '<h6 style="float:right">조회수 : '.$row['BOARD_COUNT'].'</h6>'; 
        $list .= '</div>';
        $list .= '</div>';
    }

    $pageHtml = '';
    if($page <= 1){
        $pageHtml .= '<li class="page-item disabled"><a class="page-link" href="/?page=1'.$searchQuery.'">&laquo;</a></li>';
    } else {
        $pageHtml .= '<li class="page-item"><a class="page-link" href="/?page='.($page-1).$searchQuery.'">&laquo;</a></li>';
    }
    
    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
        if($print_page == $page){
            $pageHtml .= '<li class="page-item active"><a class="page-link" href="/?page='.$print_page.$searchQuery.'">'.$print_page.'</a></li>';
        } else {
            $pageHtml .= '<li class="page-item"><a class="page-link" href="/?page='.$print_page.$searchQuery.'">'.$print_page.'</a></li>';
        }
        
    }

    if($page >= $total_page){
        $pageHtml .= '<li class="page-item disabled"><a class="page-link" href="/?page='.$total_page.$searchQuery.'">&raquo;</a></li>';
    } else {
        $pageHtml .= '<li class="page-item"><a class="page-link" href="/?page='.($page+1).$searchQuery.'">&raquo;</a></li>';
    } 
?>

<div class="container">
    <div class="d-flex flex-row-reverse ">
        <div class="form-group">
            <select id="pageUnit" name="pageUnit">
                <option value="10">10개씩 보기</option>
                <option value="20">20개씩 보기</option>
                <option value="30">30개씩 보기</option>
            </select>
        </div>
    </div>
    <?= $list ?>
    <ul class="pagination justify-content-center">
        <?= $pageHtml ?>
    </ul>
</div>
<script src="/js/board.js"></script>
<?php include("layout/footer.php");?>