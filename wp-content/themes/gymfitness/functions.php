<?php

// Consultas
require get_template_directory() . '/inc/queries.php';
require get_template_directory() . '/inc/shortcodes.php';

function gymfitness_setup() {

    //Imagenes destacadas
    add_theme_support('post-thumbnails');

    //Titulos SEO
    add_theme_support('title-tag');

    //Imagenes de tamaño personalizado
    add_image_size('square', 350, 350, true);
    add_image_size('portrait', 350, 724, true);
    add_image_size('cajas', 400, 375, true);
    add_image_size('mediano', 700, 400, true);
    add_image_size('blog', 966, 644, true);
}
add_action('after_setup_theme', 'gymfitness_setup');


//Menus de navegacion
function gymfitness_menus() {
    //Registro menu
    register_nav_menus(array(
        'menu-principal' => __('Menú Principal', 'gymfitness')
    ));
}

// Hook
add_action('init', 'gymfitness_menus');

//Scripts y Styles
function gymfitness_scripts_styles() {

    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', [], '8.0.1');

    wp_enqueue_style('slicknavCSS', get_template_directory_uri() . '/css/slicknav.min.css', [], '1.0.0');

    wp_enqueue_style('googleFont', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&family=Raleway:wght@400;700;900&family=Staatliches&display=swap', [], '1.0.0');

    if (is_page('galeria')) :
        wp_enqueue_style('lightboxCSS', get_template_directory_uri() . '/css/lightbox.min.css', [], '2.11.2');
    endif;

    if (is_page('contacto')) :
        wp_enqueue_style('leafletCSS', 'https://unpkg.com/leaflet@1.6.0/dist/leaflet.css', [], '1.6.0');
    endif;

    if (is_page('inicio')) :
        wp_enqueue_style('bxSliderCSS', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css', [], '4.2.12');
    endif;

    //Hoja de estilos principal
    wp_enqueue_style('style', get_stylesheet_uri(), array('normalize', 'googleFont'), '1.0.0');

    wp_enqueue_script('slicknavJS', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '1.0.0', true);

    if (is_page('galeria')) :
        wp_enqueue_script('lightboxJS', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), '2.11.2', true);
    endif;

    if (is_page('contacto')) :
        wp_enqueue_script('leafletJS', 'https://unpkg.com/leaflet@1.6.0/dist/leaflet.js', array('jquery'), '1.6.0', true);
    endif;

    if (is_page('inicio')) :
        wp_enqueue_script('bxSliderJS', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '1.6.0', true);
    endif;

    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'slicknavJS'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'gymfitness_scripts_styles');

//Zona de widgets
function gymfitness_widgets() {
    register_sidebar(array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar_1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar_2',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-center texto-primario">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'gymfitness_widgets');

// Imagen Hero
function gymfitness_hero_image() {
    //Obtener ID pagina principal
    $front_page_id = get_option('page_on_front');

    //Obtener ID imagen
    $id_imagen = get_field('imagen_hero', $front_page_id);

    //Obtener la imagen
    $imagen = wp_get_attachment_image_src($id_imagen, 'full')[0];

    //Style CSS
    wp_register_style('custom', false);
    wp_enqueue_style('custom');

    //CSS
    $imagen_destacada_css = "
    
        body.home .site-header {
            background-image: linear-gradient( rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url($imagen);
        }
    
    ";
    wp_add_inline_style('custom', $imagen_destacada_css);
}
add_action('init', 'gymfitness_hero_image');
