<?php

/*******************************************/
/** get field by page slug */
/***************************************** */

function get_afc_by_page_slug($field_name, $post_type, $post_slug)
{
    $id = get_post_id_by_slug($post_slug, $post_type);
    
    if (get_field($field_name, $id)) :
        return get_field($field_name, $id);
    else :
        return '';
    endif;
}

/*******************************************************/
/********************* ACF FIELDS **********************/
/*******************************************************/
function pipe_custom_field($field)
{

    if (get_field($field)) :
        return get_field($field);
    else :
        return '';
    endif;
}
