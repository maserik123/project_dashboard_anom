<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_ProjectPICDetails extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('pic_project_dtl');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('pic_project_dtl_id, pic_project_name');
        $this->datatables->from('pic_project_dtl');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('pic_project_dtl', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('pic_project_dtl');
        $this->db->where('pic_project_dtl_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('pic_project_dtl ap', array('ap.pic_project_dtl_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('pic_project_dtl_id', $id);
        $this->db->update('pic_project_dtl', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('pic_project_dtl_id', $id);
        $this->db->delete('pic_project_dtl');
    }
}

/* End of file Model_user.php */
