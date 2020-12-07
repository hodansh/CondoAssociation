<?php

    session_start();
    echo "Welcome ". $_SESSION['userName'];
    include_once "../validation/admin-dashboard-validation.php";
?>
<html>
<head>
    <title>Welcome to admin-dashboard</title>
</head>
<body>
<p>You can register a new member here!</p>

    <form name="registrationForm" method="post" action="">

               
    <div class="table">
            <div class="form-head"><p>Register here:</p></div>
            <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($registerErrorMessage) && is_array($registerErrorMessage) && isset($_POST["registrationForm"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($registerErrorMessage as $msg) {
                        echo $msg . "<br/>";
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- TODO: Show error messages here: -->
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div>
                <label>Username</label>
                <div>
                    <input type="text" class="input_textbox" name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>">
                    <!-- the php code that was written after value= helps preserving input for when a admin put wrong input -->
                    <!-- for each of the input textboxs, whatever name that we chose will be used to get the input for that
                    text box. for example we refere to $_POST['userName'] to get the value of user input for username -->
                </div>
                
                <div>
                <label>Password</label>
                <div><input type="password" class="input_textbox" name="password" value=""></div>
                </div>
                <div>
                <label>Confirm Password</label>
                    <div>
                    <input type="password" class="input_textbox" name="confirm_password" value="">
                    </div>
                </div>
                <div>
                    <label>Email</label>
                    <div>
                        <input type="text" class="input_textbox" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>
                    
                </div>
                <div>
                    <label>Address</label>
                    <div>
                        <input type="text" class="input_textbox" name="address" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
                    </div>
                </div>
                
                <div>
                    <label>Priviledge</label>
                    <div>
                        <input type="text" class="input_textbox" name="priviledge" value="<?php if (isset($_POST['priviledge'])) echo $_POST['priviledge']; ?>">
                    </div>
                </div>
                <div>
                    <label>Status</label>
                    <div>
                        <input type="text" class="input_textbox" name="status" value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>">
                    </div>
                </div>
                <div>
                    <input type="submit" name="registrationForm" value="register" class="btnRegister">
                </div>
            </div>
            </form>
</body>        
</html>