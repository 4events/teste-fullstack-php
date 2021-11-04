<?php

    require_once('conn.php'); 

    function sol_method($vu,$vm,$vg,$vp){

        $vu = explode("/", $vu);

        $vp = isset($vp) ? json_decode($vp, true) : null;

        $vg["q"] = isset($vg["q"]) ? $vg["q"] : null;

        if( valid_var($vp) ){

            return '{"err": "01", "msg":"Erro ao processar relatório. Certifique-se que você enviou somente textos nos campos"}';

        }

        if( ($vu[1] === '') ){

            $file = 'index.html';

            $current = file_get_contents($file);

            return $current;
        }

        if( ($vm === 'POST') && ($vu[1] === 'veiculos') ){

            var_dump($vp);

            return getpost(
                $vm,
                !vvar($vu),
                $vp,
                $vg["q"]
            );

        }

        if( ($vm === 'GET') && ($vu[1] === 'veiculos') && (!vvar($vu)) ){

            return getpost(
                $vm,
                !vvar($vu),
                $vp,
                $vg["q"]
            );

        }

        if( ($vm === 'GET') && (vvar($vu)) && (isset($vg["q"])) ){

            return getpost(
                $vm,
                !vvar($vu),
                $vp,
                $vg["q"]
            );

        }
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