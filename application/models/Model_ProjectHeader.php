<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectHeader extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('project_m_hdr');
        return $this->db->get()->result();
    }

    function getAllData1()
    {
        $this->datatables->select('a.project_m_hdr_id, 
        b.project_name, 
        c.pic_project_name, 
        d.criteria_project_name, 
        a.start_date, 
        a.end_date, 
        a.capex_budget, 
        a.capex_realization, 
        a.revenue_target, 
        a.revenue_realization, 
        e.status_name, 
        a.progress, 
        a.update_status ');
        $this->datatables->from('project_m_hdr a');
        $this->datatables->join('master_project b', 'b.master_project_id = a.master_project_id', 'inner');
        $this->datatables->join('pic_project_hdr c', 'c.pic_project_hdr_id = a.pic_project_hdr_id', 'inner');
        $this->datatables->join('criteria_project d', 'd.criteria_project_id = a.criteria_project_id', 'inner');
        $this->datatables->join('project_status e', 'e.project_status_id = a.project_status_id', 'inner');
        return $this->datatables->generate();
    }

    function getAllData()
    {
        $this->datatables->select('project_m_hdr_id, project_name, pic_project_name, criteria_project_name, start_date, end_date, duration, capex_budget, capex_realization, revenue_target, revenue_realization, status_name, progress, mitigation, checklist, update_status');
        $this->datatables->from('v_project_m_hdr');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('project_m_hdr', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('project_m_hdr');
        $this->db->where('project_m_hdr_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('project_m_hdr ap', array('ap.project_m_hdr_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('project_m_hdr_id', $id);
        $this->db->update('project_m_hdr', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('project_m_hdr_id', $id);
        $this->db->delete('project_m_hdr');
    }
}

/* End of file Model_user.php */
