<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }
	
	public function index()
	{
		$data['title'] = "Dashboard";
		$data['authors'] = $this->modelAuthor->getAll();
		$data['categories'] = $this->modelCategory->getAll();
		$data['tags'] = $this->modelTag->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}
	
	public function v_article()
	{
		$data['title'] = "Articles";
		$data['articles'] = $this->modelArticle->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('article/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

    public function addArticle() 
	{
		$data['title'] = "Add Articles";
        $data['authors'] = $this->modelAuthor->getAll();
        $data['categories'] = $this->modelCategory->getAll();
        $data['tags'] = $this->modelTag->getAll();

        $this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('article/add', $data);
		$this->load->view('layoutDashboard/footer', $data);
    }

    public function save() 
	{
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('content', 'Content', 'required|min_length[10]');
        $this->form_validation->set_rules('author_id', 'Author', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('tags[]', 'Tags', 'required', array(
			'required' => 'You must select at least one tag.'
		));

		
        if ($this->form_validation->run() == FALSE) {			
            $this->addArticle();
        } else {
            $title = $this->input->post('title', TRUE);
            $content = $this->input->post('content', TRUE);
            $author_id = $this->input->post('author_id', TRUE);
            $category_id = $this->input->post('category', TRUE);
            $tags = $this->input->post('tags', TRUE);

            $data = [
                'title' => $title,
                'content' => $content,
                'author_id' => $author_id
            ];
            $this->modelArticle->insert_article($data);

            $article_id = $this->db->insert_id();

            $this->modelArticle->insert_article_category($article_id, $category_id);

            if (!empty($tags)) {
                foreach ($tags as $tag_id) {
                    $this->modelArticle->insert_article_tag($article_id, $tag_id);
                }
            }

			$this->session->set_flashdata('success', 'Article added successfully!');
            redirect('admin/v_article');
        }
    }

	public function editArticle($id)
	{
		$data['title'] = "Edit Articles";
		$data['article'] = $this->modelArticle->getArticleId($id);
		$data['authors'] = $this->modelAuthor->getAll();
		$data['categories'] = $this->modelCategory->getAll();
		$data['tags'] = $this->modelTag->getAll();
		$data['selected_categories'] = $this->modelArticle->get_selected_categories($id);
		$data['selected_tags'] = $this->modelArticle->get_selected_tags($id);

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('article/edit', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

	public function updateArticle($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('content', 'Content', 'required|min_length[10]');
		$this->form_validation->set_rules('author_id', 'Author', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('tags[]', 'Tags', 'required', [
			'required' => 'You must select at least one tag.'
		]);

		if ($this->form_validation->run() === FALSE) {
			$this->editArticle($id);
		} else {
			$title = $this->input->post('title', TRUE);
			$content = $this->input->post('content', TRUE);
			$author_id = $this->input->post('author_id', TRUE);
			$category_id = $this->input->post('category_id', TRUE);
			$tags = $this->input->post('tags', TRUE);

			$article_data = [
				'title' => $title,
				'content' => $content,
				'author_id' => $author_id
			];

			$this->modelArticle->update_article($id, $article_data);

			$this->modelArticle->update_article_category($id, $article_id, $category_id);

			$this->modelArticle->update_article_tag($id, $tags);

			$this->session->set_flashdata('success', 'Article updated successfully!');
			redirect('admin/v_article');
		}
	}
	
	public function deleteArticle($id) 
	{
		$is_deleted = $this->modelArticle->delete_article($id);

		if ($is_deleted) {
			$this->session->set_flashdata('success', 'Article deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete article. Please try again.');
		}

		redirect('admin/v_article');
	}

	public function detailArticle($id) 
	{
		$data['title'] = "Detail Articles";
		$data['article'] = $this->modelArticle->getArticleById($id);
		$data['categories'] = $this->modelCategory->getAll();
		
		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('article/detail', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

	public function addAuthor()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', 'Author added failed!');
			$this->index();
		} else {
			$this->modelAuthor->insert();
			$this->session->set_flashdata('success', 'Author added successfully!');
			redirect ('admin/index');
		}		
	}
	
	public function updateAuthor()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', 'Author update failed!');
			$this->index();
		} else {
			$this->modelAuthor->update();
			$this->session->set_flashdata('success', 'Author update successfully!');
			redirect ('admin/index');
		}		
	}
	
	public function deleteAuthor($id)
	{
		$delete = $this->modelAuthor->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', 'Author deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete author!');
		}

		redirect('admin/index');		
	}
	
	public function addCategory()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', 'Category added failed!');
			$this->index();
		} else {
			$this->modelCategory->insert();
			$this->session->set_flashdata('success', 'Category added successfully!');
			redirect ('admin/index');
		}		
	}

	public function updateCategory()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', 'Category update failed!');
			$this->index();
		} else {
			$this->modelCategory->update();
			$this->session->set_flashdata('success', 'Category update successfully!');
			redirect ('admin/index');
		}		
	}
	
	public function deleteCategory($id)
	{
		$delete = $this->modelCategory->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', 'Category deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete Category!');
		}

		redirect('admin/index');		
	}
	
	public function addTag()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', 'Tag added failed!');
			$this->index();
		} else {
			$this->modelTag->insert();
			$this->session->set_flashdata('success', 'Tag added successfully!');
			redirect ('admin/index');
		}		
	}

	public function updateTag()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', 'Tag update failed!');
			$this->index();
		} else {
			$this->modelTag->update();
			$this->session->set_flashdata('success', 'Tag update successfully!');
			redirect ('admin/index');
		}		
	}
	
	public function deleteTag($id)
	{
		$delete = $this->modelTag->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', 'Tag deleted successfully!');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete Tag!');
		}

		redirect('admin/index');		
	}
	
}