
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

if ($valid == true) {

  if ($_POST['confirm_password'] != $_POST['password']) {
    $registerErrorMessage[] = "Password does not match!";
  } else {
    // We put the function that handles adding the user to the db
    $successMessage[] = "The user was successfully added to database.";
  }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
  $registerErrorMessage[] = "All fields are required.";
}


// every check was passed!
if ($valid == true && isset($_POST['registrationForm'])) {
  $_SESSION["userName"] = $_POST["userName"]; // we set this session variable and will use refer to it on the next pages. (see dashboard pages after welcome word!)
  // AddMember($_POST["userName"], $_POST["password"],  $_POST["address"], $_POST["email"], $_POST["status"], $_POST["priviledge"], $_POST["postID"], $_POST["postStatus"]);
  // echo 'should be added!';
  echo('the user email we are looking for: '. memberExists("Ali@gmail.com"));
  // Tartibe ina ba function fargh dare, hover kon rooye esme function mibini. aval emaile baad address      
  //echo "<script type='text/javascript'>window.location.href = '../dashboards/admin-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to   dashboard    
}
