<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo '<ul>
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">Cadastro</a>
          <div class="dropdown-content">
            <a href="cadastro_aluno.php">Aluno</a>
            <a href="cadastro_professor.php">Professor</a>
            <a href="cadastro_disciplina.php">Disciplina</a>
            <a href="cadastro_turma.php">Turma</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">Consulta</a>
          <div class="dropdown-content">
            <a href="consulta_aluno.php">Aluno</a>
            <a href="consulta_professor.php">Professor</a>
            <a href="consulta_disciplina.php">Disciplina</a>
            <a href="consulta_turma.php">Turma</a>
            <a href="consulta_turma_aluno.php">Aluno por Turma</a>
            <a href="consulta_boletinho.php">Boletinho</a>
          </div>
        </li>
          <li><a href="matricular_aluno.php">Matricular</a></li>
          <li><a href="lancar_notas.php">Lançar Notas</a></li>
          <li><a href="../controller/Logout.php">sair</a></li>
      </ul><br><br>';
