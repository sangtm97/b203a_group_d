<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = null; //Add new user
$_id = null;

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $userModel->findUserById($_id); //Update existing user
}

if (!empty($_POST['submit'])) {

    if (!empty($_id)) {
        $userModel->updateUser($_POST);
    } else {
        $userModel->insertUser($_POST);
    }
    header('location: list_users.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php'?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">

            <?php if ($user || !isset($_id)) {?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $_id ?>">
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input class="form-control" name="userName" placeholder="User Name" value="<?php if (!empty($user[0]['userName'])) {
    echo $user[0]['userName'];
}
    ?>">
                    </div>
                    <div class="form-group">
                        <label for="firstName">Full Name</label>
                        <input class="form-control" name="firstName" placeholder="First Name" value="<?php if (!empty($user[0]['firstName'])) {
    echo $user[0]['firstName'];
}
    ?>">
                    </div>
                   
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="Sex">Sex</label><br>
                        <input type="radio" name="sex" id="sex" value="Male">Male
                        <input type="radio" name="sex" id="sex" value="Female">Female
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="phone" name="phone" class="form-control" placeholder="Phone">
                    </div>                   
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else {?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
            <?php }?>
    </div>
</body>
</html>