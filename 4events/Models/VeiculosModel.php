<?php
    
    namespace Models;

    require __DIR__.'/../Configuration/ConnectionDb.php';
    
    use Configuration\ConnectionDb;


    class VeiculosModel {

        private static $table = "veiculos";

        public function getAll() {

            $conn = new ConnectionDb();
            $pdo = $conn->connect();
            $sql = "SELECT * 
                    FROM ".self::$table." 
                    ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return array('status' => 'OK', 'code' => 200, 'data' => $stmt->fetchAll(\PDO::FETCH_ASSOC));
            }else{
                return array('status' => 'Not Found', 'code' => 404);
            }

        }

        public function getById($id = null) {

            $conn = new ConnectionDb();
            $pdo = $conn->connect();
            $sql = "SELECT * 
                    FROM ".self::$table." AS v 
                    WHERE (v.id = :id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return array('status' => 'OK', 'code' => 200, 'data' => $stmt->fetch(\PDO::FETCH_ASSOC));
            }else{
                return array('status' => 'Not Found', 'code' => 404);
            }

        }

        public function find($str = null) {

            $conn = new ConnectionDb();
            $pdo = $conn->connect();
            $sql = "SELECT * 
                    FROM ".self::$table." AS v 
                    WHERE v.veiculo LIKE :str 
                    OR v.descricao LIKE :str 
                    OR v.combustivel LIKE :str 
                    OR v.marca LIKE :str 
                    ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":str", "%".$str."%", \PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return array('status' => 'OK', 'code' => 200, 'data' => $stmt->fetchAll(\PDO::FETCH_ASSOC));
            }else{
                return array('status' => 'Not Found', 'code' => 404);
            }

        }

        public function create($arr) {

            if(isset($arr['marca']) && isset($arr['veiculo']) && isset($arr['ano']) && isset($arr['combustivel']) && isset($arr['descricao']) && isset($arr['vendido'])) {

                $conn = new ConnectionDb();
                $pdo = $conn->connect();
                $sql = "INSERT INTO ".self::$table."(marca, veiculo, ano, combustivel, descricao, vendido, created) VALUES(:marca, :veiculo, :ano, :combustivel, :descricao, :vendido, :created)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":marca", $arr['marca']);
                $stmt->bindValue(":veiculo", $arr['veiculo']);
                $stmt->bindValue(":ano", $arr['ano']);
                $stmt->bindValue(":combustivel", $arr['combustivel']);
                $stmt->bindValue(":descricao", $arr['descricao']);
                $stmt->bindValue(":vendido", $arr['vendido']);
                $stmt->bindValue(":created", @date('Y-m-d H:i:s'));
                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    return array('status' => 'Created', 'code' => 201);
                }else{
                    return array('status' => 'Bad Request', 'code' => 400);
                }

            }else{
                return array('status' => 'Bad Request', 'code' => 400);
            }

        }

        public function update($arr) {

            if(isset($arr['id']) && isset($arr['marca']) && isset($arr['veiculo']) && isset($arr['ano']) && isset($arr['combustivel']) && isset($arr['descricao']) && isset($arr['vendido'])) {

                $conn = new ConnectionDb();
                $pdo = $conn->connect();
                $sql = "UPDATE  ".self::$table." SET marca = :marca, veiculo = :veiculo, ano = :ano, combustivel=:combustivel, descricao = :descricao, vendido = :vendido WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $arr['id'], \PDO::PARAM_INT);
                $stmt->bindParam(":marca", $arr['marca']);
                $stmt->bindParam(":veiculo", $arr['veiculo']);
                $stmt->bindParam(":ano", $arr['ano']);
                $stmt->bindParam(":combustivel", $arr['combustivel']);
                $stmt->bindParam(":descricao", $arr['descricao']);
                $stmt->bindParam(":vendido", $arr['vendido']);
                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    return array('status' => 'OK', 'code' => 200);
                }else{
                    return array('status' => 'Bad Request', 'code' => 400);
                }

            }else{
                return array('status' => 'Bad Request', 'code' => 400);
            }

        }

        public function delete($id) {

            $conn = new ConnectionDb();
            $pdo = $conn->connect();
            $sql = "DELETE FROM ".self::$table." WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return array('status' => 'OK', 'code' => 200);
            }else{
                return array('status' => 'Not Found', 'code' => 404);
            }

        }

    }
