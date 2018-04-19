<?php 
include_once("includes/header.inc.php");
include_once("classes/User.class.php");
    
if (!empty($_POST)){
        try {
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setFirstname($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setPassword($_POST['password']);
        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>

<div class="register">
    <h2>Sign up for an account</h2>

<?php if ( isset($message)): ?>
        <div class="error">
            <label for="error"> <?php echo $message; ?>  </label>
        </div>
        <?php endif;?>

<form action="" method="post">
    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">
    <br>
    <label for="lastname">lastname</label>
    <input type="text" name="lastname" id="lastname">
    <br>
    <label for="email">email</label>
    <input type="text" name="email" id="email">
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br>
    <button type="submit">submit</button>
</form>
</div>

</body>
</html>
