<?php
require 'conexao.php';

// Buscar treinos do banco de dados
$sql = $pdo->prepare("SELECT gt.*, a.nome AS aluno, p.nome AS professor 
                      FROM grafico_treinos gt
                      LEFT JOIN aluno a ON gt.id_aluno = a.id_aluno
                      LEFT JOIN professores p ON gt.id_professor = p.id_professor");
$sql->execute();
$treinos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Treinos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Agenda de Treinos</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Aluno</th>
                        <th>Professor</th>
                        <th>Treino</th>
                        <th>Atividade</th>
                        <th>Dia</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($treinos) > 0): ?>
                        <?php foreach ($treinos as $treino): ?>
                            <tr>
                                <td><?= $treino['aluno']; ?></td>
                                <td><?= $treino['professor']; ?></td>
                                <td><?= ucfirst($treino['tipo_treino']); ?></td>
                                <td><?= $treino['atividade']; ?></td>
                                <td><?= ucfirst($treino['dia_semana']); ?></td>
                                <td><?= $treino['horario']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum treino encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="text-right mt-3">
            <a href="cadastrar_treino.php" class="btn btn-danger">Cadastrar Novo Treino</a>
        </div>
    </div>
</body>
</html>
