Descrição 
========

Este fork foi gerado para compatibilidade com o framework Codeigniter, para maiores detalhes peço que veja a o repositório original mantido pelo criador da classe Rael.

Suporte para classe será oferecido de acordo com meu entendimento sobre a classe original e aos recursos que eu adicionei listados abaixo:

1 - dieOnError - Habilita/desabilita alguns erros disparados por não encontrar blocos e variáveis.

2 - caseInsensitiveVars - Habilita/desabilita o preenchimento de variáveis/blocos sem considerar o 'case' na qual foram originadas.

3 - CodeIgniter - Dúvidas em relação à utilização e instalação em conjunto com o framework CodeIgniter e alterações pertinentes.

4 - funções: blockArr, varsArr, addArray - Estas funções foram adicionadas, e posso oferecer suporte a elas também.

## Histórico

16/07/2016 - v2.3 - Geração de pacote inicial de compatibilidade com o CodeIgniter. 

## Download

Para baixar a biblioteca escolha entre:

- Usar o git para clonar o repositório (`git clone git@github.com:raelgc/template.git`) ou
- Baixar o [arquivo .zip](https://github.com/raelgc/template/archive/master.zip).

## Licença
Faço das palavras do Rael as minhas:

A licença desta biblioteca é regida pela licença LGPL. Ou seja, você pode utilizá-la, como biblioteca, mesmo em projetos comerciais.

Lembre-se apenas de ser uma pessoa legal e enviar de volta eventuais modificações, correções ou melhorias.


## Requisitos Necessários

É preciso usar qualquer versão do PHP igual ou superior a 5.3.


## Instalação e Uso

1 - Descompacte o arquivo .zip dentro da raiz do projeto do CodeIgniter

2 - Carregue a biblioteca utilizando o método load do codeigniter

3 - Configure os parametros iniciais e use a classe conforme necessidade (ver exemplo abaixo)

Arquivo PHP
``` php
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends CI_Controller {
public function teste() {
        //-- Desired config
        $config = array(
            'dieonerror' => false, //-- Disables some errors
            'accurate' => false, //-- Disable accurate
            'caseinsensitivevars' => true, //-- Enable case sensitive sets of variables and blocks
            /*'filename' => VIEWPATH.'tests/tests_template_valkhan.html'*/ //-- Load file (I do not recommend using this argument as it can break script execution if file does not exist, see how to manually load file below)
            );
        //-- Load library
        $this->load->library(
            'template', //-- Library name
            $config, //-- Config array
            'myTpl' //-- Desired alias
            );
        //-- Manually load template file: use dot as first argument
        $this->myTpl->addFile('.',VIEWPATH.'tests/tests_template_valkhan.html'); 
        //-- Folder data to output 
        $folders = array(
            'disk1' => array(
                'musics'  => array('rock','symphonic metal','soundtrack'),
                'images'  => array('wallpapers','family')
                ),  
            'disk2' => array(
                'programs'  => array('sublime_text','xampp'),
                'games'  => array('watch_dogs','assassins_creed','nba 2k16')
                )
            );

        //-- Old fashion way of populating the template:
        foreach($folders as $nest1 => $next){
            foreach($next as $nest2 => $next2){
                $this->myTpl->NAME_NEST2 = $nest2;
                foreach($next2 as $nest3){
                    $this->myTpl->nAmE_nEsT1 = $nest1;
                    $this->myTpl->NAME_nest3 = $nest3;
                    $this->myTpl->block('NEST3'); 
                }
                $this->myTpl->block('NesT2'); 
            }
            $this->myTpl->nAmE_nEsT1 = $nest1;
            $this->myTpl->block('nest1'); 
        }
        
        //-- An anxiliary method for single blocks or variables setters
        $vehicles = array(
            array('name' => 'Car', 'type' => 'land'),
            array('name' => 'Motorbike', 'type' => 'land'),
            array('name' => 'Truck', 'type' => 'land'),
            array('name' => 'Boat', 'type' => 'sea'),
            array('name' => 'Battleship', 'type' => 'sea'),
            array('name' => 'Airplane', 'type' => 'air'),
            array('name' => 'Rocket', 'type' => 'space')
            );

        $this->myTpl->title = 'Template example on CI';
        $this->myTpl->addArray($vehicles,'vehicles');
        $this->myTpl->show();
    }
}
```

Arquivo HTML

``` html
<!DOCTYPE html>
<html>
<head>
    <title>{TITLE}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        fleft{
            float: left;
        }
    </style>
</head>
<body>
    <h1>Folders</h1>
    <!-- BEGIN NEST1 -->
    /{NAME_NEST1}<br>
        <!-- BEGIN NEST2 -->
        /{NAME_NEST1}/{NAME_NEST2}<br>
            <!-- BEGIN NEST3 -->
            /{NAME_NEST1}/{NAME_NEST2}/{NAME_NEST3}<br>
            <!-- END NEST3 -->
        <!-- END NEST2 -->
    <br>    
    <!-- END NEST1 -->
    <hr>
    <h1>Vehicles</h1>
    <!-- BEGIN VEHICLES -->
    <div class="fleft">{NAME} / {TYPE}</div>
    <!-- END VEHICLES -->
    <hr>
    <!-- BEGIN FINALLYEXAMPLE -->
    {SOMEVAR}
    <!-- END FINALLYEXAMPLE -->
    Nothing sent to 'FINALLYEXAMPLE' block.
    <!-- FINALLY -->
</body>
</html>
```
Qualquer dúvida quanto ao funcionamento da classe em si, por gentileza atentar aos exemplos deixados pelo Rael em seu repositório ou pelo site:
http://raelcunha.com/template/
