<?php
    session_start();
    include('db_config.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //Database connection
    // $con = new mysqli("localhost","root","","true_profile");
    if($conn->connect_error)
    {
        die("Failed to connect : ".$conn->connect_error);
    }
    else
    {
        $stmt = $conn->prepare("select * from registration where email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();  
        if($stmt_result->num_rows > 0)
        {
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password) {
                echo '<script>alert("LogIn Successfully")</script>';
                $_SESSION["email"] = $email;
                header('Location: profile.php');       
            }
            else{
             echo "<h2>Invalid username or password</h2>";
                // $this->session->set_flashdata('message', 'This is a message.');
                // header('Location: login.html');   
            }
        }
        else
        {
                echo "<h2>Invalid username or password</h2>";
        }
    }
?>

<?php
// session_start();

// // Replace these with your actual username and password validation logic
// $validEmail = $_POST['email'];
// $validPassword = $_POST['password'];

// if (isset($_POST['email']) && isset($_POST['password'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     // $email = $_POST['email'];

//     if ($email === $validEmail && $password === $validPassword) {
//         // Valid credentials, set up the session
//         $_SESSION['email'] = $email;
//         header('Location: session_page.php');
//         exit();
//     } else {
//         // Invalid credentials, show an error message
//         echo "Invalid username or password.";
//     }
// }
?>

<?php


// session_start();
// require_once('db_config.php');

// if (isset($_POST['email']) && isset($_POST['password'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $query = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
//     $result = mysqli_query($conn, $query);

//     if (mysqli_num_rows($result) === 1) {
//         // Valid credentials, set up the session
//         $_SESSION['email'] = $email;
//         header('Location: session_page.php');
//         exit();
//     } else {
//         // Invalid credentials, show an error message
//         echo "Invalid username or password.";
//     }
// }
?>
