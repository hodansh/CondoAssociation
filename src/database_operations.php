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

function AddPost($postStatus, $content, $memberID) // adding new employer to the table
{
    global $conn;
    $sql =
        "INSERT INTO Post
    (PostStatus,Content,MemberID) 
    VALUES ('$postStatus','$content',memberID);";
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
function getPrivatePosts($memberid) // adding new member to the table
{
    global $conn;
    $sql = "Select * From Post WHERE MemberID='$memberid'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getPublicPosts() // adding new member to the table
{
    global $conn;
    $sql = "Select * From Post WHERE PostStatus='Public'";
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




function userIsMember($emailInput)
{
    global $conn;
    $sql = "SELECT Priviledge FROM Member WHERE Email='$emailInput'";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one email was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where Email matched
            echo $row[0];
            if ($row[0] == "member") {
                return true;
            }
            return false;
        }
    }
}


function memberIsActive($emailInput)
{
    global $conn;
    $sql = "SELECT Status FROM Member WHERE Email='$emailInput'";
    if ($result = $conn->query($sql)) {
        if (mysqli_num_rows($result) > 0) { // if at least one email was matched
            $row = $result->fetch_row(); // this will get one full row of database for Member where Email matched
            if ($row[0] == "active") {
                return true;
            }
            return false;
        }
    }
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

function activateUser($memberIDinput)
{
    $message = "The member was already active or the member id is not correct!";
    global $conn;
    
        $sql = "UPDATE Member
        SET Status = 'active'
        WHERE MemberID = $memberIDinput;";
        if($conn->query($sql)){
        $message = "successfully activated the member with ID= $memberIDinput";
        }    
    return $message;
}
function inactivateUser($memberIDinput)
{
    $message = "The member was already inactive or the member id is not correct!";
    global $conn;
    
        $sql = "UPDATE Member
        SET Status = 'inactive'
        WHERE MemberID = $memberIDinput;";
        if($conn->query($sql)){
        $message = "successfully inactivated the member with ID= $memberIDinput";
        }    
    return $message;
}
