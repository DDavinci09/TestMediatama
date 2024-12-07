<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelCategory extends CI_Model
{
  public function getAll()
  {
    $this->db->order_by('id', 'ASC');
    return $this->db->get('categories')->result_array();
  }
  
  public function getCategoryById($category_id) 
  {
      $this->db->where('id', $category_id);
      $query = $this->db->get('categories');
      return $query->row_array();
  }

  public function insert()
  {
    $data = [
      "name" => $this->input->post('name', true)
    ];

    $this->db->insert('categories', $data);
  }

  public function update()
  {
    $data = [
      "name" => $this->input->post('name', true)
    ];

    $this->db->where('id', $this->input->post('id', true));
    $this->db->update('categories', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('categories');
  }

}