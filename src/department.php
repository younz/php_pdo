<?php

require_once 'database.php';
require_once 'logger.php';

/**
 * It retrieves all department from the database
 * @param $pdo A PDO database connection
 * @return An associative array with department information,
 *         or false if there was an error
 */
function getAllDepartments(PDO $pdo): array|false
{
    $sql =<<<SQL
        SELECT nDepartmentID, cName
        FROM department
        ORDER BY cName
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        logText('Error getting all departments: ', $e);
        return false;
    }
}

/**
 * It retrieves information regarding one department
 * @param $pdo A PDO database connection
 * @param $departmentID The ID of the department whose info to retrieve
 * @return An associative array with department information,
 *         or false if there was an error
 */
function getDepartmentByID(PDO $pdo, int $departmentID): array|false
{
    $sql =<<<SQL
        SELECT cName
        FROM department
        WHERE nDepartmentID = :departmentID;
    SQL;
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':departmentID', $departmentID);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            return $stmt->fetch();
        }
        return false;
    } catch (PDOException $e) {
        logText('Error getting all departments: ', $e);
        return false;
    }
}