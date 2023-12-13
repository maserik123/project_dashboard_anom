<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectDetails extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('project_m_dtl');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('project_m_dtl_id, project_name, project_activity, pic_project_name, dateline, progress, tipe, ket,ket');
        $this->datatables->from('v_project_m_dtl');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('project_m_dtl', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('project_m_dtl');
        $this->db->where('project_m_dtl_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('project_m_dtl ap', array('ap.project_m_dtl_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('project_m_dtl_id', $id);
        $this->db->update('project_m_dtl', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('project_m_dtl_id', $id);
        $this->db->delete('project_m_dtl');
    }
}

/* End of file Model_user.php */
