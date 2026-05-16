<!DOCTYPE html>
<html>
<head>
    <title>Users - MySESS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <a href="/MySESS_Senior_Project/public/admin/dashboard">← Back to Dashboard</a>
    <h2 class="mt-3">All Users</h2>
    <hr>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>