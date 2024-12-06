<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelCategory extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id', 'ASC');
    return $this->db->get('categories')->result_array();
  }
  
  
}