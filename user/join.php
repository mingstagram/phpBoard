<?php include("../layout/header.php");?>

<div class="container">
    <form>
        <div class="mb-3 mt-3">
            <label for="email">Email</label> <input type="email" class="form-control" placeholder="Enter Email"
                id="email">
        </div>
        <div class="mb-3 mt-3">
            <label for="password">Password</label> <input type="password" class="form-control"
                placeholder="Enter password" id="password">
        </div>
        <div class="mb-3 mt-3">
            <label for="username">UserName</label> <input type="text" class="form-control" placeholder="Enter UserName"
                id="username">
        </div>
        <div class="form-group form-check"></div>
    </form>
    <button class="btn btn-primary" onclick="join()">회원가입</button>
</div>
<script src="/js/user.js"></script>
<?php include("../layout/footer.php");?>