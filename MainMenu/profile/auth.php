<?php
session_start();
include_once '../../includes/dbInclude.php';

// Message Vars
$msg = '';
$msgClass = '';

if(filter_has_var(INPUT_GET, 'user_exists')){
    $msg = 'Uporabnik z tem e-naslovom že obstaja, prijavite se tukaj!';
    $msgClass = 'alert-warning';
}

// Check if form was submitted
if(filter_has_var(INPUT_POST, 'submit')) {

    if(isset($_POST['reqType']))
    {
        if($_POST['reqType'] == "signIn"){
        // Get Form Data
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['pass']));
        // Check if inputs are empty
        if(!empty($email) && !empty($password)) {
        // Entered fields contain characters
    // Check Email structure
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        // Failed
        $msg = 'Email ni veljaven!';
        $msgClass = 'alert-danger';
    } else {
        // Passed
                // Check if user is in Users table
                // Email lookup query
                $userExistsQuery = mysqli_query($conn, "SELECT a.id as a_id, a.email as a_email, a.name as a_name, a.surname as a_surname, a.pass_hash as a_pass_hash, a.isAdmin as a_isAdmin
                from users a
                where a.email = '$email'");
                // Check if user with that email already exists
                if (mysqli_num_rows($userExistsQuery) == 0) {
                    // Failed - User does not exist
                    // User should be created
                    // Redirect to register
                    header('Location: ./auth.php?user_exists=false');
                } else { 
                    // Success
                    $db_id;
                    // User exists - proceed
                    while($row = mysqli_fetch_array($userExistsQuery)) {
                        $db_id = $row['a_id'];
                        $db_firstName = $row['a_name'];
                        $db_lastName = $row['a_surname'];
                        $db_email = $row['a_email'];
                        $db_pass_hash = $row['a_pass_hash'];
                        $db_isAdmin = $row['a_isAdmin'];
                    }
                    // Check for password match
                    if (password_verify($password, $db_pass_hash)) {
                        // Success password matches
                        // Perform Login
                        $_SESSION['user_id'] = $db_id;
                        $_SESSION['user_name'] = $db_firstName;
                        $_SESSION['user_surname'] = $db_lastName;
                        $_SESSION['user_email'] = $db_email;
                        $_SESSION['user_isAdmin'] = $db_isAdmin;

                        $userGameDataQuery = mysqli_query($conn, "SELECT g.player_id as g_player_id, g.ticTacToe as g_ticTacToe, g.memoryGame as g_memoryGame
                from gamesplayed g
                where g.player_id = $db_id");

if (mysqli_num_rows($userGameDataQuery) == 0) {

    $g_ticTacToe = $_SESSION['gamesPlayedTicTacToe'];
    $g_memoryGame = $_SESSION['gamesPlayedMemoryGame'];
    $sqlCreateDefPlayedData = "INSERT INTO gamesplayed (player_id, ticTacToe, memoryGame)
                    VALUES ($db_id, $g_ticTacToe, $g_memoryGame)";
                    if ($conn->query($sqlCreateDefPlayedData) === TRUE) {
                        $msg = "Nov uporabnik je bil uspešno kreiran!";
                        $msgClass = 'alert-success';
                    } else {
                        $msg = 'Pri registraciji je prišlo do napake!';
                        $msgClass = 'alert-danger';
                    }
                    header('Location: ../index.php');
} else { 
    // Success
    // User exists - proceed
    while($row = mysqli_fetch_array($userGameDataQuery)) {
        $g_id = $row['g_id'];
        $g_ticTacToe = $row['g_ticTacToe'];
        $g_memoryGame = $row['g_memoryGame'];
    }

    $_SESSION['gamesPlayedTicTacToe'] += $g_ticTacToe;

    $_SESSION['gamesPlayedMemoryGame'] += $g_memoryGame;

    $g_ticTacToe = $_SESSION['gamesPlayedTicTacToe'];
    $g_memoryGame = $_SESSION['gamesPlayedMemoryGame'];

$sqlCreatePlayedData = "UPDATE gamesplayed
set ticTacToe = '$g_ticTacToe', memoryGame = '$g_memoryGame'
where player_id = $db_id";

                    if ($conn->query($sqlCreatePlayedData) === TRUE) {
                        $msg = "Nov uporabnik je bil uspešno kreiran!";
                        $msgClass = 'alert-success';
                    } else {
                        $msg = 'Pri registraciji je prišlo do napake!';
                        $msgClass = 'alert-danger';
                    }

                        header('Location: ../index.php');

}

                    
                    } else {
                        // Failed password does NOT match
                        // Alert user
                        $msg = 'Vnešeno geslo je napačno!';
                        $msgClass = 'alert-danger';
                    }
                } // End of admins check table
            } 
} else {
    // Reject missing fields
    $msg = 'Prosim vnesite vsa polja!';
    $msgClass = 'alert-danger';
}

        } else if($_POST['reqType'] == "signUp"){
// Get Form Data
/* $firstName = trim(htmlspecialchars($_POST['register-firstname']));
$lastName = trim(htmlspecialchars($_POST['register-lastname'])); */
$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['pass']));
$rePassword = trim(htmlspecialchars($_POST['re-pass']));
// Check if inputs are empty
if(!empty($email) && !empty($password) && !empty($rePassword)/*  && !empty($firstName) && !empty($lastName) */) {
    // Entered fields are not empty
    // Check Email structure
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        // Failed
        $msg = 'Email ni veljaven!';
        $msgClass = 'alert-danger';
    } else {
        if($password != $rePassword) {
            header('Location: ./auth.php');
            exit;
        }
        // Passed
                // check if user exists in admins table
                $teacherExistsQuery = mysqli_query($conn, "SELECT a.id as a_id, a.email as a_email
                from users a
                where a.email = '$email'");

                // Check if user with that email already exists
                if (mysqli_num_rows($teacherExistsQuery) == 0) {

                    // Success - Users does not exist
                    // User can be created - Perform Register
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $sqlCreateUser = "INSERT INTO users (name, surname, email, pass_hash, isAdmin)
                    VALUES ('unknown', 'unknown', '$email', '$hashed_password', '0')";

                    if ($conn->query($sqlCreateUser) === TRUE) {
                        $msg = "Nov uporabnik je bil uspešno kreiran!";
                        $msgClass = 'alert-success';
                    } else {
                        $msg = 'Pri registraciji je prišlo do napake!';
                        $msgClass = 'alert-danger';
                    }

                } else { 
                    // Failed
                    // User already exists
                    // Redirect to login
                    header('Location: ./auth.php?user_exists=true');
                }  

         // Send Verification Email TODO!!!

        /* $toEmail = $email;
        $subject = 'Registracija na Leski.si';
        $body = '
        <h2>Uspešno ste se registrirali na Leski.si</h2>
        <h4>Ime</h4><p>'.$firstName.' '.$lastName.'</p>
        <h4>Email</h4><p>'.$email.'</p>
        <h6>Hvala za Vaše zaupanje in podporo!</h6><p>Vaši Leski.</p>
        ';

        // Email Headers
        $headers = "MIME-Version: 1.0" ."\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "
            \r\n";
        
        // Additional Headers
        $headers .= "From: " .$leskiName. "<".$leskiEmail.">". "\r\n";

        if(mail($toEmail, $subject, $body, $headers)) {
            // Email Sent
            $msg = "E-mail je bil poslan na vaš naslov, prosimo Vas za potrditev.";
            $msgClass = "alert-success";
        } else {
            // Failed
            $msg = "E-maila ni bilo mogoče poslati prosimo preverite vnos.";
            $msgClass = "alert-danger";
        } */

    }

} else {
    // Rejected
    $msg = 'Prosim vnesite vsa polja!';
    $msgClass = 'alert-danger';
}

        } else if($_POST['reqType'] == "reset"){

        }
    }
    unset($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/auth.css">

</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <p>
    <?php
    echo $msg;
    ?>
</p>
        <div class="mobilesize">

            <input type="radio" name="reqType" value="signIn" id="SignIn" checked="">
            <input type="radio" name="reqType" value="signUp" id="SignUp">
            <input type="radio" name="reqType" value="reset" id="Reset">

            <div class="toptitale">
                <label for="SignIn">Sign In</label>
                <label for="SignUp">Sign Up</label>
                <label for="Reset">Reset</label>
            </div>
            <span class="pointtop"></span>
            <div class="SignInBox">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <input type="password" name="re-pass" placeholder="Repeat password">
                <button name="submit" type="submit"><span class="si">Sign In</span> <span class="su">Sign Up</span> <span
                        class="re">Reset</span></button>
            </div>
        </div>
    </form>

</body>

</html>