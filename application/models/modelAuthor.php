<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelAuthor extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id', 'ASC');
    return $this->db->get('authors')->result_array();
  }

  public function getAuthorById($id)
  {
      $this->db->where('id', $id);
      return $this->db->get('authors')->row_array();
  }

  public function insert()
  {
    $data = [
      "name" => $this->input->post('name', true),
      "email" => $this->input->post('email', true)
    ];

    $this->db->insert('authors', $data);
  }
  
  public function update()
  {
    $data = [
      "name" => $this->input->post('name', true),
      "email" => $this->input->post('email', true)
    ];

    $this->db->where('id', $this->input->post('id', true));
    $this->db->update('authors', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('authors');
  }

}