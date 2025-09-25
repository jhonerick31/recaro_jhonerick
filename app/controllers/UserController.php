<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session'); 
        $this->call->model('UserModel');
    }

    public function index()
    {
        // Current page
        $page = $this->io->get('page') ? (int)$this->io->get('page') : 1;

        // Search keyword
        $q = $this->io->get('q') ? trim($this->io->get('q')) : '';

        // Records per page
        $records_per_page = 5;

        // Get paginated data
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Pagination config
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');

        // Initialize pagination
        $this->pagination->initialize(
            $total_rows, 
            $records_per_page, 
            $page, 
            site_url('/') . '?q=' . $q
        );

        $data['page']   = $this->pagination->paginate();
        $data['search'] = $q;

        $this->call->view('user/view', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post') {
            $data = [
                'username' => $this->io->post('username'),
                'email'    => $this->io->post('email')
            ];
            $this->UserModel->insert($data);
            redirect('/');
        } else {
            $this->call->view('user/create');
        }
    }

    public function update($id)
    {
        $data['user'] = $this->UserModel->find($id);

        if ($this->io->method() == 'post') {
            $updateData = [
                'username' => $this->io->post('username'),
                'email'    => $this->io->post('email')
            ];
            $this->UserModel->update($id, $updateData);
            redirect('/');
        } else {
            $this->call->view('user/update', $data);
        }
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);
        redirect('/');
    }
}
