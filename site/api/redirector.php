<?php
require_once('api/api_endpoints.php');
require_once('api/db_connect.php');
require_once('api/auxiliary_functions.php');

$resultado = [];

$http->on('request', function ($request, $response) use ($pdo) {
    $result = [];
    $type = 'get';
    $result['veiculos'] = '';

    $response->header('Access-Control-Allow-Origin', '*');
    $response->header('Access-Control-Allow-Methods', '*');
    $response->header('Access-Control-Allow-Headers', '*');
    $response->header('Content-type', 'application/json');

    $endpoint = api_endpoints($request->server['request_uri'], $type);

    if($endpoint !== 'get/'){
        
        if(!is_null($request->post)){
            $type = 'post';
        }
        $_post_endpoint = api_endpoints($request->server['request_uri'], $type);

        switch($_post_endpoint){
 
            case 'post/veiculos': 
                Co::join([
                    go(function () use ($pdo, &$result, $request) {
                        
                        $id_marca  = @$request->post['id_marca'];
                        $veiculo   = removeAcentos(@$request->post['veiculo']);
                        $ano       = @$request->post['ano'];
                        $descricao = removeAcentos(@$request->post['descricao']);
                        $vendido   = @$request->post['vendido'];

                        $data = [];

                        if($request->post['action'] == 'excluir'){
                            $id = @$request->post['id'];
                            $sql = "DELETE FROM veiculos WHERE id=?";

                            $data = array(
                                'code'    =>  200, 
                                'message' => 'Dados excluído com sucesso'
                            );

                            $query = $pdo->prepare($sql);
                            try{

                                $query->execute([$id]);

                            }catch (PDOException $e) {
    
                                $data = array(
                                    'code'   => $e->getCode(), 
                                    'message'=> 'Erro ao excluir veiculo'
                                );  
                            
                            }
                        }

                        if($request->post['action'] == 'atualizar'){
                            $id = @$request->post['id'];
                            $sql = "UPDATE veiculos 
                                    SET id_marca=?, veiculo=?, ano=?, descricao=?, vendido=?
                                    WHERE id=?";

                            $data = array(
                                'code'    =>  200, 
                                'message' => 'Dados atualizado com sucesso!'
                            );

                            $query = $pdo->prepare($sql);

                            try{
                                $query->execute(
                                    [
                                        $id_marca, 
                                        $veiculo, 
                                        $ano, 
                                        $descricao, 
                                        $vendido,
                                        $id
                                    ]
                                );
                            }catch (PDOException $e) {
    
                                $data = array(
                                    'code'   => $e->getCode(), 
                                    'message'=> 'Erro ao cadastrar veiculo'
                                );  
                            
                            }

                        }

                        if($request->post['action'] == 'cadastrar'){
                            $sql = "INSERT INTO veiculos 
                            (id_marca, veiculo, ano, descricao, vendido) 
                            VALUES (?,?,?,?,?)";

                            $data = array(
                                'code'   => 200, 
                                'message'=> 'Veiculo cadastrado com sucesso'
                            );
                            $query = $pdo->prepare($sql);
 
                            $query->execute(
                                [
                                    $id_marca, 
                                    $veiculo, 
                                    $ano, 
                                    $descricao, 
                                    $vendido
                                ]
                            );
                        }
                
                        $result['veiculos'] = json_encode($data);
                        $query->closeCursor();
                    })
                ]);
            break;
            
            $response->end($result['veiculos']);
	}

    if(!is_null($request->get)){
        $type = 'get';
    }
    $_get_endpoint = api_endpoints($request->server['request_uri'], $type);

	switch($_get_endpoint){
	
        case 'get/veiculos': 

            Co::join([
                go(function () use ($pdo, &$result, $request) {
                    
                    $sql = "SELECT *, veiculos.id as id_veiculo FROM veiculos 
                            INNER JOIN marca 
                            ON veiculos.id_marca = marca.id
                            ORDER BY veiculos.id DESC;
                            ";

                    $query = $pdo->prepare($sql);
                    $query->execute();
        
                    $data = $query->fetchAll(PDO::FETCH_ASSOC);

                    $count = count($data);
                    
                    if ($count > 0) {
                        $data['code'] = 200;
                        $data['rows'] = $count;
                        $data['message'] = 'Foram encontrados '.$count.' resultados';
                    }else{
                        $data['code'] = 1;
                        $data['message'] = 'Nenhum item cadastrado';
                    }
        
                    $result['veiculos'] = json_encode($data, JSON_UNESCAPED_UNICODE);
                    
                    $query->closeCursor();
                })
            ]);
            break;

        case 'get/veiculos/find':

            Co::join([
                go(function () use ($pdo, &$result, $request) {
                    
                    $sql = "SELECT * FROM veiculos INNER JOIN marca ON veiculos.id_marca = marca.id WHERE veiculo LIKE ?";

                    $veiculo = $request->get['q'];

                    $query = $pdo->prepare($sql);
                    $query->bindValue(1, "%$veiculo%", PDO::PARAM_STR);
                    $query->execute();
                
                    $data = $query->fetchAll(PDO::FETCH_ASSOC);
                    
                    $count = count($data);
                                
                    if ($count > 0) {
                        $data['code'] = 200;
                        $data['rows'] = $count;
                        $data['message'] = 'Sua busca encontrou '.$count.' resultado(s)';
                    }else{
                        $data['code'] = 1;
                        $data['message'] = 'Sua busca não encontrou resultados';
                    }
                    
                    $result['veiculos'] = json_encode($data, JSON_UNESCAPED_UNICODE);
                    $query->closeCursor();
                    
                })
            ]);
            break;
	    }
	
        $response->end($result['veiculos']);
        
    }else{

        $page = 'index';

        $data = array('code' => 200, 'message' => "API Swoole is UP!");
        $response->header("Content-type", "application/json");
        $result[$page] = json_encode($data);
        $response->end($result[$page]);
        
    }
    
});


