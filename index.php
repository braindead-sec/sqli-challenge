<?php
// Connect to database
$dbhost = "localhost";
$dbname = "sqlidemo";
$dbuser = "demo";
$dbpass = "youllneverguessmypassword";
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$authorized = false;

// Get user input
if (!empty($_POST)) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    // Validate user
    $query = 'SELECT * FROM users WHERE username="'.$user.'" AND password="'.$pass.'"';
    $result = mysqli_query($db, $query);
    if (!$result) {
        $error = mysqli_error($db);
    } else if (mysqli_num_rows($result) > 0) {
        $authorized = true;
        $rows = mysqli_fetch_assoc($result);
        $user = $rows['username'];
        $pass = $rows['password'];
    } else {
        $query = 'SELECT * FROM users WHERE username="'.$user.'"';
        $result = mysqli_query($db, $query);
        if (!$result || mysqli_num_rows($result) == 0) {
            $error = "Invalid username.";
        } else {
            $error = "Invalid password.";
        }
    }
    // Close database connection
    mysqli_close($db);
}
?>

<!-- Render HTML-->
<!DOCTYPE html>
<html>
<head>
<style>
* {
    margin: 0;
    padding: 0;
}
body {
    background: gray;
}
div {
    width: 75%;
    margin-left: auto;
    margin-right: auto;
    background-color: white;
    padding: 50px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.35);
}
form.login {
    display: block;
    width: 400px;
    margin-top: 20%;
    margin-left: auto;
    margin-right: auto;
    padding: 40px;
    background: white;
    color: black;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.35);
}
h2 {
    font-family: Tahoma, sans-serif;
    font-size: 24px;
    margin-bottom: 18px;
}
p {
    font-family: Tahoma, sans-serif;
    font-size: 15px;
    margin-bottom: 4px;
}
.error {
    margin-top: 12px;
    padding: 4px 6px;
    background-color: red;
    color: white;
    font-weight: bold;
    border-radius: 4px;
}
.hint {
    font-size: 14px;
    font-style: italic;
    text-align: center;
    color: white;
    margin: 20px 0;
}
label {
    display: inline-block;
    width: 90px;
}
input {
    padding: 7px 14px;
    border: none;
    border-radius: 4px;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.35);
}
input[type=submit] {
    background-color: blue;
    color: white;
    font-weight: bold;
    box-shadow: none;
    cursor: pointer;
}
input.logout {
    position: absolute;
    right: 13%;
    top: 50px;
}
</style>
</head>
<body>

<!-- Login page -->
<?php if (!$authorized) { ?>
    <form class="login" method="POST">
        <h2>Please log in:</h2>
        <p><label>Username:</label><input type="text" name="username" value="<?php if(!empty($user)) echo $user;?>"></p>
        <p><label>Password:&nbsp;</label><input type="password" name="password" value="">&nbsp;
        <input type="submit" value="Go"></p>
        <?php if(!empty($error)) echo '<p class="error">'.$error.'</p>';?>
    </form>
    <p class="hint">The goal of this challenge is to guess a valid user
    <br>and log in without knowing the password.
    <br>Use SQL injection to bypass authentication!</p>

<!-- Successful injection page -->
<?php } else if ($_POST['username'] != $user || $_POST['password'] != $pass) { ?>
    <div>
        <h2>Welcome <?php echo $user;?>!</h2>
        <p>Congratulations on completing the SQL injection challenge!</p>
        <p>You have successfully bypassed authentication security.</p>
        <p>&nbsp;</p>
        <p><img src="hackerman.jpg" alt="Hackerman!" style="width: 100%"></p>
        <form><input class="logout" type="submit" value="Logout"></form>
    </div>

<!-- Normal user home page -->
<?php } else {?>
     <div>
        <h2>Welcome <?php echo $user;?>!</h2>
        <p>Congratulations on remembering your password.</p>
        <p>You didn't pass the challenge, however. Try again!</p>
        <p>&nbsp;</p>
        <form><input class="logout" type="submit" value="Logout"></form>
    </div>

<?php } ?>

</body>
</html>
