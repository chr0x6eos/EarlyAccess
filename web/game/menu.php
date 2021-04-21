<?php
if(isset($_POST['logout'])){
    session_destroy();
    header('Location: index.php');
}
?>
<form method='post' action="">
            <input type="submit" value="Logout" name="logout">
</form>