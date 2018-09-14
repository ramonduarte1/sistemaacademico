<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($class_name) {
    $diretorios = array(
        'Consultas/',
        'banco/',
        'controller/',
        'model/',
        'view',
        'util',
        'lib'
    );
    $caminhos = array(
        '',
        '../',
        './',
        '../../'
    );
//echo $class_name;
    if ($class_name) {
        foreach ($caminhos as $caminho) {
            // echo "$caminho <br>";
            foreach ($diretorios as $diretorio) {
                $arquivo = $caminho . $diretorio . $class_name . '.php';
                //echo "$arquivo<br>";
                if (file_exists($arquivo)) {
                   // echo "$arquivo";
                    require_once($arquivo);
                    return;
                }
            }
        }
    }
}
