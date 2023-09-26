<?php
    session_start();
    include('db_config.php');
    if (!isset($_SESSION['email'])) {
        header("Location: login.html");
        exit();
    }

    $email = $_SESSION['email'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];

    // $servername = "localhost";
    // $username = "root"; 
    // $password = ""; 
    // $dbname = "true_profile"; 

    // // Create a connection
    // $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // prepare and bind
    $stmt = $conn->prepare("UPDATE registration SET facebook =?, twitter=?, instagram=?, linkedin=? WHERE email = ?");
    $stmt->bind_param("sssss", $facebook, $twitter, $instagram, $linkedin, $email);
    $stmt->execute();

    echo '<script type ="text/JavaScript">
        alert("New records created successfully.") 
        </script>'; 
        header("Location: upload.html");
    $stmt->close();
    // Close the connection
    $conn->close();
?>
