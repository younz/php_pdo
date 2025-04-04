<?php

require_once 'Database.php';
require_once 'Logger.php';

Class Department extends Database 
{  
    /**
     * It retrieves all department from the database
     * @return An associative array with department information,
     *         or false if there was an error
     */
    function getAll(): array|false
    {
        $sql =<<<SQL
            SELECT nDepartmentID, cName
            FROM department
            ORDER BY cName
        SQL;
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            Logger::logText('Error getting all departments: ', $e);
            return false;
        }
    }

    /**
     * It retrieves information regarding one department
     * @param $departmentID The ID of the department whose info to retrieve
     * @return An associative array with department information,
     *         or false if there was an error
     */
    function getByID(int $departmentID): array|false
    {
        $sql =<<<SQL
            SELECT cName
            FROM department
            WHERE nDepartmentID = :departmentID;
        SQL;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':departmentID', $departmentID);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                return $stmt->fetch();
            }
            return false;
        } catch (PDOException $e) {
            Logger::logText('Error getting all departments: ', $e);
            return false;
        }
    }
}