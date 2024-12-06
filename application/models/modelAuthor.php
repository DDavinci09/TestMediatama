<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelAuthor extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id', 'ASC');
    return $this->db->get('authors')->result_array();
  }

  public function insert()
  {
    $data = [
      "name" => $this->input->post('author', true),
      "email" => $this->input->post('email', true)
    ];

    $this->db->insert('authors', $data);
  }
}