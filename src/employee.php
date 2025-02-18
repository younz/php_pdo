<?php

require_once 'database.php';
require_once 'logger.php';

/**
 * It retrieves all employees from the database
 * @param $pdo A PDO database connection
 * @return An associative array with employee information,
 *         or false if there was an error
 */
function getAllEmployees(PDO $pdo): array|false
{
    $sql =<<<SQL
        SELECT cFirstName, cLastName, dBirth
        FROM employee
        ORDER BY cFirstName, cLastName;
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        logText('Error getting all employees: ', $e);
        return false;
    }
}