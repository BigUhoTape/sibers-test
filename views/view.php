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
    <title>User View</title>
</head>
<body>
<div class="container h-100">
    <div id="start-loading" class="row h-100 d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="spinner-border text-dark" role="status">
            </div>
            <p>Loading...</p>
        </div>
    </div>

    <div id="main-content" class="row h-100 d-flex justify-content-center align-items-center d-none position-relative">
        <div class="d-flex flex-column col-md-6">
            <a href="index.php">Main Page</a>
            <h4>User View</h4>
            <ul class="list-group my-2">
                <li class="list-group-item">
                    <strong>ID:</strong> <span id="value-id"></span>
                </li>
                <li class="list-group-item">
                    <strong>login:</strong> <span id="value-login"></span>
                </li>
                <li class="list-group-item">
                    <strong>password:</strong> <span id="value-password"></span>
                </li>
                <li class="list-group-item">
                    <strong>name:</strong> <span id="value-name"></span>
                </li>
                <li class="list-group-item">
                    <strong>last_name:</strong> <span id="value-last_name"></span>
                </li>
                <li class="list-group-item">
                    <strong>gender:</strong> <span id="value-gender"></span>
                </li>
                <li class="list-group-item">
                    <strong>birthday:</strong> <span id="value-birthday"></span>
                </li>
                <li class="list-group-item">
                    <strong>role_id:</strong> <span id="value-role_id"></span>
                </li>
            </ul>

            <div>
                <button id="delete-user-btn" class="btn btn-danger">Delete</button>
                <a id="update-user-btn" href="" class="btn btn-success">Update</a>
            </div>
        </div>

        <div class="delete-user-process d-none">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="spinner-border text-dark" role="status">
                    </div>
                    <p>Deleting...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/view.js"></script>
</body>
</html>