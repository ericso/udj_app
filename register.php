<?php  
// register.php  
  
require_once 'app/php/includes/global.inc.php';  
  
//initialize php variables used in the form  
$username = "";  
$password = "";  
$password_confirm = "";  
$email = "";  
$error = "";  

$logger->log("In register.php", 3);

// check to see that the form has been submitted  
if (isset($_POST['submit-form'])) {   
    $logger->log("Submitting the form", 3);

    // retrieve the $_POST variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    $email = $_POST['email'];

    $logger->log("Got the variables: " . $username . ", " . $password . ", " . $password_confirm . ", " . $email , 3);
  
    // initialize variables for form validation
    $success = true;
    $userTools = new UserTools();
  
    // validate that the form was filled out correctly
    // check to see if user name already exists
    if ($userTools->checkUsernameExists($username)) {
        $logger->log("Username already exists", 3);

        $error .= "That username is already taken.<br/> \n\r";
        $success = false;
    }
  
    // check to see if passwords match
    if ($password != $password_confirm) {
        $logger->log("passwords don't match", 3);

        $error .= "Passwords do not match.<br/> \n\r";
        $success = false;
    }

    if ($success) {  
        // prep the data for saving in a new user object
        $data['us_username'] = $username;
        $data['us_password'] = md5($password); // encrypt the password for storage
        $data['us_email'] = $email;
  
        // create the new user object
        $newUser = new User($data);
  
        //save the new user to the database
        $newUser->save(true);
  
        // log them in
        $userTools->login($username, $password);

        // redirect them to a welcome page
        header("Location: welcome.php");
    }
}

// If the form wasn't submitted, or didn't validate
// then we show the registration form again
?>  
  
<html>  
<head>  
    <title>Registration</title>  
</head>  
<body>  
    <?php echo ($error != "") ? $error : ""; ?>  
    <form action="register.php" method="post">  
  
    Username: <input type="text" value="<?php echo $username; ?>" name="username" /><br/>
    Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>
    Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>
    E-Mail: <input type="text" value="<?php echo $email; ?>" name="email" /><br/>
    <input type="submit" value="Register" name="submit-form" />
  
    </form>
</body>
</html>