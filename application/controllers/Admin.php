<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	
	public function v_author()
	{
		$data['title'] = "Authors";
		$data['author'] = $this->modelAuthor->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('author/index', $data);
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

	// Menyimpan artikel baru
    public function save() 
	{
        // Validasi input
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
            // Ambil data dari form
            $title = $this->input->post('title', TRUE);
            $content = $this->input->post('content', TRUE);
            $author_id = $this->input->post('author_id', TRUE);
            $category_id = $this->input->post('category', TRUE);
            $tags = $this->input->post('tags', TRUE); // Array tags yang dipilih

            // Menyimpan artikel baru ke database
            $data = [
                'title' => $title,
                'content' => $content,
                'author_id' => $author_id // Misalnya ID penulis di-set manual, bisa disesuaikan
            ];
            $this->modelArticle->insert_article($data);

            // Ambil ID artikel yang baru disimpan
            $article_id = $this->db->insert_id();

            // Menyimpan relasi antara artikel dan kategori
            $this->modelArticle->insert_article_category($article_id, $category_id);

            // Menyimpan relasi antara artikel dan tag
            if (!empty($tags)) {
                foreach ($tags as $tag_id) {
                    $this->modelArticle->insert_article_tag($article_id, $tag_id);
                }
            }

            // Redirect ke halaman daftar artikel setelah berhasil
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
		// Validasi input form
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[255]');
		$this->form_validation->set_rules('content', 'Content', 'required|min_length[10]');
		$this->form_validation->set_rules('author_id', 'Author', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('tags[]', 'Tags', 'required', [
			'required' => 'You must select at least one tag.'
		]);

		// Cek validasi
		if ($this->form_validation->run() === FALSE) {
			$this->editArticle($id);
		} else {
			// Ambil data dari form
			$title = $this->input->post('title', TRUE);
			$content = $this->input->post('content', TRUE);
			$author_id = $this->input->post('author_id', TRUE);
			$category_id = $this->input->post('category_id', TRUE);
			$tags = $this->input->post('tags', TRUE); // Array tag yang dipilih

			// Data untuk update artikel
			$article_data = [
				'title' => $title,
				'content' => $content,
				'author_id' => $author_id
			];

			// Update tabel articles
			$this->modelArticle->update_article($id, $article_data);

			// Update kategori artikel (hapus lama, simpan yang baru)
			$this->modelArticle->update_article_category($id, $article_id, $category_id);

			// Update tag artikel (hapus lama, simpan yang baru)
			$this->modelArticle->update_article_tag($id, $tags);

			// Redirect dengan pesan sukses
			$this->session->set_flashdata('success', 'Article updated successfully!');
			redirect('admin/v_article');
		}
	}
	
	public function deleteArticle($id) {
    // Panggil fungsi model untuk menghapus artikel
    $is_deleted = $this->modelArticle->delete_article($id);

    if ($is_deleted) {
        $this->session->set_flashdata('success', 'Article deleted successfully!');
    } else {
        $this->session->set_flashdata('error', 'Failed to delete article. Please try again.');
    }

    redirect('admin/v_article');
}

	




















	public function v_tag()
	{
		$data['title'] = "Tags";
		$data['tag'] = $this->modelTag->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('tag/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}
	
	public function v_category()
	{
		$data['title'] = "Category";
		$data['category'] = $this->modelCategory->getAll();

		$this->load->view('layoutDashboard/header', $data);
		$this->load->view('layoutDashboard/navbar', $data);
		$this->load->view('layoutDashboard/sidebar', $data);
		$this->load->view('category/index', $data);
		$this->load->view('layoutDashboard/footer', $data);
	}

	
	
}