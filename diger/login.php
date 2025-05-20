<form method="post" action="login.php">
    <label>User Name: </label>
    <input type="text" name="username" ><br><br>

    <label>Password: </label>
    <input type="password" name="password" ><br><br>

    <button type="submit">Login</button>
</form>     

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $correct_username = 'admin';
    $correct_password = '3169';

    if($username == $correct_username && $password == $correct_password) {
        echo "Login successful! Welcome, $username.";
    } else {
        echo "Invalid username or password.";
    }
}
?>


