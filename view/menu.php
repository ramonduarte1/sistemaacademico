<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//form_Modulo_menu
function menuPrincipal() {
    $html = <<<HTML
       <ul>
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">Cadastro</a>
          <div class="dropdown-content">
            <a onclick="xajax_menuAluno('pesquisa')">Aluno</a>
            <a onclick="xajax_verificaCredenciais()">Professor</a>
            <a onclick="xajax_salvarAluno(xajax.getFormValues('formLogin'))">Disciplina</a>
            <a onclick="xajax_verificaCredenciais(xajax.getFormValues('formLogin'))">Turma</a>
          </div>
        </li>
          <li><a href="#" onclick="xajax_verificaCredenciais(xajax.getFormValues('formLogin'))">Matricular</a></li>
          <li><a href="#" onclick="xajax_verificaCredenciais(xajax.getFormValues('formLogin'))">Lançar Notas</a></li>
          <li><a href="#" onclick="xajax_verificaCredenciais(xajax.getFormValues('formLogin'))">sair</a></li>
      </ul>
HTML;
    
    $obj_response = new xajaxResponse();

    $obj_response->assign("conteudo", "innerHTML", $html);

    return $obj_response;
}
