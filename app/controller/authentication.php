<?php require(ROOT .'app/model/User.php'); ?>

<?php 
$User = new User();


if(isset($_POST['loginEmail']) && isset($_POST['loginPassword'])){
    $login_result = $User->login($_POST['loginEmail'], $_POST['loginPassword']);

    if($login_result != null && !is_string($login_result)){
        $_SESSION['loggedInStatus'] = true;
        $_SESSION['user'] = $login_result;
        header("Location: /furreverfriends/home");
    } else {
        if ($login_result === "email_not_found") {
            echo "<script>alert('Invalid email or password.');</script>";
        } else if ($login_result === "incorrect_password") {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    }
}

// Signup
// Signup
if(isset($_POST['signupEmail'])){
    $signup_result = $User->signup($_POST['signupName'], $_POST['signupEmail'], $_POST['signupPassword'], $_POST['signupPhone'], $_POST['signupDob'],$_POST['signupState'], $_POST['signupCity']);
    
    if ($signup_result === true) {
        echo "<script>alert('Signup Successful!');</script>";
    } elseif ($signup_result === "email_exists") {
        echo "<script>alert('Email already exists! Please use a different email.');</script>";
    } elseif ($signup_result === "phone_exists") {
        echo "<script>alert('Phone number already exists! Please use a different phone number.');</script>";
    } else {
        echo "<script>alert('Signup Failed!');</script>";
    }
}



// Logout
// Logout
if(isset($_GET['logout']) && $_GET['logout'] == true){
    $_SESSION['loggedInStatus'] = false;
    $_SESSION['user'] = null;
    session_destroy();
    header("Location: /furreverfriends/authentication");
}

?>

<?php require(ROOT .'app/resources/view/authentication.php'); ?> 





