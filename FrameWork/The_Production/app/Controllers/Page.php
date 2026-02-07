<?php

namespace App\Controllers;

use App\Models\PageModel;

/**
 * Class Page
 * 
 * The Book Of Your Destiny - Page Controller
 * Handles Page operations
 */
class Page extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PageModel();
    }

    public function list()
    {
        $this->data['pages'] = $this->model->findAll();
        return view('page/list', $this->data);
    }

    public function view($id)
    {
        $this->data['page'] = $this->model->find($id);
        if (!$this->data['page']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }
        return view('page/view', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            if ($this->model->save($data)) {
                return redirect()->to('/page/list')->with('success', 'Page created successfully');
            }
        }
        return view('page/create', $this->data);
    }

    public function edit($id)
    {
        $this->data['page'] = $this->model->find($id);
        if (!$this->data['page']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $data['id'] = $id;
            if ($this->model->save($data)) {
                return redirect()->to('/page/list')->with('success', 'Page updated successfully');
            }
        }
        return view('page/edit', $this->data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/page/list')->with('success', 'Page deleted successfully');
    }
}
