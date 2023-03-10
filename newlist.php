<html>
<head>
    <?php
        session_start();
        if(!isset($_SESSION["name"])){
            setcookie("login", true, time()-1);
            header("Location: login.php");
        }
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Klinglung - create new list</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg text-bg-primary mb-5"> <!-- Supposed to use some "data-bs-theme="dark"" stuff, doesn't work -->
    <div class="container-fluid mx-3">
        <a class="navbar-brand" href="#">Klinglung</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mysets.php">My sets</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form action="dbgen.php" method="post">
    <div class="m-5 w-25">
        <input name="title" class="shadow form-control mb-3" type="text" placeholder="Name of wordlist" aria-label="default input example">
        <textarea name="desc" class="shadow-sm form-control" id="exampleFormControlTextarea2" rows="3" placeholder="Description of wordlist"></textarea>
    </div>
    <div class="mx-5">
        <label for="formText" class="form-label">Insert word list</label>
        <textarea name="words" class="shadow-lg form-control" id="exampleFormControlTextarea1" rows="18" placeholder="Foreign word&#10Native word&#10Foreign word&#10Native word&#10Forei..."></textarea>
        <input type="submit" class="mt-3 form-control btn btn-outline-primary" value="Submit">
    </div>
</form>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>