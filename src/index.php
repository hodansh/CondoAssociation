<html>

<head>
    <title>Welcome to Career-Portal</title>
    <link href="./css/style.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
</head>

<body>

    <form name="signUpForm" method="post" action="">
        <!-- we handle the form after submission in formVerification.php -->
        <div class="table">
            <div class="form-head">Sign up here:</div>
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- TODO: Show error messages here: -->
            <!--  ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div>
                <label>Username</label>
                <div>
                    <input type="text" class="input_textbox" name="userName" value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>">
                    <!-- the php code that was written after value= helps preserving user input for when a user put wrong input -->
                    <!-- for each of the input textboxs, whatever name that we chose will be used to get the user input for that
                    text box. for example we refere to $_POST['userName'] to get the value of user input for username -->
                </div>
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



                <label>Please select your membership preference:</label>
                <div>
                    <select name="MembershipType" id="membership_selection">
                        <!-- This is a drop-down menu. $_POST['MembershipType] will give you the value of selected option after form submission. -->
                        <option hidden disabled selected value> -- select an option -- </option>
                               
                    </select>
                </div>
                <div>
                    <label>Email</label>
                    <div>
                        <input type="text" class="input_textbox" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>
                </div>
                <div>
                    <label>Company (optional for employees)</label>
                    <div>
                        <input type="text" class="input_textbox" name="company" value="<?php if (isset($_POST['company'])) echo $_POST['company']; ?>">
                    </div>
                </div>
                <div>
                    <label>Telephone</label>
                    <div>
                        <input type="text" class="input_textbox" name="tel" value="<?php if (isset($_POST['tel'])) echo $_POST['tel']; ?>">
                    </div>
                </div>
                <div>
                    <label>Postal Code</label>
                    <div>
                        <input type="text" class="input_textbox" name="postalCode" value="<?php if (isset($_POST['postalCode'])) echo $_POST['postalCode']; ?>">
                    </div>
                </div>
                <div>
                    <label>City</label>
                    <div>
                        <input type="text" class="input_textbox" name="city" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>">
                    </div>
                </div>
                <div>
                    <label>Address</label>
                    <div>
                        <input type="text" class="input_textbox" name="address" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">
                    </div>
                </div>
                </br>



                <div>
                    <input type="submit" name="signUpFrom" value="signUp" class="btnRegister">
                </div>
            </div>
        </div>
    </form>


    <div style="text-align: center;">
        <p>Already on Career-Portal? &nbsp;&nbsp;
            <a href="sign_in.php">Sign in</a>
        </p>
    </div>


</body>

</html>