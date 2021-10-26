<?php

namespace App\Controller;

// require_once("HomeController.php");

if (isset($_POST['send'])) {
    $controller = new HomeController();
    $controller->postUser();
}
?>

<html>
<form method="post">
    <div style="text-align:center;margin-top:150px;">
        <p>Enter your first name here : </p>
        <input type="text" name="firstname" />
        <p>Enter your first last name here : </p>
        <input type="text" name="lastname" />
        <p>Enter your email here : </p>
        <input type="text" name="email" />
        <p>Enter your birthdate here </p>
        <input type="date" name="birthdate" />
        </br>
        <input value="Send" type="submit" name="send" style="margin-top:20px;" />
    </div>
</form>

</html>