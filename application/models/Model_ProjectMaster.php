<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectMaster extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('master_project');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('a.master_project_id, a.project_name, b.criteria_project_name, a.project_description ');
        $this->datatables->from('master_project a');
        $this->datatables->join('criteria_project b', 'b.criteria_project_id = a.criteria_project_id', 'inner');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('master_project', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('master_project');
        $this->db->where('master_project_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('master_project ap', array('ap.master_project_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('master_project_id', $id);
        $this->db->update('master_project', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('master_project_id', $id);
        $this->db->delete('master_project');
    }
}

/* End of file Model_user.php */
