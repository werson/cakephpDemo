<?php
class EmailConfig {
    public $gmail = array(
       // 'host' => 'ssl://smtp.163.com',
        'host' => 'smtp.126.com',
        'port' => 25,
        'timeout' => 30,
        'username' => 'mytime_cake@126.com',
        'password' => 'gj931120',
        'sendAs' => 'html',
        'transport' => 'Smtp' );
}