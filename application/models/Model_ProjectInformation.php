<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectInformation extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('project_information');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('a.project_information_id, b.project_name, a.consultant_name, a.contract_price, a.termyn_value, a.payed, a.kind_of_consultant');
        $this->datatables->from('project_information a');
        $this->datatables->join('master_project b', 'b.master_project_id = a.master_project_id', 'inner');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('project_information', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('project_information');
        $this->db->where('project_information_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('project_information ap', array('ap.project_information_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('project_information_id', $id);
        $this->db->update('project_information', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('project_information_id', $id);
        $this->db->delete('project_information');
    }
}

/* End of file Model_user.php */
