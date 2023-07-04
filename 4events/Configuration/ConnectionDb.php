<?php
    namespace Configuration;

    class ConnectionDb {

        public function connect(){
            $servidor = "host.docker.internal";
            $usuario  = "root";	
            $senha    = "";	
            $baseDados= "4events";
            try{
                $pdo = new \PDO("mysql:host=".$servidor.";dbname=".$baseDados,$usuario,$senha);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $pdo;
        }

    }