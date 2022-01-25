<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<style>
    button{
        font-size: 25px !important;
    }
    i{
        font-size: 40px !important;
    }
</style>

    <button onclick="location.href='./chess.php';" disabled class="btn btn-outline-dark">SinglePlayer (Against AI)<br><i class="fas fa-users-cog"></i></button>
    <button onclick="location.href='./chess.php';" class="btn btn-outline-dark">Local Multiplayer<br><i class="fas fa-people-carry"></i></button>
    <button onclick="location.href='./chess.php';" disabled class="btn btn-outline-dark">Remote Multiplayer<br><i class="fas fa-network-wired"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
</html>