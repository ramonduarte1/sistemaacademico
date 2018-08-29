<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of escola
 *
 * @author usuario
 */
//require_once '';

class Escola {

    private $conexao;

    function __construct() {
       
        try {
            $this->conexao = new Conexao();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function consultaPerfil() {
        $sql = "insert into escola (nome,endereco) values ('escola teste 2', 'endereco teste 2')";
        $sql2 = "select *from escola";
        $perfilSelect = $this->conexao->query($sql); //->fetchAll(PDO::FETCH_ASSOC);
        $perfilSelect->execute();
        if ($perfilSelect == false)
            echo '<br>erro';

        foreach ($perfilSelect as $escola) {
            echo $escola['nome'];

        }
        foreach ($escolas as $escola) {
            echo $escola->getNome();
        }
    }

}
