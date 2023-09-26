<?php
    include('db_config.php');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $image = $_FILES['image_upload'];
    $image_name=$image['name'];
    $image_tmp_name=$image['tmp_name'];          // temp file path
    $destination="uploadImg/".$image_name;      // Folder path Where Image saved
    
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    move_uploaded_file($image_tmp_name , $destination);  

    if($password === $confirm_password){
        // $conn = new mysqli('localhost','root','','true_profile');
        if($conn->connect_error)
        {
            die('Connection Failed : '.$conn->connect_error);
        }
        else
        {
            $stmt = $conn->prepare("insert into registration(username, email, designation, image, contact, location, password, confirm_password)
            values(?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss",$username, $email, $designation, $image_name, $contact, $location, $password, $confirm_password);
            $stmt->execute();

            echo '<script type ="text/JavaScript">
                  alert("Registration has been done successfully")
                  </script>'; 
                  header("Location: login.html");
            $stmt->close();
            $conn->close();     
        }
    }else{
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Password & Confirm Password should be same, try again !")';  
        echo '</script>';  
        header("Location: register.html");
    }
   
?>