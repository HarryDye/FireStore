<?php

require_once 'FireStore.php';

$FS_instance = new FireStore('test');

$FS_instance2 = new FireStore('food');


// print_r($FS_instance->getDocument('IpYWdWOYaJ5G57KYEcMK'));
//
// print_r($FS_instance->getWhere('Not words', '=', 'true'));
//
// print_r($FS_instance->newDocument('Doc1000', ['test' => 123, 'test2' => 321]));
//
// print_r($FS_instance->newCollection('food', 'meet'));

// print_r($FS_instance2->dropDocument('meet'));

print_r($FS_instance2->dropCollection('food'));
