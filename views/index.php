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
    <title>Users</title>
</head>
<body>
<div class="container h-100 mt-5">
    <div id="start-loading" class="row h-100 d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="spinner-border text-dark" role="status">
            </div>
            <p>Loading...</p>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between">
        <a href="create.php" class="btn btn-success">Create User</a>

        <button id="exit-btn" class="btn btn-danger">Exit</button>
    </div>

    <div id="user-table-cont" class="users-table d-none mt-5 position-relative">
        <div class="form-group col-md-4 mb-3">
            <label for="sort">Select sort:</label>
            <select class="form-control" id="sort">
                <option value="id">Id</option>
                <option value="login">Login</option>
                <option value="name">Name</option>
                <option value="last_name">Last Name</option>
            </select>

            <button class="btn btn-primary mt-1" id="change-sort-dir-btn">Change sort direction</button>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Login</th>
                <th scope="col">Name</th>
                <th scope="col">Last name</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="users-list-body">
            </tbody>
        </table>

        <div class="mt-2">
            <ul id="pagination" class="pagination">
            </ul>
        </div>

        <div class="update-table d-none">
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

<script src="../assets/js/index.js"></script>
</body>
</html>