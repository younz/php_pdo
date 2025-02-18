<?php

require_once 'src/employee.php';

$pdo = connect();
$employees = getAllEmployees($pdo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Company</h1>
    </header>
    <main>
        <section>
            <?php foreach ($employees as $employee): ?>
                <article>
                    <p><strong>First name: </strong><?=$employee['cFirstName'] ?></p>
                    <p><strong>Last name: </strong><?=$employee['cLastName'] ?></p>
                    <p><strong>Birth date: </strong><?=$employee['dBirth'] ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 KEA Development</p>
    </footer>
</body>
</html>