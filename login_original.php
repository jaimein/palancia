<?php
include_once 'conexion.php';
include_once 'inc/functions.php';

sec_session_start();

if (login_check($conexion) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if (isset($_GET['error'])) {
    echo '<p class="error">Error Logging In!</p>';
}
?> 
<br/>
<form action="inc/process_login.php" method="post" name="login_form">                      
    Usuario: <input type="text" name="usuario" /><br/>
    Password: <input type="password" 
                     name="password" 
                     id="password"/>
    <input type="button" 
           value="Login" 
           onclick="formhash(this.form, this.form.password);" /> 
</form>

<?php
if (login_check($conexion) == true) {
    echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['usuario']) . '.</p>';

    echo '<p>Do you want to change user? <a href="inc/logout.php">Log out</a>.</p>';
} else {
    echo '<p>Currently logged ' . $logged . '.</p>';
    echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
}
?>