<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modelArticle extends CI_Model
{
  public function getAll() 
  {
    $this->db->select('
        articles.id AS article_id,
        articles.title,
        articles.content,
        authors.name AS author_name,
        GROUP_CONCAT(DISTINCT categories.name) AS categories,
        GROUP_CONCAT(DISTINCT tags.name) AS tags
    ');
    
    $this->db->from('articles');
    $this->db->join('authors', 'articles.author_id = authors.id');
    $this->db->join('article_category', 'articles.id = article_category.article_id', 'left');
    $this->db->join('categories', 'article_category.category_id = categories.id', 'left');
    $this->db->join('article_tag', 'articles.id = article_tag.article_id', 'left');
    $this->db->join('tags', 'article_tag.tag_id = tags.id', 'left');
    
    $this->db->group_by('articles.id');
    $query = $this->db->get();

    return $query->result_array();
  }
  
  public function getRandom($limit) 
  {
    $this->db->select('
        articles.id AS article_id,
        articles.title,
        articles.content,
        authors.name AS author_name,
        GROUP_CONCAT(DISTINCT categories.name) AS categories,
        GROUP_CONCAT(DISTINCT tags.name) AS tags
    ');
    
    $this->db->from('articles');
    $this->db->join('authors', 'articles.author_id = authors.id');
    $this->db->join('article_category', 'articles.id = article_category.article_id', 'left');
    $this->db->join('categories', 'article_category.category_id = categories.id', 'left');
    $this->db->join('article_tag', 'articles.id = article_tag.article_id', 'left');
    $this->db->join('tags', 'article_tag.tag_id = tags.id', 'left');
    $this->db->order_by('RAND()'); 
    $this->db->limit($limit); ;
    $this->db->group_by('articles.id');
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getArticleId($id)
  {
    $query = $this->db->get_where('articles', ['id' => $id]);
    return $query->row_array();
  }

  public function insert_article($data) {
      $this->db->insert('articles', $data);
      return $this->db->insert_id();
  }

  public function insert_article_category($article_id, $category_id) {
      $data = [
          'article_id' => $article_id,
          'category_id' => $category_id
      ];
      $this->db->insert('article_category', $data);
  }

  public function insert_article_tag($article_id, $tag_id) {
      $data = [
          'article_id' => $article_id,
          'tag_id' => $tag_id
      ];
      $this->db->insert('article_tag', $data);
  }

  public function get_selected_categories($id)
  {
      $this->db->select('category_id');
      $this->db->from('article_category');
      $this->db->where('article_id', $id);
      $query = $this->db->get();
      return array_column($query->result_array(), 'category_id');
  }
  
  public function get_selected_tags($id)
  {
      $this->db->select('tag_id');
      $this->db->from('article_tag');
      $this->db->where('article_id', $id);
      $query = $this->db->get();
      return array_column($query->result_array(), 'tag_id');
  }

  public function update_article($id, $article_data) {
      $this->db->where('id', $id);
			$this->db->update('articles', $article_data);
  }

  public function update_article_category($id, $article_id, $category_id) {
      $this->db->where('article_id', $id);
			$this->db->delete('article_category');
			$this->db->insert('article_category', ['article_id' => $id, 'category_id' => $category_id]);
  }

  public function update_article_tag($id, $tags) {
      $this->db->where('article_id', $id);
			$this->db->delete('article_tag');
			if (!empty($tags)) {
				foreach ($tags as $tag_id) {
					$this->db->insert('article_tag', ['article_id' => $id, 'tag_id' => $tag_id]);
				}
			}
  }

  public function delete_article($id) {
    $this->db->trans_start(); // Memulai transaksi

    // Hapus data dari tabel `article_tag` (jika ada tag terkait)
    $this->db->where('article_id', $id);
    $this->db->delete('article_tag');

    // Hapus data dari tabel `article_category` (jika ada kategori terkait)
    $this->db->where('article_id', $id);
    $this->db->delete('article_category');

    // Hapus artikel dari tabel `articles`
    $this->db->where('id', $id);
    $this->db->delete('articles');

    $this->db->trans_complete(); // Menyelesaikan transaksi

    // Cek apakah transaksi berhasil
    return $this->db->trans_status();
}

public function get_articles_with_details() {
        $this->db->select('
            articles.id as article_id, 
            articles.title, 
            articles.content, 
            authors.name as author_name, 
            authors.email as author_email
        ');
        $this->db->from('articles');
        $this->db->join('authors', 'articles.author_id = authors.id', 'left');
        $query = $this->db->get();

        $articles = $query->result_array();

        // Menambahkan kategori dan tag untuk setiap artikel
        foreach ($articles as &$article) {
            $article['categories'] = $this->get_categories_by_article($article['article_id']);
            $article['tags'] = $this->get_tags_by_article($article['article_id']);
        }

        return $articles;
    }

    private function get_categories_by_article($article_id) {
        $this->db->select('categories.name');
        $this->db->from('article_category');
        $this->db->join('categories', 'article_category.category_id = categories.id', 'left');
        $this->db->where('article_category.article_id', $article_id);
        $query = $this->db->get();

        return array_column($query->result_array(), 'name'); // Mengambil array nama kategori
    }

    private function get_tags_by_article($article_id) {
        $this->db->select('tags.name');
        $this->db->from('article_tag');
        $this->db->join('tags', 'article_tag.tag_id = tags.id', 'left');
        $this->db->where('article_tag.article_id', $article_id);
        $query = $this->db->get();

        return array_column($query->result_array(), 'name'); // Mengambil array nama tag
    }

public function getArticlesByCategory($category_id) {
    // Menyusun query untuk mengambil artikel yang terkait dengan kategori
    $this->db->select('
        articles.id AS article_id,
        articles.title,
        articles.content,
        authors.name AS author_name,
        GROUP_CONCAT(DISTINCT categories.name) AS categories,
        GROUP_CONCAT(DISTINCT tags.name) AS tags
    ');
    
    $this->db->from('articles');
    $this->db->join('authors', 'articles.author_id = authors.id');
    $this->db->join('article_category', 'articles.id = article_category.article_id', 'left');
    $this->db->join('categories', 'article_category.category_id = categories.id', 'left');
    $this->db->join('article_tag', 'articles.id = article_tag.article_id', 'left');
    $this->db->join('tags', 'article_tag.tag_id = tags.id', 'left');
    
    // Filter berdasarkan ID kategori
    $this->db->where('article_category.category_id', $category_id);
    
    // Mengelompokkan berdasarkan artikel untuk memastikan data unik
    $this->db->group_by('articles.id');
    
    // Menjalankan query
    $query = $this->db->get();

    // Mengembalikan hasil query sebagai array
    return $query->result_array();
}

public function getArticleById($id) {
    $this->db->select('
        articles.id AS article_id,
        articles.title,
        articles.content,
        authors.name AS author_name,
        GROUP_CONCAT(DISTINCT categories.name) AS categories,
        GROUP_CONCAT(DISTINCT tags.name) AS tags
    ');
    $this->db->from('articles');
    $this->db->join('authors', 'articles.author_id = authors.id');
    $this->db->join('article_category', 'articles.id = article_category.article_id', 'left');
    $this->db->join('categories', 'article_category.category_id = categories.id', 'left');
    $this->db->join('article_tag', 'articles.id = article_tag.article_id', 'left');
    $this->db->join('tags', 'article_tag.tag_id = tags.id', 'left');
    $this->db->where('articles.id', $id);
    $this->db->group_by('articles.id');
    
    $query = $this->db->get();
    return $query->row_array(); // Mengembalikan data satu baris
}


































  // Mengambil semua artikel dengan kategori dan tag terkait
  public function get_articles_with_categories_and_tags() {
      $this->db->select('a.id as article_id, a.title, a.content, c.name as category_name, GROUP_CONCAT(t.name) as tag_names');
      $this->db->from('articles a');
      $this->db->join('article_category ac', 'ac.article_id = a.id');
      $this->db->join('categories c', 'ac.category_id = c.id');
      $this->db->join('article_tag at', 'at.article_id = a.id');
      $this->db->join('tags t', 'at.tag_id = t.id');
      $this->db->group_by('a.id');
      $query = $this->db->get();
      return $query->result();
  }

  // Mengambil artikel berdasarkan ID
  public function get_article_by_id($article_id) {
      $this->db->select('a.id, a.title, a.content, a.author_id, c.name as category_name, GROUP_CONCAT(t.name) as tag_names');
      $this->db->from('articles a');
      $this->db->join('article_category ac', 'ac.article_id = a.id');
      $this->db->join('categories c', 'ac.category_id = c.id');
      $this->db->join('article_tag at', 'at.article_id = a.id');
      $this->db->join('tags t', 'at.tag_id = t.id');
      $this->db->where('a.id', $article_id);
      $this->db->group_by('a.id');
      $query = $this->db->get();
      return $query->row();
  }

  // Mengambil semua artikel tanpa kategori dan tag
  public function get_all_articles() {
      $query = $this->db->get('articles');
      return $query->result();
  }

  // Mengambil artikel berdasarkan ID penulis (author_id)
  public function get_articles_by_author($author_id) {
      $this->db->select('a.id, a.title, a.content, c.name as category_name, GROUP_CONCAT(t.name) as tag_names');
      $this->db->from('articles a');
      $this->db->join('article_category ac', 'ac.article_id = a.id');
      $this->db->join('categories c', 'ac.category_id = c.id');
      $this->db->join('article_tag at', 'at.article_id = a.id');
      $this->db->join('tags t', 'at.tag_id = t.id');
      $this->db->where('a.author_id', $author_id);
      $this->db->group_by('a.id');
      $query = $this->db->get();
      return $query->result();
  }
}