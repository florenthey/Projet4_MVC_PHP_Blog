<?php

namespace blog\src\DAO;

use PDO;
use Exception;

abstract class DAO {

    // Stocke la connexion (ou renvois null)
    private $connection;

    // vérifis si il y a une connexion et la renvois
    private function checkConnection()
    {
        if($this->connection === null) {
            return $this->getConnection();
        }
        return $this->connection;
    }

    // connexion à la base de données
   private function getConnection() {

        // tentative de connexion à la bdd
        try {
            $this->connection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // return $this->connection;
            return $this->connection;
        }
        // si échec
        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }
    }

    // si connexion, requete sql ou sql + params...
    protected function createQuery($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);

            return $result;
        }
        $result = $this->checkConnection()->query($sql);
        
        return $result;
    }
}



