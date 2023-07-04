<?php
    
    namespace Services;
    
    require __DIR__.'/../Models/VeiculosModel.php';

    use Models\VeiculosModel;

    class VeiculosService {

        public function get($param = null) {

            $dbModel = new VeiculosModel();

            if($param && is_numeric($param)){
                return $dbModel->getById($param);
            }else{
                parse_str($param, $output);
                if(isset($output['function'])) {
                    if($output['function'] === "find") {
                        return $dbModel->find($output['q']);
                    }else{
                        return array('status' => 'Bad Request', 'code' => 400);
                    }
                }else{
                    return $dbModel->getAll();
                }
            }
          
        }

        public function post($json) { 
            $dbModel = new VeiculosModel();
            return $dbModel->create(json_decode($json, true));
        }

        public function put($json) { 
            $dbModel = new VeiculosModel();
            return $dbModel->update(json_decode($json, true));
        }

        public function delete($id = null) { 
            $dbModel = new VeiculosModel();
            return $dbModel->delete($id);
        }

        public function options($id = null) { 
        }

    }