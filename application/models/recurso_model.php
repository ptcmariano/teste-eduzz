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
}
