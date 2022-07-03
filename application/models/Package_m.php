<?php defined('BASEPATH') or exit('No direct script access allowed');

class Package_m extends CI_Model
{
    public function getPitem($p_item_id = null)
    {
        $this->db->select('*, package_item.description as description, package_item.description_item as descriptionItem, package_item.name as nameItem');
        $this->db->from('package_item');
        $query = $this->db->get();
        return $query;
    }

    public function getPitemById($p_item_id)
    {
        $this->db->select('p_item_id');
        $this->db->from('package_item');
        $this->db->where('p_item_id', $p_item_id);
        $query = $this->db->get();
        return $query;
    }

    public function addPItem($post)
    {
        $params = [
            'name' => $post['name'],
            'price' => $post['price'],
            'category' => $post['category'],
            'description' => $post['description'],
            'description_item' => $post['description_item'],
            'date_created' => time()
        ];
        if (!empty($_FILES['picture']['name'])) {
            $params['picture'] = $post['picture'];
        }
        $this->db->insert('package_item', $params);
    }
    public function editPItem($post)
    {
        $params = [
            'name' => $post['name'],
            'price' => $post['price'],
            'category' => $post['category'],
            'description' => $post['description'],
            'description_item' => $post['description_item'],
            'date_created' => time()
        ];
        if (!empty($_FILES['picture']['name'])) {
            $params['picture'] = $post['picture'];
        }
        $this->db->where('p_item_id', $post['p_item_id']);
        $this->db->update('package_item', $params);
    }
    public function deletePItem($p_item_id)
    {
        $this->db->where('p_item_id', $p_item_id);
        $this->db->delete('package_item');
    }
}
