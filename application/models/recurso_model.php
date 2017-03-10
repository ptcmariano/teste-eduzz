<?php 

class recurso_model extends MY_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_byfilter($filter='')
    {
        $this->db->select('*');
        $this->db->from('TRecurso');

        if($filter != 0 && is_numeric($filter))
            $this->db->where('rcs_id', $filter);

        if($filter != '' && !is_numeric($filter)) {
            $this->db->where('rcs_nome', $prj_nome);
        }

        $query = $this->db->get();

        return $query->result();
    }
}
