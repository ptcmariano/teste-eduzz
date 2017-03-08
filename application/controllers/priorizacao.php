<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priorizacao extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		Autenticado();     

		$this->load->model('projetos_model');		
	}

	public function index()
	{
		$this->load->model('projetos_model');
		$projetos = $this->projetos_model->get_byfilter($this->input->get('nome'));
		$data = array(
			'page'=>'priorizacao/index',
			'title'=>'Priorização',
			'subtitle'=>'Selecione um projeto para prioriza-lo manual ou automaticamente',
			'projetos'=>$projetos
		);
		$this->load->view('_layout', $data);
	}

	
	public function automatica()
	{
		$this->load->model('projetos_model');
		$projetos = $this->projetos_model->get_byfilter($this->input->get('nome'));
		$data = array(
			'page'=>'priorizacao/automatica',
			'title'=>'Priorização',
			'subtitle'=>'Selecione um projeto para prioriza-lo manual ou automaticamente',
			'projetos'=>$projetos
		);
		$this->load->view('_layout', $data);
	}
	
	public function validator_nome($str)
	{
		if(trim($str) == ''){
			$this->form_validation->set_message('validator_nome', '<i>%s</i> é obrigatório.');
			return  FALSE;
		}
		else{
			$this->form_validation->set_message('validator_nome', 'Já existe um Projeto com este Nome. Escolha outro Nome.');
			return !$this->projetos_model->check_nome_exists($this->input->post('prj_cod'), trim($str));
		}
	}

	public function form($prj_cod=0){

    	$this->load->helper(array('form'));
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('nome', 'Nome', 'required');
    	$this->form_validation->set_rules('descricao', 'Descrição', 'required');
    	$this->form_validation->set_message('required', '<i>%s</i> é obrigatório');
		$this->form_validation->set_rules('nome', 'Nome do Projeto', "callback_validator_nome");


	  	// Valida o formulário
			if(isset($_POST['save']))
			{
				$resultValidation = $this->form_validation->run();

				// Se passou na validação, procede com o salvamento
				if($resultValidation == TRUE)
				{
					// Obtém os dados inseridos
					$dados['prj_nome'] = trim($this->input->post('nome'));
					$dados['prj_descricao'] = trim($this->input->post('descricao'));
					
					if($prj_cod == 0)
					{
					// Cria um Novo 
						$id_created = $this->projetos_model->insert($dados);
						$this->session->set_flashdata('msg', array('tipo'=>'sucesso', 'title'=>'Cadastrado com Sucesso!', 'msg'=>''));
						redirect(base_url().'projetos/form/'.$id_created);					
					}
					// Salva as alterações
					else{
						$this->projetos_model->update($dados, $prj_cod);
						$this->notification = array('tipo'=>'sucesso', 'title'=>'Alterações Salvas!', 'msg'=>'As alterações foram salvas com sucesso!');
					}
				}
			}

      	// Obtém os dados do projeto
	    	$record = $prj_cod == 0 ? null : $this->projetos_model->get_by_cod($prj_cod); 

	  	// Caso clicou em Apagar
			if(isset($_POST['delete']))
			{
				$this->apagar($_POST['prj_cod']);
			}


	  	// Alimenta as variaveis para a exibição da página
			$title = 'Novo Projeto';
			$subtitle = '';

	    	if(!empty($record))
	    	{
	    		$title = $record->prj_nome;
	    	}	



		$data = array(
			'title' => $title,
			'subtitle' => $subtitle,
			'page' => 'projetos/form',
			'mode' => !empty($record) ? 'alter' : 'new',
			'notification'=>$this->notification,
			'record' => $record,
			);

		$this->load->view('_layout', $data);		
	}

	protected function apagar($prj_cod)
	{	

	  	// Redireciona caso ñ tenha permissão
		$_rec = $this->projetos_model->get_by_cod($prj_cod);
		if(empty($_rec))
			redirect(base_url('projetos'));
	 	else{
			// Apaga
			$result_delete = $this->projetos_model->delete($prj_cod);
			if(empty($result_delete)){
				// Deletou com sucesso. Redireciona
				$this->session->set_flashdata('msg', array('tipo'=>'sucesso','title'=>'', 'msg'=>'<b>'.$_rec->prj_nome.'</b> foi apagado com sucesso!') );
				redirect(base_url().'projetos');
			}else{
				// Ocorreu um erro ao deletar
				$this->notification = array('tipo'=>'atencao', 'title'=>'Exclusão cancelada!', 'msg'=>$result_delete);	
				redirect(base_url().'projetos');
			}
	 	}		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */