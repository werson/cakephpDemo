<?php
class User extends AppModel
{
    var $name = 'User';
    public $validate = array(
        'username' => array(
            'rule' => 'notEmpty',
        ),
        'password' => array(
            'rule' => 'notEmpty'
        )
    );
}
?>