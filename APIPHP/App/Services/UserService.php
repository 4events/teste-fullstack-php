<?php
    namespace App\Services;
    use App\Models\User;

    /**
     * Controller que fará a chamada dos métodos implementrados no model
     */
    class UserService
    {
        /**
         * Função get realiza a chamada da função de busca de um ou vários
         * elementos do banco de acordo com o parâmetro id
         */
        public function get($id = null) 
        {
            if ($id) {
                return User::select($id);
            }
             else {
                return User::selectAll();
            }
        }
        /**
         * Função post faz a chamada da função de busca de elementos por like,
         * e chama também a função insert ou update de acordo com o parâmetro.
         */
        public function post($data) 
        {
            $data = explode("---", $data);

            //busca
            if($data[0] == "busca"){
                array_shift($data);
                return User::busca($data);
            }else if($data[0] == "insert"){
                array_shift($data);
                return User::insert($data);

            }else if($data[0] == "update"){
                array_shift($data);
                return User::update($data);
            }
            return $data;
            //return User::busca($data);
        }
    }