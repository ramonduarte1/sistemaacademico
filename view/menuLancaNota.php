<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuLancaNota($tipo, $form) {
    $obj_response = new xajaxResponse();
//, xajax.getFormValues('formPesquisa')
    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Incluir Notas</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" method="post">     
        <table border="0">
            <tr>
                <th>Pesquisa</th>
                    <td>
                        <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                    </td>
                    <td>
                        <input type="button" value="Pesquisar" onclick="xajax_menuLancaNota('filtrar', xajax.getFormValues('formPesquisa'))">
                    </td>
            </tr>
           <table border='0'>
            <tr>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio" checked>Nome
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" >Matricula
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="3" name="radio">Turma
                </td>
            </tr>
           </table>
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
        $alunos = $aluno->pesqMenuMatricula($form);

        $html = '';
        foreach ($alunos as $a) {
            $html .= '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $a['id'] . ' " size="4">
                        <input readonly id="nome" name="nome" value="' . $a['nome'] . '">
                        <input readonly type="button" value="Incluir Notas" onclick="xajax_menuLancaNota(\'incluir_notas\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                      </form>';
        }

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'incluir_notas') {
        $aluno = new Aluno();
        $aluno->setMatricula($form['matricula']);

        $a = $aluno->retornaAluno();

        $html = "<form id=\"formIncluirNotas\" name=\"formIncluirNotas\">
                 <table class='centralizado' border=\"1\">
                   <tr>
                       <td colspan=\"8\">Aluno</td>
                   </tr>
                   <tr>
                        <th>Matricula</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th colspan=\"4\">Endereco</th>
                        <th>Telefone</th>
                   </tr>
                   <tr>
                        <td>" . $a[0]['id'] . "</td>
                            <input type=\"hidden\" id=\"aluno_id\" name=\"aluno_id\" value=".$a[0]['id'].">
                        <td>" . $a[0]['nome'] . "</td>
                        <td>" . $a[0]['email'] . "</td>
                        <td colspan='4'>" . $a[0]['endereco'] . "</td>
                        <td>" . $a[0]['telefone'] . "</td>
                   </tr>
                   <tr>
                        <td colspan=\"8\" >Disciplinas</td>
                   </tr>
                   <tr>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>Carga Horária</th>
                        <th>Nota 1</th>
                        <th>Nota 2</th>
                        <th>Nota 3</th>
                        <th>Media</th>
                        <th>Situação</th>
                   </tr>";
        $disciplinas = new Disciplina();
        $result = $disciplinas->retornaDisciplinasPorTurma($a[0]['turma_id']);
        $disciplinasA = array(); // aqui vai ser usado update pois a tabela (aluno_disciplina) ja deve estar preenchida no momento da matricula 

        foreach ($result as $disciplina) {
            array_push($disciplinasA, $disciplina);
        }
        foreach ($disciplinasA as $d) {
            $html .= "<tr>
                        <td>" . $d['id'] . "</td>
                            <input type=\"hidden\" id=\"disciplinas[]\" name=\"disciplinas[]\" value=".$d['id'].">
                        <td>" . $d['nome'] . "</td>
                        <td>" . $d['carga_horaria'] . "</td>
                        <td><input id=".$d['id'].n1." name=".$d['id'].n1." value='0.0' size='4' ></td>
                        <td><input id=".$d['id'].n2." name=".$d['id'].n2." value='0.0' size='4' ></td>
                        <td><input id=".$d['id'].n3." name=".$d['id'].n3." value='0.0' size='4' ></td>
                        <td><input readonly type='text' size='4' ></td>
                        <td><input readonly type='text' size='8' ></td>
                     </tr>";
        }
        $turma = new Turma();
        $turma->setCodigo($a[0]['turma_id']);

        $t = $turma->retornaTurma();

        $html .= "<tr>
        <td colspan = '8'>Turma</td>
        </tr>
            <tr>
                <th>Codigo</th>
                <th colspan = '7' >Nome</th>
                </tr>
                <tr>
                <td>" . $a[0]['turma_id'] . "</td>
                <td colspan = '7'>" . $t[0]['nome'] . "</td>
                </tr>
                <tr>
                <td colspan = '7'></td>
                <td><button onclick =\"xajax_incluirNotas(xajax.getFormValues('formIncluirNotas'))\">Salvar</button>
                </tr>";

        $html .= "<table>
                  </form>";
//$obj_response->alert("ok");
        $obj_response->assign("retorno", "innerHTML", $html);
    }
    return $obj_response;
}

// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario