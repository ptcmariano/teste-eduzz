<?php 

class recursoconhecimento_model extends MY_Model {
    private $table;
  
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table = 'TRecursoConhecimento';
    }

  /**
  * insere os conhecimentos de um recurso
  * @param $dados array
  */
    function insert($rcs_id, $dados)
    {
        $inseridos = [];
        foreach($dados as $conhecimento){
          $row=[];
          $row['rc_conhecimento'] = $conhecimento;
          $row['rcs_id'] = $rcs_id;
          $this->db->insert($this->table, $row);
          $inseridos[] = $this->db->insert_id();
        }
        return $inseridos;
    }
  
    function get_byrcs_id($rcs_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('rcs_id', $rcs_id);
        $query = $this->db->get();
        return $query->result();
    }
}
