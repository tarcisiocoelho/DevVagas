<?php
require __DIR__.'/vendor/autoload.php';

//define -> uma constante que pode ser chamada em outros lugares como ex trocar o título da página
define('TITLE', 'Cadastrar vaga');

use \App\Entity\Vaga;

$obVaga = new Vaga;

//validar se os dados chegaram corretamente
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){  
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];
    $obVaga->cadastrar();

    //Voltando para a página inicial
    header('location: index.php?status=sucess');
    //Impedir a execução do restante da página
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';

?>