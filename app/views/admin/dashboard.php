<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - MySESS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!--top navbar -->
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">MySESS Admin</span>
        <span class="text-white">Hi, <?php echo $_SESSION['first_name']; ?></span>
        <a href="/MySESS_Senior_Project/public/logout" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h2>Dashboard</h2>
    <hr>

    <!--stats-->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h3><?php echo $totalUsers; ?></h3>
                    <p>Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h3><?php echo $totalStudents; ?></h3>
                    <p>Students</p>
                </div>
            </div>
        </div>
    </div>

    <a href="/MySESS_Senior_Project/public/admin/users" class="btn btn-primary">View Users</a>
    <a href="/MySESS_Senior_Project/public/admin/students" class="btn btn-success">View Students</a>
</div>

</body>
</html>