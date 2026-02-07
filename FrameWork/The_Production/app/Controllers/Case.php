<?php

namespace App\Controllers;

use App\Models\CaseModel;

/**
 * Class Case
 * 
 * The Book Of Your Destiny - Case/Container Controller
 * Handles Book Case (Container) operations
 */
class Case extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new CaseModel();
    }

    public function list()
    {
        $this->data['cases'] = $this->model->findAll();
        return view('case/list', $this->data);
    }

    public function view($id)
    {
        $this->data['case'] = $this->model->find($id);
        if (!$this->data['case']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Case not found');
        }
        return view('case/view', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            if ($this->model->save($data)) {
                return redirect()->to('/case/list')->with('success', 'Case created successfully');
            }
        }
        return view('case/create', $this->data);
    }

    public function edit($id)
    {
        $this->data['case'] = $this->model->find($id);
        if (!$this->data['case']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Case not found');
        }

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $data['id'] = $id;
            if ($this->model->save($data)) {
                return redirect()->to('/case/list')->with('success', 'Case updated successfully');
            }
        }
        return view('case/edit', $this->data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/case/list')->with('success', 'Case deleted successfully');
    }
}
