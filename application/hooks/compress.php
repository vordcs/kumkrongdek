<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$CI =& get_instance();
 $buffer = $CI->output->get_output();
 
 $search = array(
    '/\>[^\S ]+/s', 
    '/[^\S ]+\</s', 
     '/(\s)+/s', // shorten multiple whitespace sequences
  '#(?://)?<!\[CDATA\[(.*?)(?://)?\]\]>#s' //leave CDATA alone
  );
 $replace = array(
     '>',
     '<',
     '\\1',
  "//&lt;![CDATA[\n".'\1'."\n//]]>"
  );

 $buffer = preg_replace($search, $replace, $buffer);

 $CI->output->set_output($buffer);
 $CI->output->_display();