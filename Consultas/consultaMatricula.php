<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resposta = '';
session_start();
var_dump($_SESSION['aluno_disciplina']['disciplina']);
foreach ($_SESSION['aluno_disciplina'] as $key=>$value) {
    if($key === 'aluno'){
        echo 'key '.$key.' value '.$value;
    }else{
        echo 'key '.$key.' value '.$value['2'];
    }
    
          
    
}
if(!empty($resposta)){
    echo $resposta;
}else{
    echo 'Aluno não encontrado!';
}

    
