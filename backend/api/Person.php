<?php
    /**
     * Arquivo que irá receber todas as requisições de usuários
     */

    header("Content-Type: application/json");
    include_once("../Classes/class-person.php");
    //sleep(3);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST': //create
                $_POST = json_decode(file_get_contents('php://input'),true);// recebe um json decodifica em um array assossiativo
                $person = new Person($_POST["name"], $_POST["endereco"], $_POST["cep"], $_POST["dataNasc"], $_POST["telefone"]);
                $person->create();
                $resultado["mensagem"] = "Salvar Usuario, dados: " . json_encode($_POST);
                echo json_encode($resultado);
            break;
        case 'GET': //read
                if(isset($_GET['id'])){
                    Person::read($_GET['id']);
                } else {
                    Person::readAll();
                    
                }
            break;
        case 'PUT': //update
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $person = new Person($_PUT['name'], $_PUT['endereco'], $_PUT['cep'], $_PUT['dataNasc'], $_PUT['telefone']);
            $person->update($_GET['id']);
            $resultado["mensagem"] =    " Atualizar dados com o id: ".$_GET['id'].
                                        ", Dados a atualizar: ".json_encode($_PUT);
            echo json_encode($resultado);
            break;
        case 'DELETE': //delete
            Person::delete($_GET['id']); 
            $resultado["mensagem"] = " Deleta dados do usuario com o id: ".$_GET['id'];
            echo json_encode($resultado);
            break;
    }
?>