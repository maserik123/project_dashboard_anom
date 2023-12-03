<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_RiskMitigation extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('risk_mitigation');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('a.risk_mitigation_id, b.project_name, a.risk_profile, a.mitigation, a.checklist');
        $this->datatables->from('risk_mitigation a');
        $this->datatables->join('master_project b', 'b.master_project_id = a.master_project_id', 'inner');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('risk_mitigation', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('risk_mitigation');
        $this->db->where('risk_mitigation_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('risk_mitigation ap', array('ap.risk_mitigation_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('risk_mitigation_id', $id);
        $this->db->update('risk_mitigation', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('risk_mitigation_id', $id);
        $this->db->delete('risk_mitigation');
    }
}

/* End of file Model_user.php */
