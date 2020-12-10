<?php
include_once "../validation/member-post-validation.php";
include_once "../database_operations.php";
session_start();
echo "Welcome " . $_SESSION['email'];

?>
<html>

<head>
    <link href="../css/styles.css?version=52" rel="stylesheet" type="text/css" /> <!-- link to css file -->

    <title>Welcome to member-dashboard</title>


</head>

<body>
    <br />
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

        <div>
            <table>
                <tr>
                    <div>
                        <label>PostStatus</label>
                        <div>
                            <select name="postStatus" id="postStatus" <?php if (isset($_POST['postStatus'])) echo $_POST['postStatus']; ?>>
                                <!-- This is a drop-down menu. $_POST['postStatus] will give you the value of selected option after form submission. -->
                                <option hidden disabled selected value> -- select an option -- </option>
                                <option value="private">Private</option>
                                <option value="public">Public</option>

                        </div>
                        <div>
                </tr>
                <tr>

                    <div>
                </tr>
            </table>


            <textarea id="post" rows="30" cols="70" name="content" value="<?php if (isset($_POST['content'])) echo $_POST['content']; ?>">
</textarea>

            <input type="submit" name="postForm" value="Submit">

    </form>
    <form name="showPrivatePosts" method="post" action="">
        <div class="table">
            <label style="font-weight:200 ;">Click to see your private posts: </label>
        </div>
        <div>
            <input type="submit" name="showPrivatePosts" value="Show my private Posts" class="btnRegister">
        </div>
    </form>
    <?php



    if (isset($_POST["showPrivatePosts"])) { //show all the tables:
        $myPrivatePosts = getPrivatePosts($_SESSION['userID']);


        if (isset($myPrivatePosts)) {

            echo "<div  class=form-head2 style='font-size: large;'>All the  private entries in Post table:</div><br>
        
        <table> 
        <tr>
        <td>PostStatus</td>
        <td>Content</td>
        <td>MemberID</td>
        
        </tr>";

            foreach ($myPrivatePosts as $row) {
                foreach ($row as $key => $value) {
                    if ($key == "PostID") {
                        echo "<tr>";
                    } else {
                        echo "<td> $value";

                        if ($key == "MemberID") {
                            echo "</tr>";
                        }
                    }
                }
            }
            echo "</table>";
        } else {
            echo "<h3 class=form-head2 style='font-size: large;'>No post could be found</h3><br>"; // Because no results found in Post.
        }
    }

    ?>
    </form>
    <form name="showPublicPosts" method="post" action="">
        <div class="table">
            <label style="font-weight:200 ;">Click to see the public posts: </label>
        </div>
        <div>
            <input type="submit" name="showPublicPosts" value="Show my public Posts" class="btnRegister">
        </div>
    </form>
    <?php
    if (isset($_POST["showPublicPosts"])) { //show all the tables:
        $myPublicPosts= getPublicPosts($_SESSION['userID']);
           

        if ($myPublicPosts) {

            echo "<div  class=form-head2 style='font-size: large;'>All the  Public entries in Post table:</div><br>

        <table> 
        <tr>
        <td>PostStatus</td>
        <td>Content</td>
        <td>MemberID</td>
        </tr>";


            foreach ($myPublicPosts as $row) {
                foreach ($row as $key => $value) {
                    if ($key == "PostID") {
                        echo "<tr>";
                    } else {
                        echo "<td> $value";

                        if ($key == "MemberID") {
                            echo "</tr>";
                        }
                    }
                }
            }
            echo "</table>";
        } else {
            echo "<h3 class=form-head2 style='font-size: large;'>No post could be found</h3><br>"; // Because no results found in Post.
        }
    }

    ?>


</body>

</html>