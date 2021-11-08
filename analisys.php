<?php

    require_once('conn.php'); 

    function sol_method($vm,$vu,$vp,$vg){

        $vp = isset($vp) ? json_decode($vp, true) : null;

        $vg = isset($vg['q']) ? $vg['q'] : null;

        $vu = explode("/", $vu);

        // Variável retorno
        $response_final = array('header' => '', 'end' => '');

        // Retorna JS
        if( ($vu[1]==='script.js') ){

            $response_final['header'] = 'text/javascript';
            $response_final['end'] = file_get_contents('script.js');

            return $response_final;
        }

        // Retorna CSS
        if( ($vu[1]==='style.css') ){

            $response_final['header'] = 'text/css';
            $response_final['end'] = file_get_contents('style.css');

            return $response_final;
        }

        // Retorna INDEX
        if( ($vu[1]==='') ){

            $response_final['header'] = 'text/html';
            $response_final['end'] = file_get_contents('index.html');

            return $response_final;
        }

        // Valida dados POST
        if( valid_var($vp) ){

            $response_final['header'] = 'application/json';
            $response_final['end'] = '{"err": "01", "msg":"Erro ao processar relatório. Certifique-se que você enviou somente textos nos campos"}';

            return $response_final;
        }

        $vs = !vvar($vu);

        // Retorna POST
        if( ($vm === 'POST') && ($vu[1] === 'veiculos') ){

            $response_final['header'] = 'application/json';
            $response_final['end'] =  getpost($vm,$vs,$vp,$vg);

            return $response_final;
        }

        // Retorna GET
        if( ($vm === 'GET') && ($vu[1] === 'veiculos') && ( $vs ) ){

            $response_final['header'] = 'application/json';
            $response_final['end'] =  getpost($vm,$vs,$vp,$vg);

            return $response_final;
        }

        // Retorna GET - BUSCA USER
        if( ($vm === 'GET') && (!$vs) && (isset($vg)) ){

            $response_final['header'] = 'application/json';
            $response_final['end'] =  getpost($vm,$vs,$vp,$vg);

            return $response_final;
        }

        $response_final['header'] = 'application/json';
        $response_final['end'] = '{"err": "05", "msg":"FIM"}';
        return $response_final;
    }

    function vvar($secValue){

        return isset($secValue[2]) ? true : false;
    }

    function valid_var($dt){

        if ( isset($dt) ){
            foreach ($dt as $varv) {

                if( gettype($varv) != 'string' ){

                    return true;

                }

            }
        }

        return false;
    }
