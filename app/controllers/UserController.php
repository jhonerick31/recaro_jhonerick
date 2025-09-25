<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session');
        $this->call->model('UserModel'); // siguraduhin na loaded ang model
    }

    public function index()
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
        $records_per_page = 10;

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
        
        $this->pagination->set_theme('bootstrap'); // or tailwind, custom

        // ✅ Initialize pagination
        $this->pagination->initialize(
            $total_rows, 
            $records_per_page, 
            $page, 
            site_url('user').'?q='.$q
        );

        // ✅ Paginated links + search
        $data['page']   = $this->pagination->paginate();
        $data['search'] = $q;

        $this->call->view('user/view', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email    = $this->io->post('email');

            $data = [
                'username' => $username,
                'email'    => $email
            ];

            $this->UserModel->insert($data);
            redirect('/user');
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
            redirect('/user');
        } else {
            $this->call->view('user/update', $data);
        }
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);
        redirect('/user');
    }
}
?>
