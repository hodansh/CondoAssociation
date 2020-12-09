


<?php
session_start();
include "././database_operations.php";
$valid = true; // at the end we will proceed to the next page only if valid is true
$logInErrorMessage = array();
$registerErrorMessage = array();
$loginSuccessMessage= array();
$priviledgeMessage= array();

foreach ($_POST as $key => $value) { // if any of the fields are empty the user has to fix it.

    if (empty($_POST[$key])) {   
        $valid = false;
    }
}

if ($valid == true) {
    if (strcasecmp($_POST['userName'], 'admin')==0 && $_POST['password'] == 'admin') { // if this is admin
         $_SESSION["userName"] = "admin";
         echo "<script type='text/javascript'>window.location.href = '../dashboards/admin-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to dashboard    
     }
     // -------------------------------------------------------------------------------------------------------------
// TODO:
// Compare the values of email input and password with database members, if it matches you should take the user to the user page.
// You should use authentication function

// -------------------------------------------------------------------------------------------------------------

        
            if(memberIsActive($_POST['userName'])==true){
                
            
            
        if (findMember($_POST['userName'])!= "not found!"){
            if(findPassword($_POST['password'])!= "not found!"){
                if(userPassMatch($_POST['userName'],$_POST['password'])==true){
                    $loginSuccessMessage[]= "User logged in";
                
                }
                
                if(findPriviledge($_POST['userName'])== true){
                    $priviledgeMessage="User is a member";
                    $_SESSION["userName"] = $_POST['userName'];

                    
                    echo "<script type='text/javascript'>window.location.href = '../dashboards/member-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to  member dashboard    
                }
                else{
                  //  echo "<script type='text/javascript'>window.location.href = '../dashboards/admin-dashboard.php?idh={$idh}&ajax_show=experience';</script>"; //navigate to   dashboard  

                }
            
          }
     }

    }
    else if(memberIsActive($_POST['userName'])!=true){
        $priviledgeMessage[]="User is inactive! Cannot login!";
     }
     else {
       // If we reach here then both username and password fields were filled out and are not empty.
         $logInErrorMessage[] = "Your username/email/password is not correct!";
     }
}
// -------------------------------------------------------------------------------------------------------------
else { // this means one or more of the fields are empty. (valid is not true)
    $logInErrorMessage[] = "All fields are required.";
}
?>
