<?php

require_once 'src/database.php';

$pdo = connect();
echo gettype($pdo);