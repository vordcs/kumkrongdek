<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_activitys extends CI_Model {
    
    public function set_form_add() {
        
        
         $f_highlight = array(
            '0' => 'ทั่วไป',
            '1' => 'เด่น',
        );

        $f_status = array(
            '2' => 'ใช้งาน',
            '1' => 'ไม่ใช้งาน',
        );
        
        $form_add = array(
            'form' => form_open_multipart('Activitys/add', array('class' => 'form-horizontal', 'id' => 'form_slide')),
            'actity_status' => form_dropdown('actity_status', $f_status, set_value('actity_status'), 'class="form-control"'),
            'actity_highlight' => form_dropdown('actity_highlight', $f_highlight, set_value('actity_highlight'), 'class="form-control"'),
            '' => form_input($f_),       
        );
        return $form_add;
    }

}

