<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * Extended with CRUD and pagination logic for `users` table.
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Create user
    public function create($username, $email) {
        $data = [
            'username' => $username,
            'email'    => $email
        ];
        return $this->db->table($this->table)->insert($data);
    }

    // Get single user by ID
    public function get_one($id) {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->get();
    }

    // Update user
    public function update($id, $username, $email) {
        $data = [
            'username' => $username,
            'email'    => $email
        ];
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->update($data);
    }

    // Delete user
    public function delete($id) {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->delete();
    }

    // Pagination + search
    public function page($q = '', $records_per_page = null, $page = null) {
        if (is_null($page)) {
            return $this->db->table($this->table)->get_all();
        } else {
            $query = $this->db->table($this->table);

            if (!empty($q)) {
                $query->like('id', '%'.$q.'%')
                      ->or_like('username', '%'.$q.'%')
                      ->or_like('email', '%'.$q.'%');
            }

            // Count total rows
            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')
                                             ->get()['count'];

            // Paginated records
            $data['records'] = $query->pagination($records_per_page, $page)
                                     ->get_all();

            return $data;
        }
    }
}
