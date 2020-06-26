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
    }

    /***La méthode Update(), qui ert àmettre à jour********* 
    ****les options du Widget*******************************/
    function Update($new_instance, $bold_instance) {
    //Mise à jour des options
    }

    /***La méthode Form(), qui sert à afficher les formulaire
    ****de configuration du Widget dans l'administration.****/
    function Form($instance) {
    //Formulaire des réglages
    }
}

/***Class étendue au fichier widget-post.php*****************/
class Widget_post extends WP_Widget {
    function Widget_Post() {

        //$slug accepte le nom clé du Widget
        //$name accepte le nom du Widget
        //$widget_ops accepte un tableau avec un nom de classe HTML et une description
        WP_Widget($slug, $name, $widget_ops, $control_ops);

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

    function Update($new_instance, $bold_instance) {
    }

    function form($instance){
    }
}