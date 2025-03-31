<?php

require_once 'Database.php';
require_once 'Logger.php';

class Project extends Database
{
    function getAll(): array|false
    {
        $sql =<<<SQL
            SELECT nProjectID, cName, 
            FROM project
            ORDER BY cName;
        SQL;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            Logger::logText('Error getting all projects: ', $e);
            return false;
        }
    }
    function getbyName(string $name): array|false
    {
        $sql =<<<SQL
            SELECT nProjectID, cName, 
            FROM project
            WHERE cName = :name;
        SQL;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            Logger::logText('Error getting project by name: ', $e);
            return false;
        }
    }
    function addProject(string $name): bool
    {
        $sql =<<<SQL
            INSERT INTO project (cName)
            VALUES (:name);
        SQL;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            Logger::logText('Error adding project: ', $e);
            return false;
        }
    }
    function updateProject(int $id, string $name): bool
    {
        $sql =<<<SQL
            UPDATE project
            SET cName = :name
            WHERE nProjectID = :id;
        SQL;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            Logger::logText('Error updating project: ', $e);
            return false;
        }
    } 
    function deleteProject($id): bool
    {
        $sql =<<<SQL
            DELETE FROM project
            WHERE nProjectID = :id;
        SQL;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            Logger::logText('Error deleting project: ', $e);
            return false;
        }
    }

}

