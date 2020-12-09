
<?php
include_once "../database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true


$registerErrorMessage = array();
$successMessage = array();
foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.
  if (empty($_POST[$key])) {
    $valid = false;
  }
}

if (!isset($error_message)) {
  if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { //This is a server-side validation for correct email format from PHP 
    $registerErrorMessage[] = "Invalid email address.";
      $valid = false;
  }
}

if ($valid == true) {

  if (findMember($_POST['email'])!= "not found"){
    $registerErrorMessage[] = "A member with this email address already exist in the database!";
$valid = false;
  }


  if ($_POST['confirm_password'] != $_POST['password']) {
    $registerErrorMessage[] = "Password does not match!";
  } else {
    if ($valid == true && isset($_POST['registrationForm'])) {
      $_SESSION["userName"] = $_POST["userName"]; // we set this session variable and will use refer to it on the next pages. (see dashboard pages after welcome word!)
      AddMember($_POST["userName"], $_POST["password"],  $_POST["address"], $_POST["email"], $_POST["status"], $_POST["priviledge"], $_POST["postID"], $_POST["postStatus"]);
    }
  }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
  $registerErrorMessage[] = "All fields are required.";
}




