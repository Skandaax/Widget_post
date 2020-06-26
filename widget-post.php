<?php

/*
Plugin Name: Widget post !
Plugin URI: https://www.inforaz.com/developpement-web-web-mobile/
Description: Widget permettant l'affichage d'une liste d'articles.
Author: Couillin Yannick
Author URI: http:/www.inforaz.com/
Version 1.0
Licence: GPLv2

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright {2020} {Yannick_Couillin} {email : {ameb@inforaz.com}}
*/

/*********************************************************
***La classe Widget facilite le développement de Widget***
***et elle autorise a classe étendue**********************/
class Ma_class extends WP_Widget {

    /***Méthode de construction du même nom que la classe**
    ****qui sert à configurer le widget********************/
    function Ma_class() {
    //Configuration du Widget
    }

    /***La méthode Widget(), qui sert à afficher le Widget**
    *****côté internaute.***********************************/
    function Widget($args, $instance) {
    //Affichage du Widget
        //récuperer  la valeur du titre
        extract($args);
        global $post;

        echo $before_widget;
            if($instance['title'] !='') {
                echo $before_title.$instance['title'].$after_title;
            }
        echo $after_widget;

        //Récupérer la valeur de la catégorie
            if($instance['category'] !="") {
                $args = array('category' => $instance['category']);
            }else{
                $args="";
            }
        
            $myposts = get_post($args);

            echo '<ul>';
            foreach($myposts as $post) {
                setup_postdata($post);

                echo'<li>';
                echo'<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
                echo'</li>';
            }
            echo '</ul>';
            wp_reset_postdata();

            echo $after_widget;
        
        
    }

    /***La méthode Update(), qui ert àmettre à jour********* 
    ****les options du Widget*******************************/
    function Update($new_instance, $bold_instance) {
    //Mise à jour des options
    }

    /***La méthode Form(), qui sert à afficher les formulaires
    ****de configuration du Widget dans l'administration.****/
    function Form($instance) { 
    }
}

/***Class étendue au fichier widget-post.php*****************/
class Widget_post extends WP_Widget {
    function Widget_Post() {

        //$slug accepte le nom clé du Widget
        //$name accepte le nom du Widget
        //$widget_ops accepte un tableau avec un nom de classe HTML et une description
        //WP_Widget($slug, $name, $widget_ops, $control_ops);

        $widget_ops = array( 'classname' => 'widget-post',
        'description' => 'widget permettant l\'affichage d\'une
        liste d\'articles selon la catégorie'
        );

        $control_ops = array('width' => 300,
        'height' => 350,
        'id_base' => 'widget-post'
    );

    $this->WP_Widget('widget-post', 'Widget post', $widget_ops, $control_ops);
    }

    function Widget($rgs, $instance) {
    }

    //Enregistrer et mettre à jour les option du widget
    function Update($new_instance, $bold_instance) {
        $instance = $old_instance;

        $instance ['title'] = strip_tags($new_instance['title']);
        $instance ['category'] = strip_tags($new_instance['category']);

        return $instance;
    }

    //Formulaire du widget
    function form($instance){
    $defaults = array('title' => 'Articles');
    $instance = wp_parse_args($instance, $defaults);
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
            Titre :
        </label>
        <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width: 100%;" />   
    </p>
        <label for="<?php echo $this->get_field_id('category'); ?>">
            Catégories : 
        </label>
        <select id="<?php echo $this->get_field_id('category'); ?>" name=""
        value="<?php echo $instance['category']; ?>" style="width: 100%;"> 
            <option>Toutes les catégories</option>
    <?php
        foreach((get_categories()) as $cat) {
           if($instance['category'] ==$cat->cat_id) {
               $selected='selected="selected"';
           }else {
               $selected='';
           }
            echo '<option '.$selected.' value="'.$cat->cat_id.'">'.$cat->cat_name.'</option>';
        }
    ?>
        </select>
    </p>
    <?php
    }
}

/***Enregistrement du Widget*************************/
function register_my_widget() {
    register_widget('Widget_Post');
}
add_action( 'widgets_init', 'register_my_widget' );
