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
                    <input type="radio" id="radio" value="4" name="radio" > Não matriculado por matricula
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
        if ($form['radio'] == 1) {
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
        if ($form['radio'] == 2) {
            $html = '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                      <table border="1">
                       <tr>
                          <th>Matricula</th>
                          <th>Nome</th>
                       </tr>';
            foreach ($alunos as $a) {
                $html .= '<tr>
                            <td class="centralizado">' . $a['id'] . ' </td>
                            <td>' . $a['nome'] . '</td>
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