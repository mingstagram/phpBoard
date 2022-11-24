<?php
    class Pagination {

        public $list_num; // 한 페이지 당 데이터 갯수
        public $page_num; // 한 블럭 당 페이지 수

        function paging_proc($total, $page){
            /* paging : 전체 페이지 수 = 전체 데이터 / 페이지당 데이터 개수, ceil : 올림값, floor : 내림값, round : 반올림 */
            $total_page = ceil($total / $this->list_num);

            /* paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수 */
            $total_block = ceil($total_page / $this->page_num);

            /* paging : 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수 */
            $now_block = ceil($page / $this->page_num);

            /* paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1 */
            $s_pageNum = ($now_block - 1) * $this->page_num + 1;

            // 데이터가 0개인 경우
            if($s_pageNum <= 0){
                $s_pageNum = 1;
            };

            /* paging : 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수 */
            $e_pageNum = $now_block * $this->page_num;
            // 마지막 번호가 전체 페이지 수를 넘지 않도록
            if($e_pageNum > $total_page){   
                $e_pageNum = $total_page;
            };

            /* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
            $start = ($page - 1) * $this->list_num;

            $page_arr = array(
                "s_pageNum" => $s_pageNum,
                "e_pageNum" => $e_pageNum,
                "total_page" => $total_page,
                "start" => $start
            );

            return $page_arr;

        }


    }

    
?>