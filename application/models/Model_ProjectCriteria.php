<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectCriteria extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('criteria_project');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('criteria_project_id, criteria_project_name');
        $this->datatables->from('criteria_project');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('criteria_project', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('criteria_project');
        $this->db->where('criteria_project_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('criteria_project ap', array('ap.criteria_project_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('criteria_project_id', $id);
        $this->db->update('criteria_project', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('criteria_project_id', $id);
        $this->db->delete('criteria_project');
    }
}

/* End of file Model_user.php */
