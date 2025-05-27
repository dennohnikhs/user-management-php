<?php
include './database/connection.php';
include './database/employees-fetch.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <?php
    // Include the header
    include './includes/header.php';
    ?>

    <main>
        <h1>Employees</h1>
        <p>Here is a list of all employees in the system.</p>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Reports To</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                $counter = 1;   
                foreach ($employees as $employee): 
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($employee['firstName']).' '.htmlspecialchars($employee['lastName']);; ?>
                            - <?php echo htmlspecialchars($employee['jobTitle']); ?></td>
                        <td><?php echo htmlspecialchars($employee['email']); ?></td>
                        <td><?php echo htmlspecialchars($employee['rFirstName']).' '.htmlspecialchars($employee['rLastName']);; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

    <?php
    // Include the footer
    include './includes/footer.php';
    ?>
    <script src="./assets/js/script.js"></script>
</body>

</html>