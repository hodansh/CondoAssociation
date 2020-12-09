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

function AddMember($name, $password, $address, $email, $status, $priviledge) // adding new employer to the table
{
    global $conn;
    $sql =
        "INSERT INTO Member
    (Name, Password,Address,Email,Status,Priviledge) 
    VALUES ('$name','$password','$address','$email', '$status','$priviledge');";
    mysqli_query($conn, $sql);
}

function AddPost( $postStatus,$content,$memberID) // adding new employer to the table
{
    global $conn;
    $sql =
    "INSERT INTO Post
    (PostStatus,Content,MemberID) 
    VALUES ('$postStatus','$content','$memberID');";
    mysqli_query($conn, $sql);

}

function getAllMembers() // adding new member to the table
{
    global $conn;
    $sql =
        "Select * From Member;";
        $result = mysqli_query($conn, $sql);
        return $result;
}
function getAllPosts() // adding new member to the table
{
    global $conn;
    $sql =
        "Select * From Post;";
        $result = mysqli_query($conn, $sql);
        return $result;
}



function findMember($emailInput)
{
    global $conn;
    $sql = "SELECT * FROM Member WHERE Email='$emailInput'";
  
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one email was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where Email matched
            $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
            return $row;
           
            
        }
        return "not found!";
        
    }
}

function findPassword($passwordInput)
{
    global $conn;
    $sql = "SELECT * FROM Member WHERE Password='$passwordInput'";
    $idPass="SELECT MemberID FROM Member WHERE Password='$passwordInput'";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one password was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where password matched
            $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
            return $row;
            return $idPass;
        }
        return "not found!";
        
    }
}
function userPassMatch($emailInput,$passwordInput){
    global $conn;
    $sql="SELECT Password FROM Member WHERE Email='$emailInput'";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one email was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where Email matched
            if($row[0]==$passwordInput){
                return true;
            }
          
        }
    }
  
}
// function findPriviledge($priviledgeInput)
// {
//     global $conn;
//     $sql = "SELECT * FROM Member WHERE Priviledge='$priviledgeInput'";
//     if ($result = $conn->query($sql)) {
//         if (mysqli_num_rows($result) > 0) { // if at least one priviledge was matched
//             $row = $result->fetch_row(); // this will get one full row of database for Member where priviledge matched
//             $result->free_result(); // This will free the memory that was dedicated to preserve the result of the query
//             return $row;
//         }
//         return "not found!";
//     }
// }

function findPriviledge($emailInput){
    global $conn;
    $sql="SELECT Priviledge FROM Member WHERE Email='$emailInput'";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one email was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where Email matched
            echo $row[0];
            if($row[0]=="member"){
                return true;
            }
          
        }
    }
  
}


function memberIsActive($emailInput){
    global $conn;
    $sql="SELECT Status FROM Member WHERE Email='$emailInput'";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one email was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where Email matched
            
            if($row[0]=="active"){
                return true;
            }
          
        }
    }
  
}






// This function either returns a member or a string that says "not found"

function authentication($emailInput, $passwordInput)
{
    $isMatched = false;
       
    $match_member = findMember($emailInput);
    if ($match_member != "not found") {
        if (strcasecmp($match_member[4], "$emailInput") == 0 && $match_member[2] == "$passwordInput") { // strcasecmp will compare two strings case-insensitively, 
            // example: strcamsecmp(ABC,abc) will return 0userNameInput
            $isMatched = True;
            return $match_member;
        }
    }
    return ["did not match"]; // This is where the username or password was not a match to the database
}

function deleteMemberByEmail($emailInput)
{
    global $conn;
    $message = "We could not find any member with email= $emailInput.";
    if (findMember($emailInput) != "not found!") {
        $sql = "DELETE FROM Member WHERE Email='$emailInput';";
        if ($result = $conn->query($sql)) {
            $message = "$emailInput was successfully deleted from Members.";
        }
    }
    return $message;
}

