<?php
function emptyInputSignup($name, $email, $pwd, $cpwd){
    $result;
    if(empty($name) || empty($email) || empty($pwd) || empty($cpwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $name, $email) {
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        session_start();
        $_SESSION["message"] = "Username already exists.";
        header("location: ../signup.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $pwd, $cpwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        session_start();
        $_SESSION["message"] = "Database failed.";
        header("location: ../signup.php");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../home.php");
    exit();
}

function createpost($conn, $title, $text, $img, $usersname, $userimg, $date){
    $sql = "INSERT INTO posts (title, postText, img, usersName, usersImg, postDate) VALUES ('$title', '$text', '$img', '$usersname', '$userimg', '$date');";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("location: ../home.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("location: ../createpost.php");
    }
}

function emptyInputLogin($name, $pwd){
    $result;
    if(empty($name) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $name, $pwd){

    $uidExists = uidExists($conn, $name, $name);

    if($uidExists === false){
        session_start();
            $_SESSION["message"] = "Username doesn't exist.";
            header("location: ../login.php");
            exit();
    }
    else{
        $pwdHashed = $uidExists["usersPwd"];
        $checkPwd = password_verify($pwd, $pwdHashed);
        //problem
        if ($checkPwd === false){
            session_start();
            $_SESSION["message"] = "The password is incorrect.";
            header("location: ../login.php");
            exit();
        }
        else if ($checkPwd === true){
            session_set_cookie_params();
            session_start();
            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["username"] = $uidExists["usersName"];
            $_SESSION["userimg"] = $uidExists["usersImg"];
            $_SESSION["userinfo"] = $uidExists["usersInfo"];
            $_SESSION["verified"]   = $uidExists["verified"];
            header("location: ../home.php");
            exit();
        }
    }   
}

function displayPosts($conn){
    $query = "SELECT * FROM posts ORDER BY postID DESC";

    if ($result = $conn->query($query)) {

        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $username = $row["usersName"];
            $userimg = $row["usersImg"];
            $title = $row["title"];
            $text = $row["postText"];
            $img = $row["img"];
            $date = $row["postDate"];
            $likes = $row["likes"];
            
            $query2 = "SELECT * FROM users WHERE usersName = '$username'";
            if ($result2 = $conn->query($query2)) {
                $row2 = $result2->fetch_assoc();
            }

            $username = $row2["usersName"];
            $userimg = $row2["usersImg"];

            echo "<div class='feed'>" .
            "<a href='profiles-all.php?username=" . $username . "' style='text-decoration: none; text-align:left; position:relative; right: auto;'>" . 
            "<img src='" . $userimg . "' id='feedimg1' >";
            if($row2["verified"]){
                echo "<h4 class='verified'>" . $username . "<i class='fa-solid fa-circle-check' style='--fa-animation-duration: 1s;  position: relative; top: -1em; left: 0.5em; font-size: 50%; color:#7bdff2;'></i> </h4>";
            }
            else{
                echo "<h4>" . $username . "</h4>";
            }

            echo "</a>";
            echo
            "<h3>". $title . "</h3>" .
            "<p>". $text . "</p>" .
            "<p style='opacity: 50%; margin-top: 30px; font-size: 0.8em;'>". $date . "</p>" .
            "<div class='feedimg2'>" .
            "<img src='" . $img . "'>" .
            "</div>"
            . "<div class='interactions'> <a href='includes/likepost.inc.php?id= " . $row["postID"] . " '><i id='like' class='"; 
            if (strstr($row['likes'], $_SESSION["username"])){
                echo "fa-solid fa-heart like'></i></a> <a><i class='fa-regular fa-message'></i></a> <a><i class='fa-regular fa-bookmark'></i></a> </div>";
            }
            else{
                echo "fa-regular fa-heart like'></i></a> <a><i class='fa-regular fa-message'></i></a> <a><i class='fa-regular fa-bookmark'></i></a> </div>";
            }
            echo "<p>Liked by: " . $row['likes'] . " </p>";
            if($_SESSION){
                if($row2["usersName"] == $_SESSION["username"]){
                    echo "<a id='delete' href='includes/deletepost.inc.php?pid=" . $row["postID"] . "'><i class='fa-solid fa-trash'></i> Delete post.</a>";
                }
            };
            echo "</div>";
        }
    
        /* free result set */
        $result->free();
    }
}

function displayPostsUser($conn, $username){
    $query = "SELECT * FROM posts WHERE usersName = '$username' ORDER BY postID DESC";

    if ($result = $conn->query($query)) {

        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $username = $row["usersName"];
            $userimg = $row["usersImg"];
            $title = $row["title"];
            $text = $row["postText"];
            $img = $row["img"];
            $date = $row["postDate"];
            $postID = $row["postID"];
            
            $query2 = "SELECT * FROM users WHERE usersName = '$username'";
            if ($result2 = $conn->query($query2)) {
                $row2 = $result2->fetch_assoc();
            }

            $username = $row2["usersName"];
            $userimg = $row2["usersImg"];

            echo "<div class='feed'>" .
            "<a href='profiles-all.php?username=" . $username . "' style='text-decoration: none; text-align:left; position:relative; right: auto;'>" . 
            "<img src='" . $userimg . "' id='feedimg1' >";
            if($row2["verified"]){
                echo "<h4 class='verified'>" . $username . "<i class='fa-solid fa-circle-check' style='--fa-animation-duration: 1s;  position: relative; top: -1em; left: 0.5em; font-size: 50%; color:#7bdff2;'></i> </h4>";
            }
            else{
                echo "<h4>" . $username . "</h4>";
            }

            echo "</a>";

            echo
            "<h3>". $title . "</h3>" .
            "<p>". $text . "</p>" .
            "<p style='opacity: 50%; margin-top: 30px; font-size: 0.8em;'>". $date . "</p>" .
            "<div class='feedimg2'>" .
            "<img src='" . $img . "'>" .
            "</div>"
            . "<div class='interactions'> <a href='includes/likepost.inc.php?id= " . $row["postID"] . " '><i id='like' class='"; 
            if (strstr($row['likes'], $_SESSION["username"])){
                echo "fa-solid fa-heart like'></i></a> <a><i class='fa-regular fa-message'></i></a> <a><i class='fa-regular fa-bookmark'></i></a> </div>";
            }
            else{
                echo "fa-regular fa-heart like'></i></a> <a><i class='fa-regular fa-message'></i></a> <a><i class='fa-regular fa-bookmark'></i></a> </div>";
            }
            echo "<p>Liked by: " . $row['likes'] . " </p>";
            if($_SESSION){
                if($row2["usersName"] == $_SESSION["username"]){
                    echo "<a id='delete' href='includes/deletepost.inc.php?pid=" . $row["postID"] . "'><i class='fa-solid fa-trash'></i> Delete post.</a>";
                }
            };
            echo "</div>";
            
        }
    
        /* free result set */
        $result->free();
    }
}

function displayUserSneakers($conn, $username){
    $query = "SELECT sneakers FROM users WHERE usersName = '$username'";

    if ($result = $conn->query($query)) {

        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $sneakerList = $row["sneakers"];
            $sneakers = explode (", ", $sneakerList);
            return $sneakerList;

        };
        $result->free();
    }
}

function displayUsers($conn){
    $query = "SELECT * FROM users ORDER BY verified DESC, usersId ASC";

    if ($result = $conn->query($query)) {

        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $username = $row["usersName"];
            $userimg = $row["usersImg"];
            
            echo    "<a style='text-decoration:none;' href='profiles-all.php?username=" . $row["usersName"] . "'><div class='userlist'> 
                    <img  src='" . $userimg . "'>";
                    if(isset($row["verified"])){
                      echo "<h4 class='verified'>". $username ."<i class='fa-solid fa-circle-check' style='--fa-animation-duration: 1s;  position: relative; top: -1em; left: 0.5em; font-size: 40%; color:#7bdff2;'></i> </h4>";
                    }
                    else{
                      echo "<h4 style='font-weight: bold;'>". $username ."</h4>";
                    }
            echo "</div></a>";
        }
    
        /* free result set */
        $result->free();
    }
}


