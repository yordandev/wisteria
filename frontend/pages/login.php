<?php
// if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
//     $loginData =  array(
//         "email" => $_POST['loginEmail'],
//         "password" => $_POST['loginPassword']
//     );

//     echo json_encode($loginData);
//     $get_data = callAPI('POST', 'http://68.183.14.165:3000/login', json_encode($loginData));
//     $response = json_decode($get_data, true);

//     echo $response[0];
// }

if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
    $loginData =  array(
        "email" => $_POST['loginEmail'],
        "password" => $_POST['loginPassword']
    );

    echo json_encode($loginData);
    $get_data = callAPI('POST', 'http://68.183.14.165:3000/login', json_encode($loginData));
    $response = json_decode($get_data, true);

    echo $response[0]['message'];
}

?>

<div id="loginPage">
    <form action="" method="POST">
        <input type="email" name="loginEmail" id="loginEmail" required placeholder="Email" minlength="5">
        <input type="password" name="loginPassword" id="loginPassword" required placeholder="Password" minlength="8" maxlength="32">
        <button type="submit">Login</button>
    </form>
    <p>
        Don’t have an account? <a href="/?page=signup">Join us</a>
    </p>
</div>