<?php
$valid = true; // at the end we will proceed to the next page only if valid is true

$postErrorMessage = array();
$postSuccessMessage = array();


foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.

    if (empty($_POST[$key])) {   
        $valid = false;
    }
}


if ($valid == true) {
    if (isset($_POST['content'])){

      $postSuccessMessage[] = "The post was successfully added to database.";
    }
}
else { // this means one or more of the fields are empty. (valid is not true)
    $postErrorMessage[] = "Please fill all the fields.";
}

 