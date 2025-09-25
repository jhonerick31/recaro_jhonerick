<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session'); 
        $this->call->model('UserModel'); // make sure model is loaded
    }

    public function create() {
        if($this->form_validation->submitted()){
            $username = $this->io->post('username');
            $email    = $this->io->post('email');

            $this->UserModel->create($username, $email);
            redirect('get_all');
        }
        $this->call->view('user/create');
    }

    public function update($id) {
        $user = $this->UserModel->get_one($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email    = $_POST['email'];

            $this->UserModel->update($id, $username, $email);
            redirect('get_all');
        }

        $this->call->view('user/update', ['user' => $user]);
    }

    public function delete($id) {
        $this->UserModel->delete($id);
        redirect('get_all');
    }

    public function get_all() 
    {
        // ✅ Current page
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int)$this->io->get('page');
        }

        // ✅ Search keyword
        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        // ✅ Records per page
        $records_per_page = 5;

        // ✅ Get paginated data from model
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // ✅ Pagination options
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        
        $this->pagination->set_theme('bootstrap'); // or tailwind

        // ✅ Initialize pagination
        $this->pagination->initialize(
            $total_rows, 
            $records_per_page, 
            $page, 
            site_url('get_all').'?q='.$q
        );

        // ✅ Paginated links
        $data['page'] = $this->pagination->paginate();
        $data['search'] = $q;

        $this->call->view('user/get_all', $data);
    }
}
