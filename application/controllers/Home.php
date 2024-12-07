<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
		
	public function index()
	{
		$data['articles'] = $this->modelArticle->getAll();
		$data['categories'] = $this->modelCategory->getAll();
		$data['random1'] = $this->modelArticle->getRandom(1);
		$data['random2'] = $this->modelArticle->getRandom(1);
		$data['random3'] = $this->modelArticle->getRandom(2);

		$this->load->view('home/index', $data);
	}
	
	public function category($category_id) {
		$data['articles'] = $this->modelArticle->getArticlesByCategory($category_id);
        $data['categoryId'] = $this->modelCategory->getCategoryById($category_id);
		$data['categories'] = $this->modelCategory->getAll();

        $this->load->view('home/category', $data);
    }

	public function article($id) {
		$data['article'] = $this->modelArticle->getArticleById($id);
		$data['categories'] = $this->modelCategory->getAll();
		
		$this->load->view('home/article', $data);
	}

	
	
}