<?php
/*
Plugin Name: text_comment
Plugin URI: http://страница_с_описанием_плагина_и_его_обновлений
Description: Краткое описание плагина.
Version: Номер версии плагина, например: 1.0
Author: Имя автора плагина
Author URI: http://страница_автора_плагина
*/
add_action("widgets_init" , function() {
    register_widget("TextWidget");
});

class TextWidget extends WP_Widget {
    public function __construct() {
        parent::__construct('text-comment', 'Recent Full Comments',
            array('description' => 'Viewing recent full comments'));
    }

    public function form($instance) {
        $title = '';
        $text = '';
        if (!empty($instance)) {
            $title = $instance['title'];
            $text = $instance['text'];
        }

        $tableId = $this->get_field_id('title');
        $tableName = $this->get_field_name('title');
        echo '<label for="' . $tableId . '">Title</label><br>';
        echo '<input id="' . $tableId . '" type="text" name="' . $tableName . '" value="' . $title . '"><br>';

        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo '<label for="' . $textId . '">Text</label><br>';
        echo '<textarea id="' . $textId . '" name="' . $textName . '">' . $text . '</textarea>';
    }


    public function update($newInstance, $oldInstance) {
        $values = array();
        $values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        return $values;
    }

    public function widget($args, $instance) {
        $title = $instance["title"];
        $text = $instance["text"];
        echo "<aside id='vewing_comments' class='widget'>";
            echo "<h2>$title</h2>";
            echo "<p>$text</p>";
        echo "</aside>";
    }
};





