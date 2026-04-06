<?php

/*******************************************************/
/******************* IMG ATRIBUTES *********************/
/*******************************************************/

    /*
        Escreve os atributos das imagens
            src, alt, title, altura, srcset, largura, ...
            Escrever isso tudo na tag img ajuda na performance e no SEO
            Retorna toda a tag img

        Sobre os parametros:
        $id
            Se for thumbnail vem o id do post
            se for acf ou galeria vem o id da img

        $is_thumb
            Se for thumbnail vem true
            Se não for thumb vem false

        $size_to_serve
            String com a largura que queremos servir a imagem
                thumb - 150
                small - 300
                medium - 662
                large - 1024
                big - 1686
                wide - 2348

        $class
            String de classes do html. O atributo class=""
    */

    /*
        Exemplo de utilização
        
            ao invés de escrever:
                <img src="endereco/da/imagem.jpg" class="w-100 nome-de-outra-class" alt="textto alternativo" />

            escreva:
                se for uma thumb
                    echo pipe_get_img($post-ID, true, 'medium', 'w-100 nome-de-outra-class');

                se for acf
                     echo pipe_get_img($id_imagem, false, 'medium', 'w-100 nome-de-outra-class');

            A função retorna a tag img escrita.
            
    */


function pipe_get_img($id, $is_thumb, $size_to_serve, $class)
{
    /*Configurações iniciais*/

    //Seta o id da img
    $img_id = $is_thumb ? get_post_thumbnail_id($id) : $id;


    // buscas os atrr da img
    $attachment = get_post($img_id);

    // Busca o srcset da img
    $img_srcset = wp_get_attachment_image_srcset($img_id,);


    // Monta a tag img para ser retornada
    $image = '
        <img
        loading="lazy"
        class="' . $class . '"
        width="' . pipe_img_new_size($attachment, $size_to_serve)['width'] . '" 
        height="' . pipe_img_new_size($attachment, $size_to_serve)['height'] . '" 
        src="' . $attachment->guid . '"
        srcset="' . $img_srcset . '"        
        alt="' . get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) . '"
        title="' . $attachment->post_title . '"
        sizes="
            (max-width: 576px) ' . pipe_img_srcset($img_srcset)['small'] . 'vw,
            (max-width: 992px) ' .  pipe_img_srcset($img_srcset)['medium'] . 'vw,
            (max-width: 1300px) ' .  pipe_img_srcset($img_srcset)['large'] . 'vw,
            ' .  pipe_img_srcset($img_srcset)['medium'] . 'vw" >
    ';

    //Retorna a tag img com tudo escrito
    return $image;
}


/*******************************************************/
/**************** FUNÇÕES UTILITARIAS ******************/
/*******************************************************/


function pipe_img_srcset($img_srcset)
{

    /*
        Esta function cria um array com 03 sugestões de tamanhos
        Se o caesso vem de um mobile não tem pq carregar uma img de 2450 de largura
        é para isso que serve esse array de tamanhos
        03 sugestões de tamanhos.

        Para tanto, precisamos buscar todos os tamanhos de imgs que o wp cria qd subimos uma img para a galeria.
        Por isso o srcset vem por parametro
        Com o array de srcset temos todos os tamanhos
    */


    /*Se srcsets virem populados, 
        executa, 
    se não, 
        retorna um array vazio
    */
    if ($img_srcset) :


        /*
            Cria um array com os tamanhos informados no final de cada srcset
        */
        $srcset_array = explode(',', $img_srcset);
        $srcset_sizes = array();
        foreach ($srcset_array as $src_and_size) {

            $src_and_size_array = explode(' ', $src_and_size);

            $size = end($src_and_size_array);

            $size = str_replace('w', '', $size);

            $size = intval($size);

            array_push($srcset_sizes, $size);
        }
        asort($srcset_sizes);


        /*
            Cria um array com 03 sugestões de tamanhos, apartir do array de tamanhos do srcset
        */
        $total_de_tamanhos = count($srcset_sizes);
        $elemento_do_meio = intdiv($total_de_tamanhos, 2);

        $small = $srcset_sizes[0];
        $medium = $srcset_sizes[$elemento_do_meio];
        $large = end($srcset_sizes);

        $size_suggestions = array(
            'small' => $small,
            'medium' => $medium,
            'large' => $large
        );

    else :
        $size_suggestions = array();

    endif;

    // Retorna o array
    return $size_suggestions;
}

/*=============================================================================================*/
/*=============================================================================================*/

function pipe_img_new_size($attachment, $size_to_serve)
{
    /*
        Calcula qual deve ser o height da imagem, a partir da largura que queremos servir
        Este calculo visa manter as proporções da imagem
    */

    //dimensoões da imagem original
    $image_size = getimagesize($attachment->guid);
    $width = $image_size['0'];
    $height = $image_size['1'];

    //seta nova largura
    $new_width = 0;
    switch ($size_to_serve) {
        case 'thumb':
            $new_width = 150;
            break;

        case 'small':
            $new_width = 300;
            break;

        case 'medium':
            $new_width = 662;
            break;

        case 'large':
            $new_width = 1024;
            break;

        case 'big':
            $new_width = 1686;
            break;

        case 'wide':
            $new_width = 2348;
            break;

        default:
            $new_width = $width;
            break;
    }

    //Calcula nova altura, a partir da nova largura
    $new_height = intdiv(($new_width * $height), $width);

    $img_new_size = array(
        'width' => $new_width,
        'height' => $new_height
    );

    return $img_new_size;
}


