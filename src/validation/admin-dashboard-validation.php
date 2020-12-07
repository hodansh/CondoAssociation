<?php
$valid = true; // at the end we will proceed to the next page only if valid is true


$registerErrorMessage = array();
$successMessage =array();
foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.
  if (empty($_POST[$key])) {
    $valid = false;
  }
}

if ($valid == true) {

  if ($_POST['confirm_password'] != $_POST['password']) {
    $registerErrorMessage[] = "Password does not match!";
  }
  else{
    // We put the function that handles adding the user to the db
    $successMessage[] = "The user was successfully added to database.";
  }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
  $registerErrorMessage[] = "All fields are required.";
}

