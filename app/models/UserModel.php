<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 * 
 * With search and pagination (based on actual users table).
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q, $records_per_page = null, $page = null) {
        if (is_null($page)) {
            return $this->db->table($this->table)->get_all();
        } else {
            $query = $this->db->table($this->table);

            // Searchable fields (based on your table structure)
            $query->like('id', '%'.$q.'%')
                  ->or_like('username', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%');

            // Clone before pagination for counting
            $countQuery = clone $query;

            $data['total_rows'] = $countQuery->select_count('*', 'count')
                                             ->get()['count'];

            $data['records'] = $query->pagination($records_per_page, $page)
                                     ->get_all();

            return $data;
        }
    }
}
?>
