<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuMatricula($tipo, $form) {
    $obj_response = new xajaxResponse();
    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Matricula</h2><br><br>
        <form id="formPesquisa" name="formPesquisa">     
           <table border="0">
                <tr>
                    <th colspan='4'>Aluno</th>
                </tr>
                <tr>
                    <td colspan="3">
                        <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                    </td>
                    <td>
                        <input type="button" value="Pesquisar" onclick="xajax_menuMatricula('filtrar_aluno', xajax.getFormValues('formPesquisa'))">
                    </td>
                </tr>
                <tr>
                    <td>Filtros</td>
                    <td>
                        <input type="radio" id="radio_aluno" value="3" name="radio_aluno" checked> Nome
                    </td>
                    <td>
                        <input type="radio" id="radio_aluno" value="4" name="radio_aluno"> Matricula
                    </td>
                </tr>
            </table>
        </form>
        <form id="formPesquisaTurma" name="formPesquisaTurma">
           <table border="0">
                <tr>
                    <th colspan='4'>Turma</th>
                </tr>
                <tr>
                    <td colspan="3">
                        <input required="" type="text" size="50" id="pesq_turma" name="pesq_turma">
                    </td>
                    <td>
                         <input type="button" value="Pesquisar" onclick="xajax_menuMatricula('filtrar_turma', xajax.getFormValues('formPesquisaTurma'))">
                    </td>
                </tr>
                <tr>
                    <td>Filtros</td>
                    <td>
                        <input type="radio" id="radio_turma" value="1" name="radio_turma" checked> Nome
                    </td>
                    <td>
                        <input type="radio" id="radio_turma" value="2" name="radio_turma"> Código
                    </td>
                </tr>
          </table>
        </form>
        <br><hr/><br>
        <div id="retorno" name="retorno"></div>
        <br><hr /><br>
                <h3 class="centralizado">Dados da Matricula</h3>
        <form class="centralizado" id="formMatricular" name="formMatricular">
            <div id="retorno_turma" name="retorno_turma"></div>
        </form>        
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar_aluno') {
        $aluno = new Aluno();
        $alunos = $aluno->retornaAlunos($form['radio_aluno'], $form['pesq_aluno']);
        $a = 1;
        $html = '';
        foreach ($alunos as $a) {
            $html .= '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                        <input readonly id="mat_aluno" name="mat_aluno" value="' . $a['id'] . ' " size="4">
                        <input readonly id="nome" name="nome" value="' . $a['nome'] . '">
                        <input readonly type="button" value="Matricular" onclick="xajax_menuMatricula(\'matricular_aluno\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                      </form>';
        }


        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'filtrar_turma') {
        $turma = new Turma();
        $turmas = $turma->retornaTurmas($form['radio_turma'], $form['pesq_turma']);
        $a = 1;
        $html = '';
        foreach ($turmas as $t) {
            $html .= '<form class="centralizado" id="' . formIdTurma . $t['id'] . '" name="formIdAluno" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $t['id'] . ' " size="4">
                        <input readonly id="nome" name="nome" value="' . $t['nome'] . '">
                        <input type="button" value="Matricular" onclick="xajax_menuMatricula(\'matricular_turma\',xajax.getFormValues(' . formIdTurma . $t['id'] . '))">
                      </form>';
        }
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'matricular_aluno') {
        $matricula = new Matricula();

        $matricula->matriculaAluno($form['mat_aluno']);
        $tipo = 'matricular_turma'; // muda para matricular_turma para entrar direto no proximo if
        
    }

    if ($tipo == 'matricular_turma') {

        $matricula = new Matricula();

        $aluno = $matricula->retornaAluno();//retorna o aluno que estar com o id salva na session
        $html = '<table border="1">  
                  <tr>
                    <th>Matricula</th>
                    <th colspan="2">Nome</th>
                  </tr>';
        foreach ($aluno as $a) {
            $html .= '
                  <tr>
                    <td class="centralizado">' . $a['id'] . '</td>
                    <td colspan="2">' . $a['nome'] . '</td>
                  </tr>';
        }

        $turma = $matricula->codigoTurma($form['matricula']);

        $html .= ' <tr>
                    <th colspan="3">Turma</th>
                  </tr>
                  <tr>
                    <th>Código</th>
                    <th colspan="2">Nome</th>
                  </tr>';
        foreach ($turma as $t) {
            $html .= '<tr>
                        <td class="centralizado">' . $t['id'] . '</td>
                        <td colspan="2" class="centralizado">' . $t['nome'] . '</td>
                      </tr>';
        }

        $d = new Disciplina();
        $disciplinas = $d->retornaDisciplinasPorTurma($form['matricula']);
        
        $html .= ' <tr>
                    <th>Código</th>
                    <th>Disciplina</th>
                    <th>Carga Horaria</th>
                   </tr>';
        foreach ($disciplinas as $disciplina) {
            $html .= '<tr>
                        <td class="centralizado">' . $disciplina['id'] . '</td>
                        <td>' . $disciplina['nome'] . '</td>
                        <td class="centralizado">' . $disciplina['carga_horaria'] . '</td>
                      </tr>';
        }
        $html .= '</table>';
        $html .= '<button onclick="xajax_adicionarTurma()">Matricular</button>';
        $obj_response->assign("retorno_turma", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $disciplina = new Disciplina();
        $matricula = $form['matricula'];
        $disciplina->setCodigo($matricula);
        $d = $disciplina->retornaDisciplina();
        $a = 1;

        $html = <<<HTML
            <form id="formDisciplina" name="formDisciplina" method="post">
                <table>
                    <tr>
                        <td class="direita">Codigo</td>
                        <td>
                            <input type="text" required name="matricula" size="4" value="{$d[0]['id']}">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" size="50" value="{$d[0]['nome']}">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Carga Horaria</td>
                        <td><input type="text" required name="carga_horaria" size="50" value="{$d[0]['carga_horaria']}"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_atualizarDisciplina(xajax.getFormValues('formDisciplina'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = <<<HTML
            <form id="formDisciplina" name="formDisciplina" method="post">
                <table>
                    <tr>
                        <td class="direita">Nome*</td>
                        <td>
                            <input type="text" required id="nome" name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Carga Horaria*</td>
                        <td><input type="text" required id="carga_horario" name="carga_horaria" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Ementa</td>
                        <td><input type="file" name="file" id="file" size="50"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_salvarDisciplina(xajax.getFormValues('formDisciplina'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}