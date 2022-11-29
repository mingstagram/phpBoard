<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHPBOARD</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>
<?php 
    session_start();
    $header_menu = '';
    if($_SESSION['session_id'] == null){
        $header_menu .= '<li class="nav-item">';
        $header_menu .= '<a class="nav-link" href="/index_login/login.php">로그인</a>';
        $header_menu .= '</li>';
        $header_menu .= '<li class="nav-item">';
        $header_menu .= '<a class="nav-link" href="/user/join.php">회원가입</a>';
        $header_menu .= '</li>">';
    } else {
        $header_menu .= '<li class="nav-item">';
        $header_menu .= '<a class="nav-link" href="/board/write_form.php">글쓰기</a>';
        $header_menu .= '</li>';
        $header_menu .= '<li class="nav-item">';
        $header_menu .= '<a class="nav-link" href="/index_login/logout.php">로그아웃</a>';
        $header_menu .= '</li>';
        $header_menu .= '<li class="nav-item">';
        $header_menu .= '<a class="nav-link" href="/logtest.php">에러로그</a>';
        $header_menu .= '</li>';
    }
?>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PHPBOARD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <?= $header_menu ?>
                </ul>
                <form class="d-flex">
                    <input type="hidden" name="page" id="page" value="1">
                    <input class="form-control me-2" type="text" placeholder="Search" name="search" id="search">
                    <button class="btn btn-primary" type="button" onclick="searchBoard();">Search</button>
                </form>
            </div>
        </div>
    </nav>