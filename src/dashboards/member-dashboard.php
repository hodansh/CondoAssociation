<?php
include_once "../validation/member-post-validation.php";
session_start();
echo "Welcome " . $_SESSION['userName'];

?>
<html>

<head>
    <link href="../css/styles.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->
    
    <title>Welcome to member-dashboard</title>


</head>

<body>
    <br/>
    <p1><b>You can add a post here: </b></p1>

    <form name="postForm" method="post" action="">
   
      <?php // to show error messages about bad inputs, we would have to show them on top of the page. Error messages are created in formValidation page
            if (!empty($postErrorMessage) && is_array($postErrorMessage) && isset($_POST["postForm"])) {
            ?>
                <div class="error-message">
                    <?php
                    foreach ($postErrorMessage as $msg) {
                        echo $msg . "<br/>";
                    }

                    ?>
                </div>
            <?php
            }
            ?>
            <?php // to show success messages about bad inputs, we would have to show them on top of the page. Success messages are created in formValidation page
            if (!empty($postSuccessMessage) && is_array($postSuccessMessage) && isset($_POST["postForm"])) {
            ?>
                <div class="success-message">
                    <?php
                    foreach ($postSuccessMessage as $msg) {
                        echo $msg . "<br/>";
                    }

                    ?>
                </div>
            <?php
            }
            ?>
    
 <textarea id="post" rows="30" cols="70" name="comment" value="<?php if (isset($_POST['comment'])) echo $_POST['comment']; ?>">
</textarea>

  <input type="submit" name="postForm" value="Submit">
        
</form>
        
</body>
</html>