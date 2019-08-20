<?php
include_once 'header.php';

$msg = "";

if($_POST){
    $user = new User($db);
    $user->username = $_POST["username"];
    $user->password = $_POST["password"];
    $valid_user = $user->check_user();

    if($valid_user){
        header("Location: home.php", true, 301);
        exit();
    }else{
        $msg = "Invalid username/password."; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="padding:25px;">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <?php echo $msg; ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <!--form class="pure-form pure-form-aligned" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
            <div class="pure-control-group">
                <label for="name">Username</label>
                <input id="name" name="username" type="text" placeholder="Username">
                <span class="pure-form-message-inline"></span>
            </div>

            <div class="pure-control-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Password">
                <span class="pure-form-message-inline"></span>
            </div>

            <div class="pure-controls">
                <span class="pure-form-message" style="margin-bottom:10px;">
                <?php 
                    if(isset($err_msg)) 
                        echo $err_msg; 
                ?>
                </span>
                <button type="submit" class="pure-button pure-button-primary">Submit</button>
            </div>
        </fieldset>
    </form-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>