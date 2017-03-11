<?php 

class projetos_model extends MY_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_byfilter($filter='')
    {
        $this->db->select('*');
        $this->db->from('TProjetos');

        if($filter != 0 && is_numeric($filter))
            $this->db->where('prj_cod', $filter);

        if($filter != '' && !is_numeric($filter)) {
            $this->db->where('prj_nome', $prj_nome);
        }

        $query = $this->db->get();

        return $query->result();
    }

    function get_by_cod($prj_cod)
    {
        $this->db->select('*');
        $this->db->from('TProjetos');
        $this->db->where('prj_cod', $prj_cod);
        $query = $this->db->get();

        $result = $query->result();

        return empty($result) ? null : $result[0]; 
    }  

    function get_total()
    {
        $this->db->select('count(*) as total');
        $this->db->from('TProjetos');
        $query = $this->db->get();

        $result = $query->result();

        return empty($result) ? 0 : $result[0]->total; 
    }           

    function check_nome_exists($prj_cod, $prj_nome){  

        $q = $this->db->query(
            "SELECT * FROM TProjetos ".
            " WHERE prj_cod != ".$prj_cod." AND prj_nome = '".trim($prj_nome)."'"
        );
        $result = $q->result();
        return empty($result) ? FALSE : TRUE;      
    }


    function insert($dados)
    {
        $this->db->insert('TProjetos', $dados); 
        return $this->db->insert_id();
    }    

    function update($update_values, $prj_cod)
    {
        $this->db->where('prj_cod', $prj_cod);
        $this->db->update('TProjetos', $update_values); 
    } 

    function delete($prj_cod)
    {
        $this->db->delete('TProjetos', array('prj_cod' => $prj_cod));
    }


}