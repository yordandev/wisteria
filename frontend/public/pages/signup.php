<?php
if (isset($_POST['signUpEmail']) && isset($_POST['signUpPassword'])) {
    $signUpData =  array(
        "email" => htmlspecialchars($_POST['signUpEmail'], ENT_QUOTES),
        "password" => htmlspecialchars($_POST['signUpPassword'], ENT_QUOTES)
    );

    $signUpError = '';

    $getSignupUserData = callAPI('POST', 'http://68.183.14.165:3000/signup', json_encode($signUpData));
    $signUpResponse = json_decode($getSignupUserData, true);

    if ($signUpResponse['error']) {
        $signUpError = $signUpResponse['error'];
    }

    if ($signUpResponse['user']) {
        $signUpUser = $signUpResponse['user'];
        session_regenerate_id();
        $_SESSION['csrfToken'] = bin2hex(random_bytes(32));
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['lastaccess'] = time();
        $_SESSION['userId'] = $signUpUser['id'];
        $_SESSION['userEmail'] = $signUpUser['email'];
        $_SESSION['userType'] = $signUpUser['type'];
        $_SESSION['userToken'] = $signUpResponse['token'];

        echo "<script>window.location.href = '/'</script>";
    }
}
?>

<div id="signUpPage">
    <form action="" method="POST">
        <?php $signUpError ? print("<p style='color: red; margin-bottom: 48px;'>{$signUpError}</p>") : '' ?>
        <input type="email" name="signUpEmail" id="signUpEmail" required placeholder="Email" minlength="5">
        <input type="password" name="signUpPassword" id="signUpPassword" required placeholder="Password" minlength="8" maxlength="32">
        <input type="password" id="signUpConfirmPassword" required placeholder="Confirm Password" minlength="8" maxlength="32">
        <input type="hidden" name="token" value="<?php echo $csrfToken; ?>" />
        <button type="submit">Join us</button>
    </form>
</div>