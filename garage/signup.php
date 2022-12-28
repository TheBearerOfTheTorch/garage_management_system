<link rel="stylesheet" href="assets/css/popup_style.css"> 
           <style>
.footer1 {
  position: fixed;
  bottom: 0;
  width: 100%;
  color: #5c4ac7;
  text-align: center;
}

</style>



   <?php
   
include('./constant/layout/head.php');
  include('./constant/connect.php');
session_start();

if(isset($_SESSION['userId'])) {
 //header('location:'.$store_url.'login.php');   
}

$errors = array();

if($_POST['create_user']) {    

  $username = $_POST['username'];
  $password = $_POST['password'];

  if(empty($username) || empty($password)) {
    if($username == "") {
      $errors[] = "Username is required";
    } 

    if($password == "") {
      $errors[] = "Password is required";
    }
  } else {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $connect->query($sql);

    if($result->num_rows == 1) {
      $password = md5($password);
      // exists
      $mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $mainResult = $connect->query($mainSql);

      if($mainResult->num_rows == 1) {
        $value = $mainResult->fetch_assoc();
        $user_id = $value['user_id'];

        // set session
        $_SESSION['userId'] = $user_id;?>

      

         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success 
            </h1>
            <p>Sign up Successfully</p>
            <p>
            
            <?php echo "<script>setTimeout(\"location.href = 'client_dashboard.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
            <?php  }  
              else{
                ?>


                <div class="popup popup--icon -error js_error-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Error 
            </h1>
            <p>Incorrect username/password combination</p>
            <p>
              <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
            </p>
          </div>
        </div>
       
      <?php } // /else
    } else { ?> 
        <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Username doesnot exists</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>  
         
    <?php } // /else
  } // /else not empty username // password
  
} // /if $_POST

?>
    
    <div id="main-wrapper">
        <div class="unix-login">
          <div class="container-fluid" style="background-image: url('./assets/uploadImage/Logo/service.jpg');
          background-color: #cccccc;  background-position: center;
            background-repeat: no-repeat;
            background-size: cover;   height: 100%;">

            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-4 ml-auto">
                        <div class="login-content">
                            <div class="login-form">
                                <center><img src="./assets/uploadImage/Logo/logo.jpg" style="width: 100%;"></center><br>
                                <form class="form-horizontal" method="POST"  id="submitUserForm" action="php_action/createUser.php" enctype="multipart/form-data">

                                   <input type="hidden" name="currnt_date" class="form-control">

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Username</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="userName" id="username" class="form-control" placeholder="Username" required="" pattern="^[a-zA-z0-9]+$"/>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                 <input type="password" class="form-control" id="upassword" placeholder="Password" name="upassword">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                  <input type="email" class="form-control" id="uemail" placeholder="Email" name="uemail">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="forgot-phone col-md-8 text-right">
                                          <a href="login.php" class="text-right f-w-600"> Back to login</a>
                                      </div>
                                       

                                        <button type="submit" name="create_user" id="createUserBtn" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="./assets/js/lib/jquery/jquery.min.js"></script>
    
    <script src="./assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="./assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="./assets/js/jquery.slimscroll.js"></script>
    
    <script src="./assets/js/sidebarmenu.js"></script>
    
    <script src="./assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    
    <script src="./assets/js/custom.min.js"></script>
</body>

</html>
