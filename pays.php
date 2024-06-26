<?php
/**
 * Package Pays
 * Version 1.0.0
 */
/*
Plugin name: Pays
Plugin uri: https://github.com/GabriellePelletier/ef-pays
Version: 1.0.0
Description: Permet d'afficher les pays des destinations
*/
echo header("Access-Control-Allow-Origin: http://localhost:80");
function eddym_enqueue()
{
// filemtime // retourne en milliseconde le temps de la dernière modification
// plugin_dir_path // retourne le chemin du répertoire du plugin
// __FILE__ // le fichier en train de s'exécuter
// wp_enqueue_style() // Intègre le link:css dans la page
// wp_enqueue_script() // intègre le script dans la page
// wp_enqueue_scripts // le hook

$version_css = filemtime(plugin_dir_path( __FILE__ ) . "style.css");
$version_js = filemtime(plugin_dir_path(__FILE__) . "js/pays.js");
wp_enqueue_style(   'em_plugin_pays_css',
                     plugin_dir_url(__FILE__) . "style.css",
                     array(),
                     $version_css);

wp_enqueue_script(  'em_plugin_pays_js',
                    plugin_dir_url(__FILE__) ."js/pays.js",
                    array(),
                    $version_js,
                    true);
}
add_action('wp_enqueue_scripts', 'eddym_enqueue');

function creer_bouton(){
    $excluded_categories = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17); // IDs of categories to exclude
    $categories = get_categories(array('exclude' => $excluded_categories));
    $contenu = "";
    foreach($categories as $elm_categorie){
        $nom = $elm_categorie->name;
        $id = $elm_categorie->term_id;
        $contenu .= "<button id='cat_".$id."' class='lien__categorie'>".$nom."</button>";
    }
    return $contenu;
}

/* Création de la liste des destinations en HTML */
function creation_pays(){
    $contenu = '<div class="contenu__restapi">'. creer_bouton() .'</div>';
    return $contenu;
}

add_shortcode('em_pays', 'creation_pays');