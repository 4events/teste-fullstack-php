<?php
    
    require '../Service/VeiculosService.php';

    use Service\VeiculosService;

    class VeiculosController {

        public $method;
        public $arr;

        function __construct() {
            $this->method = $_SERVER['REQUEST_METHOD'];
            self::veiculosAction();
        }

        function veiculosAction() {
                
            $veiculosService = new VeiculosService();

            if($this->method === "POST"){

                if($_POST['id'] === ""){

                    unset($_POST['id']);
                    if(!isset($_POST['vendido'])) {
                        $_POST['vendido'] = "0";
                    }
                   
                    $res = $veiculosService->post($_POST);
                    header("Location: /fullstack-4events-mvc/Views/veiculos.php?status=".$res['status']."&code=".$res['code']);

                }elseif($_POST['id'] !== "" && is_numeric($_POST['id'])){

                    if(!isset($_POST['vendido'])) {
                        $_POST['vendido'] = "0";
                    }
                    $res = $veiculosService->put($_POST);
                    header("Location: /fullstack-4events-mvc/Views/veiculos.php?status=".$res['status']."&code=".$res['code']);
                }

            }

            $this->arr = $veiculosService->getVeiculos();

        }
        
        public function view(){
            return $this->arr['data'];
        }

    }

    $veiculos = new VeiculosController();

