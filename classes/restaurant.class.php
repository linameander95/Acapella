<?php
class restaurant {

function login() {
    $db = mysqli_connect('studentmysql.miun.se', 'lime1603', 'eqscXDazWD', 'lime1603') or die('Fel vid anslutning');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT id, username, password FROM user WHERE username = ?";
            
            if($stmt = mysqli_prepare($db, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){                
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                session_start();
                                
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                header("location: mypages.php");
                            } else{
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } else{
                        $login_err = "Invalid username or password.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                mysqli_stmt_close($stmt);
            }
        }
        
        mysqli_close($db);
    }
}

function logout() {
    session_start();
     
    $_SESSION = array();
     
    session_destroy();
     
    header("location: login.php");
    exit;
        }

function register() {
    $db = mysqli_connect('studentmysql.miun.se', 'lime1603', 'eqscXDazWD', 'lime1603') or die('Fel vid anslutning');
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["username"]))){
            $username_err = "Fyll i ett användarnamn.";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
            $username_err = "Ditt användarnamn kan bara innehålla bokstäver och nummer.";
        } else{
            $sql = "SELECT id FROM user WHERE username = ?";
            
            if($stmt = mysqli_prepare($db, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                $param_username = trim($_POST["username"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "Detta användarnamn är upptaget.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Hoppsan! Något gick fel, försök igen senare.";
                }
    
                mysqli_stmt_close($stmt);
            }
        }
        
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            
            $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
             
            if($stmt = mysqli_prepare($db, $sql)){
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); 
                
                if(mysqli_stmt_execute($stmt)){
                    header("location: login.php");
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }
        
        mysqli_close($db);
    }
}
}
?>