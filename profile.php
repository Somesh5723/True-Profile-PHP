<?php
  session_start();
  include('db_config.php');
  if (!isset($_SESSION['email'])) {
      header("Location: login.html");
      exit();
  }

  $email = $_SESSION['email'];
  
  // select * from student join studentclass WHERE student.sclass = studentclass.cid
  // where email='".$_SESSION['email']."'"
  
  $sql = "select * from registration where email = '$email'";
  $result = mysqli_query($conn, $sql) or die("Query unsuccessful");

  if(mysqli_num_rows($result) >0) {
  
  // Checking for connections
  // if ($mysqli->connect_error) {
  //     die('Connect Error (' .
  //     $mysqli->connect_errno . ') '. $mysqli->connect_error);
  // }
  
  // header('Location : upload.html');
  // // SQL query to select data from database
  // $sql = " SELECT * FROM registration where email = '$email' ";
  // $result = $mysqli->query($sql);
  // $mysqli->close();
?>


<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <link rel="stylesheet" type="text/css" href="css/profile.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7c13529dde.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    while($row = mysqli_fetch_assoc($result)) {    
  ?>

  <main>
    <div class="logo">
      <a href="index.html"><img src="./images/logo2.jpg" alt=""></a>

      <a href="logout.php" id="close"><strong>x</strong></a>
    </div>

      <section class="profile-info"> 
        <div class="profile-picture">
          <?php echo "<img src='uploadImg/{$row['image']}' "; ?>
        </div>

        <div class="profile-details">
          <!-- Name -->
          <p><strong><?php echo $row['username']; ?>  &nbsp;<i class="fa-sharp fa-solid fa-circle-check"></i></strong></p>
          <!-- Designation -->
          <p style="color: rgb(226, 190, 46);"><?php echo $row['designation']; ?></p>
        </div>
      </section>
    

    <section class="table-section">
      <table class="table table-sm">
        
          <tr style="text-align: center;">
          <!-- add number  -->
          <?php $phone =  $row['contact']; ?>
            <th scope="col" id="call"><a href="tel:<?php echo $row['contact']; ?>"><img src="./images/telephone.png" alt=""></a></th>
            <th scope="col" id="direction"><a id="whatsapp-them"><img src="./images/whatsapp.png" alt=""></a></th>
            <th scope="col" id="mail"><a href="mailto:<?php echo $email; ?>"><img src="./images/gmail.png" alt=""></a></th>
          </tr>        
      </table>
    </section>

    <!-- <section class="data-img">
    
      // echo "<img src='uploadImg/{$row['image']}' "; 
    </section> -->

    <section class="profile-bio">
      <p>
        <?php echo $row['bio']; ?>
      </p>
    </section>

    <section id="social-work">
      <div class="s-img"><?php echo "<br><img src='userImg/{$row['upload_image1']}' "; ?></div>
      <div class="s-img"><?php echo "<br><img src='userImg/{$row['upload_image2']}' "; ?></div>
      <div class="s-img"><?php echo "<br><img src='userImg/{$row['upload_image3']}' "; ?></div>
      <div class="s-img"><?php echo "<br><img src='userImg/{$row['upload_image4']}' "; ?> </div>
      <div class="s-img"><?php echo "<br><img src='userImg/{$row['upload_image5']}' "; ?> </div>
    </section>

    <section class="address">
      <p>---------------</p>
      <p>-: Address :-</p>
      <!-- <p>-------------</p> -->
      <p><?php echo $row['location']; ?></p>
    </section>

    <section >
      <div id="s-icons">
        <div><a href="<?php echo $row['facebook']; ?>" class="icon" target="_blank"><img src="./images/facebook.png" alt=""></a></div>
        <div><a href="<?php echo $row['instagram']; ?>" class="icon" target="_blank"><img src="./images/instagram.png" alt=""></a></div>
        <div><a href="<?php echo $row['twitter']; ?>" class="icon" target="_blank"><img src="./images/twitter.png" alt=""></a></div>
        <div><a href="<?php echo $row['linkedin']; ?>" class="icon" target="_blank"><img src="./images/linkedin.png" alt=""></a></div>
      </div>
    </section>


    <footer>
      <p>&copy; 2023 Kal-Pra TechMedia Business Services</p>
    </footer>

    <section class="add-btn">
      <div class="addOn">
        <button id="whatsappButton"><i class="fa-solid fa-share-from-square"></i></button>
        <button onclick="upload()" id="upload"><i class="fa-solid fa-user-pen"></i></button>
        <button onclick="registeration()" id="new-register"><i class="fa-solid fa-circle-plus"></i></button>
      </div>
    </section>    
  </main>

  

  <script>
        // redirection to the whatsapp on the proper number
        const phone = <?php echo $row['contact']; ?>;
        // const phoneNumber = `${phone}`;
        const whatsappLk = `https://wa.me/${phone}`;
        const linkElement = document.getElementById("whatsapp-them");
        linkElement.href = whatsappLk;

        // add url link and share it through whatsapp
        const currentURL = encodeURIComponent(window.location.href);
        const whatsappButton = document.getElementById("whatsappButton");
        whatsappButton.addEventListener("click", () => {
            // Construct the WhatsApp share link
            const whatsappLink = `whatsapp://send?text=${currentURL}`;
            // Open the WhatsApp link in a new tab/window
            window.open(whatsappLink);
        });

    function registeration(){
      window.location.href = "register.html";
    }

    function upload(){
      window.location.href = "upload.html";
    }
  </script>

  <?php
     } // closing while
   } // closing fetch assocs
  ?>

</body>
</html>
