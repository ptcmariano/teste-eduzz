<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class recurso extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		Autenticado();     

		$this->load->model('recurso_model');
	}

	public function index()
	{
		$recurso = $this->recurso_model->get_byfilter($this->input->get('nome'));

		$data = array(
			'page'=>'recurso/list',
			'title'=>'recurso',
			'subtitle'=>'Todos os recurso cadastrados no sistema',
			'recurso'=>$recurso
		);

		$this->load->view('_layout', $data);
	}


	public function form($rcs_id=0) 
	{
	  	// Caso clicou em Apagar
			if(isset($_POST['delete']))
			{
				$this->apagar($_POST['rcs_id']);
			}
		
		$this->load->helper(array('form'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nome', 'Nome', 'required');
    $this->form_validation->set_message('required', '<i>%s</i> é obrigatório');
		
	  	// Valida o formulário
			if(isset($_POST['save']))
			{
				$resultValidation = $this->form_validation->run();

				// Se passou na validação, procede com o salvamento
				if($resultValidation == TRUE)
				{
					// Obtém os dados inseridos
					$dados['rcs_nome'] = trim($this->input->post('nome'));
					$dados['rcs_telefone'] = trim($this->input->post('telefone'));
					$dados['rcs_email'] = trim($this->input->post('email'));
					//var_dump($this->input->post('conhecimento'));
					//die('dados');
					
					if($rcs_id == 0)
					{
					// Cria um Novo 
						$id_created = $this->recurso_model->insert($dados);
						$this->session->set_flashdata('msg', array('tipo'=>'sucesso', 'title'=>'Cadastrado com Sucesso!', 'msg'=>''));
						redirect(base_url().'recurso/form/'.$id_created);					
					}
					// Salva as alterações
					else{
						$this->recurso_model->update($dados, $rcs_id);
						$this->notification = array('tipo'=>'sucesso', 'title'=>'Alterações Salvas!', 'msg'=>'As alterações foram salvas com sucesso!');
					}
				}
			}

     	// Obtém os dados do recurso
			$record = $rcs_id == 0 ? null : $this->recurso_model->get_by_cod($rcs_id);
	  	// Alimenta as variaveis para a exibição da página
			$title = 'Novo recurso';
			$subtitle = '';

    	if(!empty($record))
    	{
				$title = 'Recurso: ' . $record->rcs_nome;
    	}

		$data = array(
			'title' => $title,
			'subtitle' => $subtitle,
			'page' => 'recurso/form',
			'mode' => !empty($record) ? 'alter' : 'new',
			'notification'=>$this->notification,
			'record' => $record,
		);

		$this->load->view('_layout', $data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */