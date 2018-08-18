/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Funcoes = {
    consultarAluno: function () {

        $.ajax({
            type: "POST",
            url: "../Consultas/consultaAluno.php",
            data: 'pesq_aluno=' + $('#pesq_aluno').val(),
            success: function (data) {

                $('#tabelaAluno').html(data);
            }
        });
    },
    consultarDisciplina: function () {

        $.ajax({
            type: "POST",
            url: "../Consultas/consultaDisciplina.php",
            data: 'pesq_disciplina=' + $('#pesq_disciplina').val(),
            success: function (data) {
                $('#tabelaDisciplina').html(data);
            }
        });
    },
    consultaTurma: function () {

        $.ajax({
            type: "POST",
            url: "../Consultas/consultaTurma.php",
            data: 'pesq_turma=' + $('#pesq_turma').val(),
            success: function (data) {
                $('#tabelaTurma').html(data);
            }
        });
    },
    consultaProfessor: function () {

        $.ajax({
            type: "POST",
            url: "../Consultas/consultaProfessor.php",
            data: 'pesq_professor=' + $('#pesq_professor').val(),
            success: function (data) {
                $('#tabelaProfessor').html(data);
            }
        });
    }

}