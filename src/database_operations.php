<?php
session_start();

$host = "database"; // service name from docker-compose.yml
$user = "devuser";
$password = "devpass";
$db = "test_db";
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};
// echo "Successfully connected to MySQL";

// After this line, if we get no errors, that means we are connected to the database. We refer to the database instance by $conn

function AddMember($name, $password, $address, $email, $status, $priviledge, $postID, $postStatus) // adding new employer to the table
{
    global $conn;
    $sql =
        "INSERT INTO Member
    (Name, Password,Address,Email,Status,Priviledge,PostID,PostStatus) 
    VALUES ('$name','$password','$address','$email', '$status','$priviledge',$postID,'$postStatus');";
    mysqli_query($conn, $sql);
    // if(!$results){
    //     echo 'true';
    // }
}

function memberExists($email_input) // To check if a username/email input is already taken in Emloyer table
// This method will return an array[boolean,boolean], the first boolean is true when username was taken and
// the second one is true for when the email taken.
{
    $email_taken = false;
    global $conn; // we need to globalize $conn inside our function, otherwise function will not have access to it and will give errors.

    $sql_member_email = "SELECT * FROM Member WHERE Email='$email_input'";
    $res_member_email = mysqli_query($conn, $sql_member_email);

    if (mysqli_num_rows($res_member_email) > 0) {  //if the username is found, the number of rows for the result would not be zero
        $email_taken = true;
    }
    $result = $email_taken;
    return $result;
}



//     $sql = "INSERT INTO Employer 
//          (UserName, UserPassword, Email, Company, Telephone, PostalCode, City, Address, EmployerCategoryId,Status)
//      VALUES ('$userName','$userPassword','$Email','$Company', '$Telephone','$PostalCode','$City','$Address',$EmployerCategoryId,'$Status');";
//     $results = mysqli_query($conn, $sql);
// }
function getAllMembers() // adding new employer to the table
{
    global $conn;
    $sql =
        "Select * From Member;";
        $result = mysqli_query($conn, $sql);
        return $result;
}
