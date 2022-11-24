<?php
    include("layout/header.php"); 
    $filename = "log_test.log";
    $fp = fopen($filename, "r") or die("로그 파일을 찾을수 없습니다.");
    $fr = fread($fp, 20);
?>
<div clsss="container">
    <h2 style="text-align:center;"><?= $filename ?></h2>
</div>
<div class="container">
    <div class="card m-1" style="height:300px;overflow:auto;" id="scroll">
        <?php 
            $i = 0;
            while( !feof($fp)){
                echo $i.":  ".fgets($fp)."<br>";
                $i++;
            }
            fclose($fp);
        ?>
    </div>
    <input type="button" onclick="scrollTop1()" value="새로고침">
</div>


<script>
// 기본 스크롤 위치 제일 하단
document.getElementById('scroll').scrollTop = document.getElementById('scroll').scrollHeight;

function scrollTop1() {
    location.reload();
}
</script>
<?php include("layout/footer.php");?>