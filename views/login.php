<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Login</title>
</head>
<body>
<div class="container h-100">
    <div class="row h-100 d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center justify-content-center position-relative">
            <h3 class="mb-3">Log In</h3>

            <div id="error-alert" class="alert alert-danger d-none" role="alert">

            </div>

            <form action="" method="">
                <div class="form-group mb-3">
                    <label for="login">Login</label>
                    <input name="login" type="text" class="form-control" id="login"placeholder="Enter login">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Password">
                    <div class="invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-primary col-md-12">Submit</button>
            </form>

            <div class="delete-user-process d-none">
                <div class="row h-100 d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="spinner-border text-dark" role="status">
                        </div>
                        <p>Wait...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/login.js"></script>
</body>
</html>