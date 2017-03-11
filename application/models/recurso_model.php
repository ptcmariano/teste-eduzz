<?php 

class recurso_model extends MY_Model {
    private $table;
  
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table = 'TRecurso';
    }

    function get_byfilter($filter='')
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if($filter != 0 && is_numeric($filter))
            $this->db->where('rcs_id', $filter);

        if($filter != '' && !is_numeric($filter)) {
            $this->db->where('rcs_nome', $prj_nome);
        }

        $query = $this->db->get();

        return $query->result();
    }
  
    function insert($dados)
    {
        $this->db->insert($this->table, $dados); 
        return $this->db->insert_id();
    }
  
    function get_by_cod($rcs_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('rcs_id', $rcs_id);
        $query = $this->db->get();
        $result = $query->result();
        return empty($result) ? null : $result[0];
    }
  
    function update($update_values, $rcs_id)
    {
        $this->db->where('rcs_id', $rcs_id);
        $this->db->update($this->table, $update_values); 
    }
  
    function delete($rcs_id)
    {
        $this->db->delete($this->table, array('rcs_id' => $rcs_id));
    }
}
