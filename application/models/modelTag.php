<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelTag extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id', 'ASC');
    return $this->db->get('tags')->result_array();
  }

  public function insert()
  {
    $data = [
      "name" => $this->input->post('name', true)
    ];

    $this->db->insert('tags', $data);
  }

  public function update()
  {
    $data = [
      "name" => $this->input->post('name', true)
    ];

    $this->db->where('id', $this->input->post('id', true));
    $this->db->update('tags', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('tags');
  }  

}