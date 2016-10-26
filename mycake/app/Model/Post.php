<?php
class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'not empty!'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}
?>