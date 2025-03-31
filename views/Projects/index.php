<?php

require_once '../../initialise.php';

require_once ROOT_PATH . '/classes/Project.php';

$searchText = trim($_GET['search'] ?? '');

$employee = new Project();
if ($searchText === '') {
    $projects = $project->getAll();
} else {
    $projects = $project->getbyName($searchText);
}
if (!$projects) {
    $errorMessage = 'There was an error while retrieving the list of Projects.';
}

$pageTitle = 'Projects';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';
?>

<nav>
    <ul>
        <li><a href="new.php" title="Create new project">Add project</a></li>
    </ul>
</nav>
<main>
    <?php if (isset($errorMessage)): ?>
        <section>
            <p class="error"><?=$errorMessage ?></p>
        </section>
    <?php else: ?>
        <form action="index.php" method="GET">
            <div>
                <label for="txtSearch">Search</label>
                <input type="text" id="txtSearch" name="search" value="<?=$searchText ?>">
            </div>
            <div>
                <button type="submit">Search</button>
            </div>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?=$project['cName'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>