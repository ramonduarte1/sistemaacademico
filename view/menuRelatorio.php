<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuRelatorio($tipo, $form) {
    $obj_response = new xajaxResponse();

    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Relatórios</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" method="post">     
           <table border='0'>
            <tr>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio" checked> Alunos Matriculados
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" > Alunos não Matriculados
                </td>
                <td rowspan="2"> 
                    <input type="button" value="Pesquisar" onclick="xajax_menuRelatorio('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <tr>
                <td class="esquerda">
                    <input type="radio" id="radio" value="3" name="radio"> Quantidade de Alunos por Turma
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="4" name="radio" > Disciplina por Professor
                </td>
            </tr>
            <tr>
                <td class="esquerda">
                    <input type="radio" id="radio" value="5" name="radio"> Alunos com matricula Trancada
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="6" name="radio" > Disciplina por Turma
                </td>
            </tr>
           </table>
        </form>
        <hr />
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $aluno = new Aluno();
        $alunos = $aluno->matriculados($form['radio']);

        if ($form['radio'] == 1) {//Alunos Matriculado
            $html = '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                      <table border="1">
                       <tr>
                          <th>Matricula</th>
                          <th>Nome</th>
                          <th>Turma</th>
                       </tr>';
            foreach ($alunos as $a) {
                $html .= '<tr>
                            <td class="centralizado">' . $a['id'] . ' </td>
                            <td>' . $a['nome'] . '</td>
                            <td class="centralizado">' . $a['turma_id'] . '</td>
                          </tr>';
            }
            $html .= '</table>  
                    </form>';
        }

        if ($form['radio'] == 2) {//Alunos não Matriculado
            $html = '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                      <table border="1">
                       <tr>
                          <th>Matricula</th>
                          <th>Nome</th>
                          <th>Situação</th>
                       </tr>';
            foreach ($alunos as $a) {
                $html .= '<tr>
                            <td class="centralizado">' . $a['id'] . ' </td>
                            <td>' . $a['nome'] . '</td>
                            <td class="centralizado">' . $a['situacao'] . '</td>
                          </tr>';
            }
            $html .= '</table>  
                    </form>';
        }

        if ($form['radio'] == 3) {//quantidade de alunos por turmas
            $a = new Aluno();
            $quant = $a->retornaQuantPorTurma();

            $html = '<form class="centralizado" id="formIdAluno" name="formIdAluno" action="" method="post">
                      <table border="1">
                       <tr>
                          <th>Codigo</th>
                          <th>Nome</th>
                          <th>Alunos</th>
                       </tr>';
            foreach ($quant as $q) {
                $k = 1;
                $html .= '<tr>
                            <td class="centralizado">' . $q['turma_id'] . ' </td>
                            <td class="centralizado">' . $q['nome'] . ' </td>
                            <td class="centralizado">' . $q['qtd'] . '</td>
                          </tr>';
            }
            $html .= '</table>  
                    </form>';
        }
        if ($form['radio'] == 4) {
            $p = new Professor();
            
            $html = '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                      <table class="bordasimples">
                       <tr>
                          <th>Matricula</th>
                          <th>Nome</th>
                          <th>Codigo</th>
                          <th>Disciplina</th>
                          <th>Carga Horaria</th>
                       </tr>';
            foreach ($p->retornaDisciplinasDoProfessor() as $professor) {
                $html .= '<tr class="centralizado">
                            <td >' . $professor['id_prof'] . ' </td>
                            <td >' . $professor['nome_prof'] . '</td>
                            <td >' . $professor['id_disc'] . '</td>
                            <td >' . $professor['nome_disc'] . '</td>
                            <td >' . $professor['carga_horaria'] . '</td>
                          </tr>';
            }
            $html .= '</table>  
                    </form>';
        }
        if ($form['radio'] == 5) {//retorna os aluno com matricula trancada
            $a = new Aluno();

            $html = '<form class="centralizado" id="formIdAluno" name="formIdAluno" action="" method="post">
                      <table border="1">
                       <tr>
                          <th>Matricula</th>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>Situação</th>
                       </tr>';
            foreach ($a->retornaAlunos(5, NULL) as $aluno) {
                $html .= '<tr>
                            <td class="centralizado">' . $aluno['id'] . ' </td>
                            <td class="centralizado">' . $aluno['nome'] . ' </td>
                            <td class="centralizado">' . $aluno['email'] . '</td>
                            <td class="centralizado">' . $aluno['situacao'] . '</td>
                          </tr>';
            }
            $html .= '</table>  
                    </form>';
        }
        if ($form['radio'] == 6) {//retorna AS DISCIPLINAS POR TURMA
            $t = new Turma();

            $html = '<form class="centralizado" id="formIdAluno" name="formIdAluno" action="" method="post">
                      <table border="1">
                       <tr>
                          <th>Codigo Turma</th>
                          <th>Nome</th>
                          <th>Codigo Disciplina</th>
                          <th>Nome</th>
                       </tr>';
            foreach ($t->retornaDisciplinasDaTurma() as $turma) {
                $html .= '<tr>
                            <td class="centralizado">' . $turma['id_turma'] . ' </td>
                            <td class="centralizado">' . $turma['nome_turma'] . ' </td>
                            <td class="centralizado">' . $turma['id_disc'] . '</td>
                            <td class="centralizado">' . $turma['nome_disc'] . '</td>
                          </tr>';
            }
            $html .= '</table>  
                    </form>';
        }

        $obj_response->assign("retorno", "innerHTML", $html);
    }
    return $obj_response;
}

// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario