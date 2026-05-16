<!DOCTYPE html>
<html>
<head>
    <title>Students - MySESS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <a href="/MySESS_Senior_Project/public/admin/dashboard">← Back to Dashboard</a>
    <h2 class="mt-3">All Students</h2>
    <hr>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Diagnosis</th>
        </tr>
        <?php foreach ($students as $student) { ?>
        <tr>
            <td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
            <td><?php echo $student['date_of_birth']; ?></td>
            <td><?php echo $student['gender']; ?></td>
            <td><?php echo $student['diagnosis']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>