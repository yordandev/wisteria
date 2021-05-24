<?php
if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
    $loginData =  array(
        "email" => htmlspecialchars($_POST['loginEmail'], ENT_QUOTES),
        "password" => htmlspecialchars($_POST['loginPassword'], ENT_QUOTES)
    );

    $loginError = '';

    $getLoginUserData = callAPI('POST', 'http://68.183.14.165:3000/login', json_encode($loginData));
    $loginResponse = json_decode($getLoginUserData, true);

    if ($loginResponse['error']) {
        $loginError = $loginResponse['error'];
    }

    if ($loginResponse['user'][0]) {
        $loginUser = $loginResponse['user'][0];
        // session_regenerate_id();
        $_SESSION['csrfToken'] = bin2hex(random_bytes(32));
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['lastaccess'] = time();
        $_SESSION['userId'] = $loginUser['id'];
        $_SESSION['userEmail'] = $loginUser['email'];
        $_SESSION['userType'] = $loginUser['type'];
        $_SESSION['userToken'] = $loginResponse['token'];

        echo "<script>window.location.href = '/'</script>";
    }
}
?>

<div id="loginPage">
    <form action="" method="POST">
        <?php $loginError ? print("<p style='color: red; margin-bottom: 48px;'>{$loginError}</p>") : '' ?>
        <input type="email" name="loginEmail" id="loginEmail" required placeholder="Email" minlength="5">
        <input type="password" name="loginPassword" id="loginPassword" required placeholder="Password" minlength="8" maxlength="32">
        <button type="submit">Login</button>
    </form>
    <p>
        Don’t have an account? <a href="/?page=signup">Join us</a>
    </p>
</div>