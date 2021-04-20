<?php

    $mensagem = '';
    //se existir get status na hora do retorno da mensagem em header
    if(isset($_GET['status'])){
        switch($_GET['status']){
            //executa a mensagem de sucesso na parte superior da tela
            case 'sucess':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso</div>';
                //e finaliza a ação
                break;
            //Caso contrário se a mensagem for de "error" executa uma mensagem em vermelho
            case 'error': 
                $mensagem = '<div class="alert alert-danger">Ação não conseguiu ser executada</div>';
                break;
        }
    }

    $resultados = '';
    foreach($vagas as $vaga){
        $resultados .= '<tr>
                            <td>'.$vaga->id_vagas.'</td>
                            <td>'.$vaga->titulo.'</td>
                            <td>'.$vaga->descricao.'</td>
                            <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                            <td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->data)).'</td>
                            <td>
                                <a href="editar.php?id='.$vaga->id_vagas.'">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="excluir.php?id='.$vaga->id_vagas.'">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    } 

    //strlen retorna o tamanho da variável
    $resultados = strlen($resultados) ? $resultados :  '<tr>
                                                            <td colspan="6" class="text-center">
                                                                Nenhuma vaga encontrada
                                                            </td>
                                                        </tr>';
?>

    <main>
        <!-- Chamando a mensagem -->
        <?=$mensagem?>
        <section>
            <a href="cadastrar.php">
                <button class="btn btn-success">Nova vaga</button>
            </a>
        </section>

        <section>
            <table class="table bg-light mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            
            </table>
        </section>
    </main>

