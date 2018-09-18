<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuTurma($tipo, $form) {

    $obj_response = new xajaxResponse();
    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Cadastro Turma</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" methd="post">     
            <table border="0">
            <tr>
                <td colspan="3">
                    <input required="" type="text" size="50" id="pesq_turma" name="pesq_turma">
                </td>
                <td>
                     <input type="button" class="button" value="Pesquisar" onclick="xajax_menuTurma('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <tr>
                <td rowspan="2">Filtros</td>
                <td>
                    <input type="radio" id="radio" value="1" name="radio" checked> Nome
                </td>
                <td>
                    <input type="radio" id="radio" value="2" name="radio"> Matricula
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="radio" value="3" name="radio" >Professor
                </td>
                <td>
                    <input type="radio" id="radio" value="4" name="radio" >Aluno
                </td>
        </table>
        <hr/>
                <div class="centralizado">
                    <input type="button" class="button" value="Novo" onclick="xajax_menuTurma('novo')"> &nbsp &nbsp
                    <input type="button" class="button" value="Limpar" onclick="xajax_menuTurma('pesquisa')">
                </div>
        </form>
        <hr/>
        <br>
        <div id="retorno" name="retorno"></div>
        <div id="retornoDisciplinas" name="retornoDisciplinas"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $turma = new Turma();
        $turmas = $turma->retornaTurmas($form['radio'], $form['pesq_turma']);

        $html = '<div id="" style="overflow:scroll; height:350px;">'; //scroll
        foreach ($turmas as $t) {
            $html .= '<form class="centralizado" id="' . formIdTurma . $t['id'] . '" name="' . formIdTurma . $t['id'] . '" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $t['id'] . '" size="4">
                        <input readonly id="nome" name="nome" value="' . $t['nome'] . '">
                        <input type="button" class="button" value="Editar" onclick="xajax_menuTurma(\'editar\',xajax.getFormValues(' . formIdTurma . $t['id'] . '))">
                        <input type="button" class="button" value="Apagar" onclick="confirmacao(\'' . apagar_turma . $t['id'] . '\');">
                        <input type="hidden" id="' . 'apagar_turma' . $t['id'] . '" name="' . 'apagar_turma' . $t['id'] . '"  onclick="xajax_apagarTurma(xajax.getFormValues(' . formIdTurma . $t['id'] . '))">
                      </form>';
        }
        $html .= ' </div>';
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $turma = new Turma();
        $matricula = $form['matricula'];
        $turma->setCodigo($matricula);
        $t = $turma->retornaTurma();

        $d = new Disciplina();
        $disciplinas = $d->retornaTodasDisciplinas();
        $matriculadas = $d->retornaDisciplinasPorTurma($form['matricula']);

        $html = "<form id=\"formTurma\" name=\"formTurma\" method=\"post\">
                <table border=\"1\" class=\"semborda\">
                    <tr>
                        <td class=\"semborda\">Codigo</td>
                        <td class=\"semborda\">
                            <input type=\"text\" readonly name=\"matricula\" id=\"matricula\" size=\"4\" value=\"{$t[0]['id']}\">
                        </td>
                    </tr>
                    <tr >
                        <td class=\"semborda\">Nome</td>
                        <td class=\"semborda\">
                            <input type=\"text\" required name=\"nome\" id=\"nome\" size=\"50\" value=\"{$t[0]['nome']}\">
                        </td>
                    </tr>
                    <tr>
                        <td class=\"semborda\"></td>
                        <td class=\"semborda\"><input class='button' type=\"button\" class=\"button\" value=\"Salvar\" onclick=\"xajax_atualizarTurma(xajax.getFormValues('formTurma'))\"></td>
                    </tr>
                   
                    <tr><th colspan='3'>Disciplinas</th></tr>
                      <tr>
                        <th>Codigo</th>
                        <th colspan='2'>Disciplina</th>
                      </tr>";

        foreach ($disciplinas as $disciplina) {

            $html .= " <tr>
                            <td>{$disciplina['id']}</td>
                            <td>{$disciplina['nome']}</td>";

            if (in_array($disciplina['id'], array_column($matriculadas, 'disciplina_id'))) { //verifica se essa disciplina estar matriculada nessa turma
                $html .= "<td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . " checked></td>"; //se true deixa marcado
            } else {
                $html .= "<td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . "></td>";
            }
        }


        $html .= "</tr></table>";

        $html .= '
               </form>';

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $d = new Disciplina();
        $disciplinas = $d->retornaTodasDisciplinas();

        $html = "<form id=\"formTurma\" name=\"formTurma\" method=\"post\">
                    <table border=\"1\" class=\"semborda\">
                        <tr>
                            <td class=\"semborda\">Nome*</td>
                            <td colspan=\"2\" class=\"semborda\">
                                <input type=\"text\" required id=\"nome\" name=\"nome\" size=\"50\">
                            </td>
                        </tr>
                        <tr >
                            <td class=\"semborda\"></td>
                            <td colspan=\"2\" class=\"semborda\"><input type=\"button\" class=\"button\" value=\"Salvar\" onclick=\"return validarTurma()\"></td>
                            <input type=\"hidden\" id=\"salvar_turma\" name=\"salvar_turma\" onclick=\"xajax_salvarTurma(xajax.getFormValues('formTurma'))\">
                        </tr>";
        $html .= "<tr>
                            <th>Matricula</th>
                            <th>Nome</th>
                            <th></th>
                     </tr>";
        foreach ($disciplinas as $disciplina) {
            $html .= "<tr>
                                <td class=\"centralizado\">{$disciplina['id']}</td>
                                <td>{$disciplina['nome']}</td>
                                <td class=\"centralizado\"><input type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . "></td>
                     </tr>";
        }
        $htm .= "</table>
</form>";

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}
