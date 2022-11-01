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
    <title>Update User</title>
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

    <div id="update-user-cont" class="row h-100 d-flex justify-content-center align-items-center d-none position-relative">
        <div class="d-flex flex-column col-md-6">
            <a href="index.php">Main Page</a>
            <h3 class="mb-3">Update User</h3>
            <form action="" method="">
                <div class="form-group mb-2">
                    <label for="login">Login</label>
                    <input
                        type="text"
                        name="login"
                        class="form-control"
                        id="login"
                        placeholder="Enter login"
                    >
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <input
                        type="text"
                        name="password"
                        class="form-control"
                        id="password"
                        placeholder="Enter Password"
                    >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        placeholder="Enter Name"
                    >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-2">
                    <label for="name">Last Name</label>
                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        id="last_name"
                        placeholder="Enter Last name"
                    >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-2">
                    <label for="name">Gender</label>
                    <input
                        type="text"
                        name="gender"
                        class="form-control"
                        id="gender"
                        placeholder="Enter Gender"
                    >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-2">
                    <label for="name">Birthday</label>
                    <input
                        type="date"
                        name="birthday"
                        class="form-control"
                        id="birthday"
                    >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-2">
                    <label for="role_id">Select Role</label>
                    <select name="role_id" class="form-control" id="role_id">
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-primary col-md-12">Submit</button>
            </form>
        </div>

        <div class="delete-user-process d-none">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="spinner-border text-dark" role="status">
                    </div>
                    <p>Updating...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/update.js"></script>
</body>
</html>