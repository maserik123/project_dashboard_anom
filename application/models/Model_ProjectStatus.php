<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectStatus extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('project_status');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('project_status_id, status_name');
        $this->datatables->from('project_status');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('project_status', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('project_status');
        $this->db->where('project_status_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('project_status ap', array('ap.project_status_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('project_status_id', $id);
        $this->db->update('project_status', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('project_status_id', $id);
        $this->db->delete('project_status');
    }
}

/* End of file Model_user.php */
