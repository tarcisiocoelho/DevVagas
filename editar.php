<?php
require __DIR__.'/vendor/autoload.php';

//define -> uma constante que pode ser chamada em outros lugares como ex trocar o título da página
define('TITLE', 'Editar vaga');

use \App\Entity\Vaga;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//Consulta a vaga
$obVaga = Vaga::getVaga($_GET['id']);

//Validar para ver se ela existe
if(!$obVaga instanceof Vaga){ // instanceof -> Se não existir a instancia da vaga ele dá um erro e volta para o index
    header('location: index.php?status=error');
    exit;
}

//validar se os dados chegaram corretamente
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];
    $obVaga->atualizar();
    //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

    //Voltando para a página inicial
    header('location: index.php?status=sucess');
    //Impedir a execução do restante da página
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';

?>