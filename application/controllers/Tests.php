<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $methods = get_class_methods('Tests');
        $ignore = array('index', '__construct', 'get_instance');
        foreach ($methods as $inc => $method) {
            if (!in_array($method, $ignore))
                echo anchor(base_url('index.php/Tests/' . $method), $method), '<br>';
        }
    }

    public function lib_template_parser() {
        $this->load->library('parser');
        $dados = array(
            'title' => 'CI Template parser example',
            'colunas' => array(
                array('Content' => 'Content 1'),
                array('Content' => 'Content 2'),
                array('Content' => 'Content 3'),
                array('Content' => 'Content 4')
                )
            );
        $this->parser->parse('tests/tests_template_parser', $dados);
    }

    public function lib_template_valkhan() {
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
