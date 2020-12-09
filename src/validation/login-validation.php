


<?php
session_start();
include "././database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true
$logInErrorMessage = array();
$registerErrorMessage = array();
$loginSuccessMessage = array();
$priviledgeMessage = array();

foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.

    if (empty($_POST[$key])) {
        $valid = false;
    }
}

if ($valid == true) {
    if (strcasecmp($_POST['userName'], 'admin') == 0 && $_POST['password'] == 'admin') { // if this is admin
        $_SESSION["userName"] = "admin";
        echo "<script type='text/javascript'>window.location.href = '../dashboards/admin-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
    }
    // -------------------------------------------------------------------------------------------------------------
    // TODO:
    // Compare the values of email input and password with database members, if it matches you should take the user to the user page.
    // You should use authentication function

    // -------------------------------------------------------------------------------------------------------------


    if (memberIsActive($_POST['userName']) == true) {
        $member = findMember($_POST['userName']);
        if ($member != "not found!") {
            $password_from_db = $member[2];
            if ($password_from_db == $_POST['password']) {
                $loginSuccessMessage[] = "User logged in";
                $_SESSION['userID'] = $member[0];
                $_SESSION['email'] = $_POST['userName'];
            }
            else{
                $valid=false;
                $logInErrorMessage[] = "Your password is not correct, please check!";
            }
        }
    } else if (memberIsActive($_POST['userName']) != true) {
        $valid = false;
        $priviledgeMessage[] = "User is inactive! Cannot login!";
    } else {
        // If we reach here then both username and password fields were filled out and are not empty.
        $logInErrorMessage[] = "Your username/email/password is not correct!";
    }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
 $valid = false;
    $logInErrorMessage[] = "All fields are required.";
}

if($valid == true && isset($_POST)) {
if (userIsMember($_POST['userName']) == true) {

   echo "<script type='text/javascript'>window.location.href = '../dashboards/member-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to  member dashboard    
} else {
    echo "<script type='text/javascript'>window.location.href = '../dashboards/admin-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to   dashboard  

}
}
?>
