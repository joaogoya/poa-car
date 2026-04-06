<?php

/*******************************************************/
/**************** POSTTYPE PRODUTOS ********************/
/*******************************************************/


add_action('init', 'type_post_produtos');

function type_post_produtos()
{

    $descritivos = array(
        'name' => 'Produtos',
        'singular_name' => 'Vídeo',
        'add_new' => 'Adicionar Novo Produto',
        'add_new_item' => 'Adicionar Produto',
        'edit_item' => 'Editar Produto',
        'new_item' => 'Novo Produto',
        'view_item' => 'Ver Produto',
        'search_items' => 'Procurar Produto',
        'not_found' =>  'Nenhum Produto encontrado',
        'not_found_in_trash' => 'Nenhum Produto na Lixeira',
        'parent_item_colon' => '',
        'menu_name' => 'Produtos'
    );

    $args = array(
        'labels' => $descritivos,
        'public' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-store',
        'menu_position' => 36,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt', 'custom-fields', 'revisions', 'trackbacks')
    );

    register_post_type('Produtos', $args);
    flush_rewrite_rules();
}


/*******************************************************/
/******************** POSTTYPE HOME ********************/
/*******************************************************/


add_action('init', 'type_home_config');

function type_home_config()
{

    $descritivos = array(
        'name' => 'Home Config',
        'singular_name' => 'Configuração',
        'add_new' => 'Adicionar Nova configuração',
        'add_new_item' => 'Adicionar configuração',
        'edit_item' => 'Editar configuração',
        'new_item' => 'Nova configuração',
        'view_item' => 'Ver configurações',
        'search_items' => 'Procurar configuração',
        'not_found' =>  'Nenhum configuração encontrada',
        'not_found_in_trash' => 'Nenhum configuração na Lixeira',
        'parent_item_colon' => '',
        'menu_name' => 'Home Config'
    );

    $args = array(
        'labels' => $descritivos,
        'public' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-admin-home',
        'menu_position' => 36,
        'supports' => array('title', 'custom-fields', 'revisions')
    );

    register_post_type('home_config', $args);
    flush_rewrite_rules();
}




/*******************************************************/
/*************** POSTTYPE DIFERENCIAIS *****************/
/*******************************************************/


add_action('init', 'type_post_diferenciais');

function type_post_diferenciais()
{

    $descritivos = array(
        'name' => 'Diferenciais',
        'singular_name' => 'Diferencial',
        'add_new' => 'Adicionar Novo Diferencial',
        'add_new_item' => 'Adicionar Diferencial',
        'edit_item' => 'Editar Diferencial',
        'new_item' => 'Novo Diferencial',
        'view_item' => 'Ver Diferenciais',
        'search_items' => 'Procurar Diferencial',
        'not_found' =>  'Nenhum Diferencial encontrado',
        'not_found_in_trash' => 'Nenhum Diferencial na Lixeira',
        'parent_item_colon' => '',
        'menu_name' => 'Diferenciais'
    );

    $args = array(
        'labels' => $descritivos,
        'public' => true,
        'hierarchical' => true,
        'menu_icon' => 'dashicons-superhero',
        'menu_position' => 36,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt', 'custom-fields', 'revisions', 'trackbacks', 'page-attributes')
    );

    register_post_type('diferenciais', $args);
    flush_rewrite_rules();
}



