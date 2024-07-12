
		
        <?php

        setcookie('access_token', '', time() - 3600, '/');
        header("location:login.php");
        ?>
