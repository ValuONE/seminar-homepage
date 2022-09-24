<?php

class db
{
    /* Datenbank Informationen, um eine Verbindung zur Datenbank herzustellen */

    private string $db_host = '127.0.0.1';
    private string $db_name = 'website';
    private string $db_user = 'root';
    private string $db_pw = '';

    private function initiateConnection(): PDO
    {
        try {
            return new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_pw);
        } catch (PDOException) {
            die('[MYSQL] Could not establish database connection');
        }
    }

    public function getConnection(): PDO
    {
        return $this->initiateConnection();
    }

    public function executeQuery($query): bool|PDOStatement
    {
        return $this->getConnection()->query($query);
    }

    public function executeQueryWhere($query, $arguments): bool
    {
        $data = $this->getConnection()->prepare($query);
        return $data->execute($arguments);
    }

    public function fetchAllQuery($query): bool|array
    {
        return $this->getConnection()->query($query)->fetchAll();
    }

    public function fetchAllWhere($query, $arguments): bool|array
    {
        $data = $this->getConnection()->prepare($query);
        $data->execute($arguments);
        return $data->fetchAll();
    }

    public function fetchWhere($query, $arguments) {
        $data = $this->getConnection()->prepare($query);
        $data->execute($arguments);
        return $data->fetch();
    }

    public function executeUpdate($query, $arguments) {
        $data = $this->getConnection()->prepare($query);
        $data->execute($arguments);
        return $data->fetch();
    }

    public function executeAllUpdate($query, $arguments): bool|array
    {
        $data = $this->getConnection()->prepare($query);
        $data->execute($arguments);
        return $data->fetchAll();
    }
}