<?php

session_start();
echo "<p class='form-head'> Welcome " . $_SESSION['userName'] . "</p>";
include_once "../validation/admin-dashboard-validation.php";
include_once "../database_operations.php";
?>
<html>

<head>
    <link href="../css/styles.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->

    <title>Welcome to admin-dashboard</title>

</head>

<body>
    <a class="form-head2" href="../index.php" style="font-weight: 600; font-size:large"><br />Sign-out</a>

    <p class="form-head">You can register a new member here!</p>

    <form name="registrationForm" method="post" action="">


        <div class="table">
            <div class="form-head">
                <p>Register here:</p>
            </div>
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
            <?php // to show success messages about bad inputs, we would have to show them on top of the page. Success messages are created in formValidation page
            if (!empty($successMessage) && is_array($successMessage) && isset($_POST["registrationForm"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($successMessage as $msg) {
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
                <table>
                    <tr>

                        <div>
                            <label>Priviledge</label>
                            <div>
                                <select name="priviledge" id="priviledge">
                                    <!-- This is a drop-down menu. $_POST['priviledge] will give you the value of selected option after form submission. -->
                                    <option hidden disabled selected value> -- select an option -- </option>
                                    <option value="member">Member</option>
                                    <option value="admin">Administrator</option>

                            </div>
                    </tr>



                    <tr>
                        <div>
                            <label>Status</label>
                            <div>
                                <select name="status" id="status">
                                    <!-- This is a drop-down menu. $_POST['status] will give you the value of selected option after form submission. -->
                                    <option hidden disabled selected value> -- select an option -- </option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>

                            </div>

                        </div>
                    </tr>






                    <div>
                        <input type="submit" name="registrationForm" value="register" class="btnRegister">
                    </div>
            </div>
    </form>



    <form name="showAllMembers" method="post" action="">
        <div class="table">
            <label style="font-weight:200 ;">Click to see all the members: </label>
        </div>
        <div>
            <input type="submit" name="showAllMembers" value="Show All Members" class="btnRegister">
        </div>
    </form>
    <?php



    if (isset($_POST["showAllMembers"])) { //show all the members:
        $_SESSION["showAllMembers"] = getAllMembers();


        if (isset($_SESSION["showAllMembers"])) {

            echo "<div  class=form-head2 style='font-size: large;'>All the entries in Member table:</div><br>
        
        <table style='width: 1000px;' > <tr>
        <td styles>Name</td>
        <td>Password</td>
        <td>Adress</td>
        <td>Email</td>
        <td>Status</td>
        <td>Priviledge</td>
        <td> PostID</td>
             
        
        </tr>";
            foreach ($_SESSION["showAllMembers"] as $row) {
                foreach ($row as $key => $value) {
                    if ($key == "MemberID") {
                        echo "<tr>";
                    } else {
                        echo "<td> $value";

                        if ($key == "Priviledge") {
                            echo "</tr>";
                        }
                    }
                }
            }
            echo "</table>";
        } else {
            echo "<h3 class=form-head2 style='font-size: large;'>No member could be found</h3><br>"; // Because no results found in Member.
        }
    }

    ?>


<form name="deleteMemberByEmail" method="post" action="">
        <div class="table">
            <label style="font-weight:200 ;">Enter the email address of the member you want to delete! </label>
        </div>
        <div>
        <input type="text" class="input_textbox" name="emailInputForDeletion" value="<?php if (isset($_POST['emailInputForDeletion'])) echo $_POST['emailInputForDeletion']; ?>">
        </div>
        <div>
            <input type="submit" name="deleteMemberByEmail" value=Delete Member by Email" class="btnRegister">
        </div>
    </form>
<?php
    if (isset($_POST["deleteMemberByEmail"])) { //show all the members:
             $message=  deleteMemberByEmail($_POST["emailInputForDeletion"]);
             echo "<p class='form-head'>".$message."</p>";
        }

        ?>
</body>

</html>