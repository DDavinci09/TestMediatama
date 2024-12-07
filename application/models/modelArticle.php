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
        $this->db->order_by('article_id', 'DESC');
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
        $this->db->limit($limit);
        $this->db->group_by('articles.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getArticleId($id)
    {
        $query = $this->db->get_where('articles', ['id' => $id]);
        return $query->row_array();
    }

    public function insert_article($data) 
    {
        $this->db->insert('articles', $data);
        return $this->db->insert_id();
    }

    public function insert_article_category($article_id, $category_id) 
    {
        $data = [
            'article_id' => $article_id,
            'category_id' => $category_id
        ];
        $this->db->insert('article_category', $data);
    }

    public function insert_article_tag($article_id, $tag_id) 
    {
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

    public function update_article($id, $article_data) 
    {
        $this->db->where('id', $id);
        $this->db->update('articles', $article_data);
    }

    public function update_article_category($id, $article_id, $category_id) 
    {
        $this->db->where('article_id', $id);
        $this->db->delete('article_category');
        $this->db->insert('article_category', ['article_id' => $id, 'category_id' => $category_id]);
    }

    public function update_article_tag($id, $tags) 
    {
        $this->db->where('article_id', $id);
        $this->db->delete('article_tag');
        
        if (!empty($tags)) {
            foreach ($tags as $tag_id) {
                $this->db->insert('article_tag', ['article_id' => $id, 'tag_id' => $tag_id]);
            }
        }
    }

    public function delete_article($id) 
    {
        $this->db->trans_start();

        $this->db->where('article_id', $id);
        $this->db->delete('article_tag');

        $this->db->where('article_id', $id);
        $this->db->delete('article_category');

        $this->db->where('id', $id);
        $this->db->delete('articles');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function getArticlesByCategory($category_id) 
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
        
        $this->db->where('article_category.category_id', $category_id);
        
        $this->db->group_by('articles.id');
        
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getArticleById($id) 
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
        $this->db->where('articles.id', $id);
        $this->db->group_by('articles.id');
        
        $query = $this->db->get();
        return $query->row_array();
    }

}