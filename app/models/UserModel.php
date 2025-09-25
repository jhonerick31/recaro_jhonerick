<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';

    // Insert user
    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    // Get all users (matches Model::all signature)
    public function all($with_deleted = false)
    {
        $builder = $this->db->table($this->table)
                            ->order_by($this->primary_key, 'DESC');

        // If framework supports soft deletes
        if (!$with_deleted && method_exists($this, 'withoutDeleted')) {
            $builder = $this->withoutDeleted($builder);
        }

        return $builder->get_all();
    }

    // Find one user by ID (matches Model::find signature)
    public function find($id, $with_deleted = false)
    {
        $builder = $this->db->table($this->table)
                            ->where($this->primary_key, $id);

        if (!$with_deleted && method_exists($this, 'withoutDeleted')) {
            $builder = $this->withoutDeleted($builder);
        }

        return $builder->get();
    }

    // Update (matches Model::update signature)
    public function update($id, $data)
    {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->update($data);
    }

    // Delete (matches Model::delete signature)
    public function delete($id)
    {
        return $this->db->table($this->table)
                        ->where($this->primary_key, $id)
                        ->delete();
    }

    // Pagination + Search
    public function page($q = '', $limit = 5, $page = 1)
    {
        $offset = ($page - 1) * $limit;

        // Base query
        $builder = $this->db->table($this->table);

        // Apply search
        if (!empty($q)) {
            $builder->like('username', $q)
                    ->or_like('email', $q);
        }

        // Get filtered records
        $records = $builder->limit($limit, $offset)
                           ->order_by($this->primary_key, 'DESC')
                           ->get_all();

        // Count total rows
        $count_builder = $this->db->table($this->table);
        if (!empty($q)) {
            $count_builder->like('username', $q)
                          ->or_like('email', $q);
        }
        $total_rows = $count_builder->count();

        return [
            'records'    => $records,
            'total_rows' => $total_rows
        ];
    }
}
