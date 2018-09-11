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
            <a href="#" onclick="xajax_menuAluno('pesquisa')">Aluno</a>
            <a href="#" onclick="xajax_menuProfessor('pesquisa')">Professor</a>
            <a href="#" onclick="xajax_menuDisciplina('pesquisa')">Disciplina</a>
            <a href="#" onclick="xajax_menuTurma('pesquisa')">Turma</a>
          </div>
        </li>
          <li><a href="#" onclick="xajax_menuMatricula('pesquisa')">Matricula</a></li>
          <li><a href="#" onclick="xajax_menuRelatorio('pesquisa')">Relatório</a></li>
          <li><a href="#" onclick="xajax_menuLancaNota('pesquisa')">Incluir Notas</a></li>
          <li><a href="#" onclick="xajax_sair()">sair</a></li>
      </ul>
HTML;

    $obj_response = new xajaxResponse();

    $obj_response->assign("conteudo", "innerHTML", $html);

    return $obj_response;
}
