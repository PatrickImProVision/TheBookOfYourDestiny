<?php

namespace App\Controllers;

use App\Models\BookModel;

/**
 * Class Book
 * 
 * The Book Of Your Destiny - Book Controller
 * Handles Book operations
 */
class Book extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new BookModel();
    }

    public function list()
    {
        $this->data['books'] = $this->model->findAll();
        return view('book/list', $this->data);
    }

    public function view($id)
    {
        $this->data['book'] = $this->model->find($id);
        if (!$this->data['book']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Book not found');
        }
        return view('book/view', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            if ($this->model->save($data)) {
                return redirect()->to('/book/list')->with('success', 'Book created successfully');
            }
        }
        return view('book/create', $this->data);
    }

    public function edit($id)
    {
        $this->data['book'] = $this->model->find($id);
        if (!$this->data['book']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Book not found');
        }

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $data['id'] = $id;
            if ($this->model->save($data)) {
                return redirect()->to('/book/list')->with('success', 'Book updated successfully');
            }
        }
        return view('book/edit', $this->data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/book/list')->with('success', 'Book deleted successfully');
    }
}
