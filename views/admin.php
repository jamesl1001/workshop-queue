<header>
    <div class="centre">
        <img src="/img/admin.png" alt="Padlock" id="header-img"/>
        <div id="header-info">
            <h1 id="header-title">Admin Login</h1>
            <p>Enter the admin password to login.</p>
        </div>
    </div>
</header>

<div id="main">
    <div class="centre">
        <form action="" method="post">
            <label for="login-password">Password</label> <input type="password" name="login-password" autofocus required/>
            <input type="submit" name="login-submit" value="Login"/>
        </form>

        <?php
        require_once('php/Admin.php');

        if(!empty($_POST['login-submit'])) {
            if(!empty($_POST['login-password'])) {
                $response = Admin::login($_POST['login-password']);
                echo $response;
            } else {
                echo '<p class="error">Please enter a password.</p>';
            }
        }
        ?>
    </div>
</div>