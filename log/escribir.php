<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$file = 'error.log';
$content = 'hola';
file_put_contents($file, $content);
echo phpinfo();