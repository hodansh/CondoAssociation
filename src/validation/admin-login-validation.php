<?php
$valid = true; // at the end we will proceed to the next page only if valid is true

$logInErrorMessage = array();
$registerErrorMessage = array();

foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.

    if (empty($_POST[$key])) {   
        $valid = false;
    }
}

if ($valid == true) {
    if (strcasecmp($_POST['adminUserName'], 'admin')==0 && $_POST['adminPassword'] == 'admin') { // if this is admin
         $_SESSION["userName"] = "admin";
         echo "<script type='text/javascript'>window.location.href = '../dashboards/admin-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
     } else {
       // If we reach here then both username and password fields were filled out and are not empty.
         $logInErrorMessage[] = "Your username/password is not correct!";
     }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
    $logInErrorMessage[] = "All fields are required.";
}
// -------------------------------------------------------------------------------------------------------------
// every check was passed!
// if ($valid == true && !strcasecmp($_POST['userName'], 'admin')==0) {
//     $_SESSION["userName"] = $AuthenticationResult[2]; // we set this session variable and will use refer to it on the next pages. (see dashboard pages after welcome word!)
//     $userType = $AuthenticationResult[1]; // Based on the table that the username was found in, we will have to show either Employer dashboard or Employee dashboard
//     switch ($userType) {
//         case "employer":
//             $_SESSION['employerId'] = findAnEmployer($_SESSION['userName'])[0];
//             echo "<script type='text/javascript'>window.location.href = '../dashboards/employer_dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
//             break;
//         case "employee":
//             $_SESSION['employeeId'] = findAnEmployee($_SESSION['userName'])[0];
//             echo "<script type='text/javascript'>window.location.href = '../dashboards/employee_dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
//             break;
//     }
// }
foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.

    if (empty($_POST[$key])) {   
        $valid = false;
    }
}

if ($valid == true) {
    if ($_POST['confirm_password'] != $_POST['password']){
           $registerErrorMessage[] = "Password does not match!";
         } 
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
    $registerErrorMessage[] = "All fields are required.";
}