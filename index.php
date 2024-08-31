<?php
$metodo = $_SERVER['REQUEST_METHOD'];
$partesRota = explode("/", $_SERVER['REQUEST_URI']);
if ($partesRota[1] == "prof") {
    if ($metodo == "POST") {
        require_once "controle/prof_cadastrar.php";
    } elseif ($metodo == "PUT") {
        require_once "controle/prof_atualizar.php";
    } elseif ($metodo == "DELETE") {
        require_once "controle/prof_excluir.php";
    } elseif ($metodo == "GET") {
        if (isset($partesRota[2])) {
            if (is_numeric($partesRota[2])) {
                require_once "controle/prof_buscar.php";
            } else if ($partesRota[2] == "") {
                require_once "controle/prof_listar.php";
            }
        } else {
            require_once "controle/prof_listar.php";
        }
    } else {
        header("HTTP/1.1 404 Not Found");
    }
} else {
    header("HTTP/1.1 404 Not Found");
}



if($partesRota[1] == "curso"){
    if($metodo=="POST"){
        require_once "controle.curso/curso_cadastrar.php";
    } elseif($metodo == "DELETE"){
        require_once "controle.curso/curso_excluir.php";
    } elseif ($metodo == "GET"){
        if (isset($partesRota[2])) {
            if (is_numeric($partesRota[2])) {
                require_once "controle.curso/curso_buscar.php";
            } else if ($partesRota[2] == "") {
                require_once "controle.curso/curso_listar.php";
            }
        } else {
            require_once "controle.curso/curso_listar.php";
        }

    }

}

if($partesRota[1]=="trabalhos"){
    if($partesRota[2]=="anonimo"){
        require_once "controle.trabalho/trabalho_listarAnonimos.php";
    }elseif ($metodo=="POST"){
        require_once "controle.trabalho/trabalho_cadastrar.php";
    }   elseif($metodo == "DELETE"){
        require_once "controle.trabalho/trabalho_excluir.php";
    }   elseif ($metodo == "GET"){
        if (isset($partesRota[2])) {
            if (is_numeric($partesRota[2])) {
                require_once "controle.trabalho/trabalho_buscar.php";
            } else if ($partesRota[2] == "") {
                require_once "controle.trabalho/trabalho_listar.php";
            }
        } else {
            require_once "controle.trabalho/trabalho_listar.php";
        }

    }
}

if($partesRota[1]=="gpalunos"){
    if($metodo=="POST"){
        require_once "controle.grupos/gpalunos_cadastrar.php";
    }   elseif($metodo == "DELETE"){
        require_once "controle.grupos/gpalunos_excluir.php";
    }   elseif ($metodo == "GET"){
        if (isset($partesRota[2])) {
            if (is_numeric($partesRota[2])) {
                require_once "controle.grupos/gpalunos_buscar.php";
            } else if ($partesRota[2] == "") {
                require_once "controle.grupos/gpalunos_listar.php";
            }
        } else {
            require_once "controle.grupos/gpalunos_listar.php";
        }

    }
}

if($partesRota[1]=="avaliar"){
    if($metodo=="POST"){
        require_once "controle.avaliar/avaliacao_cadastrar.php";
    }elseif ($metodo == "GET"){
        if($partesRota[2]=="profListar"){
            require_once "controle.avaliar/avaliacao_listarP.php";
        }else{
            require_once "controle.avaliar/avaliacao_listar.php";
        }
        
    }
}

if($partesRota[1]=="avaliaranonimo"){
    if($metodo=="POST"){
        require_once "controle.avaliarAnonimo/avaliacaoAnonima_cadastrar.php";
    }
}

if($partesRota[1]=="trabalhos"){
    if($partesRota[2]=="alfa"){
        require_once "controle.trabalho/trabalho_listarAlfa.php";
    }elseif($partesRota[2]=="daGalera"){
        require_once "controle.trabalho/trabalho_daGaleraOrdenado.php";
    }elseif($partesRota[2]=="notaEcurso"){
        require_once "controle.trabalho/trabalho_ListarNOTA&CURSO.php";

    }
}