<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/css.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            echo "<script>alert('Area restrita!');location.href=\"../index.php\"</script> ";
        }
        $logado = $_SESSION['login'];

        require_once '../autoload.php';


        $sql = "select *from disciplina where deletado = 'n'";

        $conexao = new Conexao();

        $disciplinas = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($disciplinas);

        include 'menu.php';
        ?>
        <h2 class="centralizado">Cadastro Turma</h2><br><br>
        <!--        <form action="../controller/TurmaController.php" method="post">-->
        <form action='../controller/teste.php' method='post'>
            <table>

                <table>
                    <tr>
                        <th colspan="2">Nome</th>
                        <th>Turno</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="text" required name="nome" size="29">
                        </td>
                        <td class="centralizado">
                            <select name="turno">
                                <option value="manha">Manhã</option>
                                <option value="tarde">Tarde</option>
                                <option value="noite">Noite</option>
                            </select>
                        </td>
                    </tr>

                    <?php
                    if (count($disciplinas) < 1) {
                        echo 'Nenhuma Disciplina Cadastrada!';
                    } else {
                        ?>

                        <tr>
                            <th>Matricula</th>
                            <th>Nome</th>
                            <th>Carga Horaria</th>
                            <th></th>
                        </tr>
                        <?php foreach ($disciplinas as $disciplina) {
                            ?>
                            <tr>
                                <td><input size='4' readonly name='matricula' value="<?php echo $disciplina['id'] ?> "></td>
                                <td><input required name='nome' type='text' value="<?php echo $disciplina['nome'] ?> "></td>
                                <td><input required name='carga_horaria' type='text' value="<?php echo $disciplina['carga_horaria'] ?> "></td>
                                <td><input class="centralizado" type='checkbox' name="disciplinas[]" value="<?php echo $disciplina['id'] ?>"></td>
                            </tr>

                        <?php }
                        ?>
                        <tr>
                            <td colspan="2"></td>
                            <td><button class="direita">Salvar</button></td>
                        </tr>
                    </table>

            </form>

        <?php }
        ?>
    </body>
</html>
