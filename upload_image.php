<?php
    session_start();
    include('db_config.php');
    if (!isset($_SESSION['email'])) {
        header("Location: login.html");
        exit();
    }

    $image1 = $_FILES['file1'];
    $image_name1=$image1['name'];
    $image_tmp_name1 =$image1['tmp_name'];
    $destination1="userImg/".$image_name1;
    $email = $_SESSION['email'];
    move_uploaded_file($image_tmp_name1 , $destination1); 

    $image2 = $_FILES['file2'];
    $image_name2=$image2['name'];
    $image_tmp_name2 =$image2['tmp_name'];
    $destination2="userImg/".$image_name2;
    $email = $_SESSION['email'];
    move_uploaded_file($image_tmp_name2 , $destination2); 

    $image3 = $_FILES['file3'];
    $image_name3=$image3['name'];
    $image_tmp_name3 =$image3['tmp_name'];
    $destination3="userImg/".$image_name3;
    $email = $_SESSION['email'];
    move_uploaded_file($image_tmp_name3 , $destination3); 

    $image4 = $_FILES['file4'];
    $image_name4=$image4['name'];
    $image_tmp_name4 =$image4['tmp_name'];
    $destination4="userImg/".$image_name4;
    $email = $_SESSION['email'];
    move_uploaded_file($image_tmp_name4 , $destination4); 

    $image5 = $_FILES['file5'];
    $image_name5=$image5['name'];
    $image_tmp_name5 =$image5['tmp_name'];
    $destination5="userImg/".$image_name5;
    $email = $_SESSION['email'];
    move_uploaded_file($image_tmp_name5 , $destination5); 


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // prepare and bind
    $stmt = $conn->prepare("UPDATE registration SET upload_image1 = ?, upload_image2 = ?, upload_image3 = ?, upload_image4 = ?,upload_image5 = ? WHERE email = ?");
    $stmt->bind_param("ssssss", $image_name1, $image_name2, $image_name3, $image_name4, $image_name5, $email);
    $stmt->execute();

    // echo '<script type ="text/JavaScript">
    //     alert("New records created successfully.") 
    //     </script>'; 
        header("Location: upload.html");
    $stmt->close();
    // Close the connection
    $conn->close();
?>
