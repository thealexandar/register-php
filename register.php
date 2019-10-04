<?php
require "classes/Users.php";

$users = new Users;
$reg = $users->register();

print_r($reg);
?>
<?php include_once 'includes/header.php'; ?>

        <div class="register">
            <div class="header text-center mb-5">
                <h3>Please Register</h3>
            </div>
            <form method="post" action="register.php" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter full name" value=<?php echo $reg['name']; ?>>
                  <small id="emailHelp" class="form-text text-muted error"><?php echo $reg['name_err']; ?></small>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted error"><?php echo $reg['email_err']; ?></small>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" value=<?php echo $reg['password']; ?>>
                    <small id="emailHelp" class="form-text text-muted error"><?php echo $reg['password_err']; ?></small>
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Repeat password" value=<?php echo $reg['confirm_password']; ?>>
                    <small id="emailHelp" class="form-text text-muted error"><?php echo $reg['confirm_password_err']; ?></small>
                  </div>
                  <div class="form-group">
                    <input type="text" name="number" class="form-control" id="exampleInputPassword1" placeholder="Enter number" value=<?php echo $reg['number']; ?>>
                    <small id="emailHelp" class="form-text text-muted error"><?php echo $reg['number_err']; ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlFile1" class="custom-btn">Upload your CV</label>
                    <input type="file" name="cv" class="form-control-file" id="exampleFormControlFile1">
                    <small id="emailHelp" class="form-text text-muted error"><?php echo $reg['cv_err']; ?></small>
                  </div>
                <button type="submit" class="btn btn-primary-outline button">Submit</button>
                <small class="error form-text text-muted"></small>
              </form>
        </div>
<?php include_once 'includes/footer.php'; ?>