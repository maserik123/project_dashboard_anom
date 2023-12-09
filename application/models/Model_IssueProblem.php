<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_IssueProblem extends CI_Model
{
    function getData()
    {
        $this->db->select('*');
        $this->db->from('issue_problem');
        return $this->db->get()->result();
    }

    function getAllData()
    {
        $this->datatables->select('a.issue_problem_id, c.project_name, a.problem, a.solution, b.pic_project_name');
        $this->datatables->from('issue_problem a');
        $this->datatables->join('pic_project_dtl b', 'b.pic_project_dtl_id = a.pic_project_dtl_id', 'inner');
        $this->datatables->join('master_project c', 'c.master_project_id = a.master_project_id', 'inner');
        return $this->datatables->generate();
    }

    function addData($data)
    {
        $this->db->insert('issue_problem', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function getById($id)
    {
        $this->db->from('issue_problem');
        $this->db->where('issue_problem_id', $id);
        return $this->db->get()->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('issue_problem ap', array('ap.issue_problem_id' => $id))->result();
    }

    function update($id, $data)
    {
        $this->db->where('issue_problem_id', $id);
        $this->db->update('issue_problem', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('issue_problem_id', $id);
        $this->db->delete('issue_problem');
    }
}

/* End of file Model_user.php */
