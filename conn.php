<?php

    function dbconn(){

               ///////// ALETERE AQUI AS INFORMAÇÕES REFENTES AS CONEXÃO COM O BANCO ///////////////
              /*////////////////////*/                                     /*////////////////////*/ 
             /*////////////////////*/      $loginDB = 'root';             /*////////////////////*/     
            /*////////////////////*/       $senhaDB = 'root';            /*////////////////////*/    //                ////////    ///////    ///////
           /*////////////////////*/        $nomeDB = 'dbt';             /*////////////////////*/    //___________     //          //         //
          /*////////////////////*/         $hostDB = 'localhost';      /*//////////////////////     \\               //          /////      //   //
         //////////////////////*/          $portDB = '3306';          /*//////////////////////       \\             /////////   //         ///////
        /*////////////////////*/                                     /*////////////////////*/ 
       /////////////// ALETERE AQUI AS INFORMAÇÕES REFENTES A CONEXÃO COM O BANCO //////////


        return new PDO('mysql:host='.$hostDB.':'.$portDB.';dbname='.$nomeDB, $loginDB, $senhaDB);
    }


    // Get/Post all vehicles
    function getpost($vm,$bl,$vp,$vg){

        try {

            $pdo = dbconn();

            if($vm === 'GET'){

                if($bl){
                    $statement = $pdo->prepare("SELECT * FROM `vcl`");
                    $statement->execute(); 
                }else{
                    $statement = $pdo->prepare("SELECT * FROM `vcl` WHERE `ano` like :find or `modelo` like :find or `fabricante` like :find or `descricao` like :find");
                    $statement->execute(['find' => '%'.$vg.'%']);
                }
                    
                $final = [];

                while($data = $statement->fetch()) {
                    $row = array(
                        'ano' => $data['ano'], 
                        'modelo' => $data['modelo'], 
                        'fabricante' => $data['fabricante'], 
                        'descricao' => $data['descricao'], 
                        'vendido' => $data['vendido']
                    );
                    array_push($final, $row);

                }
                $final = isset($final[0]) ? $final : array('err' => '03', 'msg' => 'Não há resultado correspondente à sua pesquisa em nosso banco de dados.');
                return json_encode($final);

            } else {

                $statement = $pdo->prepare("INSERT INTO `vcl` (`ano`, `modelo`, `fabricante`, `descricao`, `vendido`) VALUES (:ano, :modelo, :fabricante, :descricao, :vendido)");
                $statement->execute([
                    'ano' => $vp['ano'], 
                    'modelo' => $vp['modelo'], 
                    'fabricante' => $vp['fabricante'], 
                    'descricao' => $vp['descricao'], 
                    'vendido' => $vp['vendido']
                ]);

                $data = $statement->fetchAll();

                return '{"err": "02", "msg":"Carro adicionado com sucesso!"}';

            }


        } catch(PDOException $e) {

            echo $e->getMessage();
        
        }
    }