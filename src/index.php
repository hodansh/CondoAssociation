<?php 
if (is_array($_SESSION)) {
    $_SESSION = []; // if there's an existing session clear it!
}
session_start(); // session will keep the desired info (on the server) when user is navigating to other pages.

$_SESSION["userName"] = ""; //for example, when you register the user, you can use this variable to show his name on the welcome page (welcome USERNAME)

include_once "./validation/login-validation.php";
?>


<html>
<head>
<link href="../css/styles.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    <title>Welcome to CondoAssociation</title>
</head>
<body>
<h1> Welcome to CondoAssociation:</h1>
<form name="loginForm" method="post" action="">
        
        <div class="table">
            <div class="form-head">Login here:</div> 
            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($logInErrorMessage) && is_array($logInErrorMessage) && isset($_POST["loginForm"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($logInErrorMessage as $message) {
                        echo $message . "<br/>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($loginSuccessMessage) && is_array($loginSuccessMessage) && isset($_POST["loginForm"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($loginSuccessMessage as $message) {
                        echo $message . "<br/>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>

<?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($priviledgeMessage) && is_array($priviledgeMessage) && isset($_POST["loginForm"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($priviledgeMessage as $message) {
                        echo $message . "<br/>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>


            
            <div>
                <label> Email/Username:</label>
                <div>
                    <input type="text" class="input_textbox" name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>"> 
                    <!-- the php code that was written after value= helps preserving user input for when a user put wrong input -->
                    <!-- for each of the input textboxs, whatever name that we chose will be used to get the user input for that
                    text box. for example we refere to $_POST['userName'] to get the value of user input for username -->
                </div>
            </div>

            <div>
                <label>Password:</label>
                <div><input type="password" class="input_textbox" name="password" value=""></div>
            </div>
            <div>
                    <input type="submit" name="loginForm" value="Login" class="btnRegister">
            </div>
            </form>         
 </body>           