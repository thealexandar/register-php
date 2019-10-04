<?php include_once 'includes/header.php'; ?>
<?php
$log = $users->login();


?>
<div class="register">
    <div class="header text-center mb-5">
        <h3>Login</h3>
    </div>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted error"><?php echo $log['email_err']; ?></small>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" value=<?php echo $log['password']; ?>>
            <small id="emailHelp" class="form-text text-muted error"><?php echo $log['password_err']; ?></small>
        </div>
        <button type="submit" class="btn btn-primary-outline button">Submit</button>
    </form>
</div>

<?php include_once 'includes/footer.php'; ?>