<html>
<head>
    <?php
        session_start();
        if(isset($_SESSION["name"])){
            header("Location: index.php");
        }
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Klinglung</title>
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
                <li class="nav-item" style="display: none;" id="mset">
                    <a class="nav-link" href="mysets.php">My sets</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="login" class="shadow-lg container w-25 border rounded-4 p-5">
    <button class="btn btn-primary" disabled>Login</button>
    <button class="btn btn-outline-primary" onclick="change_form(0)">Register</button>
    <form method="post" action="auth.php" >
        <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="passwd" class="form-label">Password</label>
            <input type="password" name="passwd" class="form-control" id="passwd">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Login</button>
    </form>
</div>
<div id="register" class="shadow-lg container w-25 border rounded-4 p-5" style="display: none;">
    <button class="btn btn-outline-primary" onclick="change_form(1)">Login</button>
    <button class="btn btn-primary" disabled>Register</button>
    <form method="post" action="auth.php" >
        <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="text"
            class="form-control" name="username" id="username" aria-describedby="usr" placeholder="Example1">
          <small id="usr" class="form-text text-muted">This will be your display name</small>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="passwd" class="form-label">Password</label>
            <input type="password" name="passwd" class="form-control" id="passwd">
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="reg" id="reg" value="ture" style="display: none;" checked>
          </label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Register</button>
    </form>
</div>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    function change_form(a) {
        if(a == 0){
            document.getElementById("register").style.display = "block";
            document.getElementById("login").style.display = "none";
        } else{
            document.getElementById("login").style.display = "block";
            document.getElementById("register").style.display = "none";
        }
    }    
</script>
</body>
</html>