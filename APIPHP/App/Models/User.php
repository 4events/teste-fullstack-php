<?php
    namespace App\Models;
    //sempre que tiver que usar a classe User é necessário informar a namespace
    //APP\Models

    /**
     * Nessa classe são realizados os acessos ao banco de dados
     */
    class User
    {
        //tabela do banco
        private static $table = 'veiculo';

        /**
         * Função responsável por fazer o select de um único elemento no banco
         */
        public static function select(int $id) {
            //conexão com o banco de dados
            //utilização do '\' quando for um objeto global
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            //Criação da query
            //para mexer com variaveis estáticas é necessário utilizar o self::
            //se não fosse pode ser utilizado o $this
            $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';
            //prepara a execução do SQL
            $stmt = $connPdo->prepare($sql);
            //o bindvalue faz um tratamento na variavel $id, para evitar
            //algum tipo de sqlinjection
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            //Verifica se houve retorno
            if ($stmt->rowCount() > 0) {
                //Retorna o resultado
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum carro cadastrado!!");
            }
        }

        /**
         * Função que retorna todos os elementos do banco
         */
        public static function selectAll() {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum carro cadastrado!");
            }
        }
        /**
         * Função que retorna os elementos de acordo com a busca feita pelo usuário
         */
        public static function busca($busca) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            $sql = 'SELECT * FROM '.self::$table.' WHERE nome like "%'.$busca[0].'%" or marca like "%'.$busca[0].'%"';
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum carro encontrado com a busca: " . $busca[0] ."!!");
            }
        }

        /**
         * Função que realiza o insert de um novo valor no banco banco
         */
        public static function insert($data)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'INSERT INTO '.self::$table.' (nome, marca, ano, descricao, vendido) VALUES (:no, :ma, :an, :de, :ve)';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':no', $data[0]);
            $stmt->bindValue(':ma', $data[1]);
            $stmt->bindValue(':an', $data[2]);
            $stmt->bindValue(':de', $data[3]);
            $stmt->bindValue(':ve', $data[4]);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Veículo inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir veículo!");
            }
        }
        /**
         * Função que realiza a atualização de valores no banco
         */
        public static function update($data)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'UPDATE '.self::$table.' 
                SET nome = :no, marca = :ma, ano = :an, descricao = :de, vendido = :ve
                WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $data[0]);
            $stmt->bindValue(':no', $data[1]);
            $stmt->bindValue(':ma', $data[2]);
            $stmt->bindValue(':an', $data[3]);
            $stmt->bindValue(':de', $data[4]);
            $stmt->bindValue(':ve', $data[5]);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Veículo atualizado com sucesso!';
            } else {
                throw new \Exception("Falha ao atualizar veículo!");
            }
        }
    }