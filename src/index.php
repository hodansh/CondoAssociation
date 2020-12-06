<?php 
include_once "./validation/admin-login-validation.php";
?>


<html>
<head>
    <title>Welcome to CondoAssociation</title>
</head>
<body>
<h1> Welcome to CondoAssociation Admin Page</h1>
<form name="adminLoginForm" method="post" action="">
        
        <div class="table">
            <div class="form-head">Login here:</div> 
            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($logInErrorMessage) && is_array($logInErrorMessage) && isset($_POST["adminLoginForm"])) {
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
            
            <div>
                <label>Admin Username:</label>
                <div>
                    <input type="text" class="input_textbox" name="adminUserName" value="<?php if (isset($_POST['adminUserName'])) echo $_POST['adminUserName']; ?>">
                    <!-- the php code that was written after value= helps preserving user input for when a user put wrong input -->
                    <!-- for each of the input textboxs, whatever name that we chose will be used to get the user input for that
                    text box. for example we refere to $_POST['userName'] to get the value of user input for username -->
                </div>
            </div>

            <div>
                <label>Admin Password:</label>
                <div><input type="password" class="input_textbox" name="adminPassword" value=""></div>
            </div>
            <div>
                    <input type="submit" name="adminLoginForm" value="Login" class="btnRegister">
            </div>
             
 </body>           