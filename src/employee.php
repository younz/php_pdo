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
        SELECT nEmployeeID, cFirstName, cLastName, dBirth
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

/**
 * It retrieves employees from the database based 
 * on a text search on the first and last name
 * @param $pdo A PDO database connection
 * @param $searchText The text to search in the database
 * @return An associative array with employee information,
 *         or false if there was an error
 */
function searchEmployees(PDO $pdo, string $searchText): array|false
{
    $sql =<<<SQL
        SELECT nEmployeeID, cFirstName, cLastName, dBirth
        FROM employee
        WHERE cFirstName LIKE :firstName
           OR cLastName LIKE :lastName
        ORDER BY cFirstName, cLastName;
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':firstName', "%$searchText%");
        $stmt->bindValue(':lastName', "%$searchText%");
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        logText('Error searching for employees: ', $e);
        return false;
    }
}

/**
 * It retrieves information of an employee
 * @param $pdo A PDO database connection
 * @param $employeeID The ID of the employee
 * @return An associative array with employee information,
 *         or false if there was an error
 */
function getEmployeeByID(PDO $pdo, int $employeeID): array|false
{
    $sql =<<<SQL
        SELECT 
            employee.cFirstName AS first_name, 
            employee.cLastName AS last_name, 
            employee.cEmail AS email, 
            employee.dBirth AS birth_date, 
            employee.nDepartmentID AS department_id, 
            department.cName AS department_name
        FROM employee INNER JOIN department
            ON employee.nDepartmentID = department.nDepartmentID
        WHERE nEmployeeID = :employeeID;
    SQL;

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':employeeID', $employeeID);
        $stmt->execute();

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        logText('Error retrieving employee information: ', $e);
        return false;
    }
}