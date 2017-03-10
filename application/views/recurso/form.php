<?php 
    if(validation_errors()):
?>      
<div role="alert" class="alert alert-danger alert-icon alert-dismissible">
  <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
  <div class="message">
    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
    <?=validation_errors()?>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-default panel-border-color panel-border-color-primary">
        <div class="panel-heading panel-heading-divider">Informações Básicas<span class="panel-subtitle">Cadastre abaixo as informações do recurso</span></div>
        <div class="panel-body">
          <?php echo form_open(base_url().'recurso/form/'. empty($record) ? '' : $record->rcs_id , array('class'=>'form-horizontal group-border-dashed', 'style'=>'border-radius: 0px;')) ?>
            
            <input type="hidden" name="rcs_id" value="<?= !empty($record) ? $record->rcs_id : '0' ?>">    

            <div class="form-group">
              <label class="col-sm-3 control-label">Nome</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="nome"
                value="<?= !empty($_POST) ? $this->input->post('nome') : (!empty($record) ? $record->rcs_nome : '') ?>" maxlength="250">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Telefone</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="telefone"
                value="<?= !empty($_POST) ? $this->input->post('telefone') : (!empty($record) ? $record->rcs_telefone : '') ?>" maxlength="50">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Email</label>
              <div class="col-sm-6">                
                <input type="email" class="form-control" name="email"
                value="<?= !empty($_POST) ? $this->input->post('email') : (!empty($record) ? $record->rcs_email : '') ?>" maxlength="100">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Conhecimento</label>
              <div class="col-sm-4">
                <select class="form-control" id="selectconhecimento">
                  <option value="">Selecione conhecimento</option>
                  <option value="front">front-end</option>
                  <option value="back">backend</option>
                  <option value="test">testes</option>
                  <option value="devops">devops</option>
                </select>
              </div>
              <div class="col-sm-2">
              <button class="form-control" onclick="addconhecimento(event)">Adicionar</button>
              </div>
            </div>
          <div class="col-sm-6 col-sm-offset-3">
            <table id="tconhecimentolist" class="table">
              <thead>
              <th>Conhecimento</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

            <div class="row">
              <div class="col-xs-6"></div>
              <div class="col-xs-3">
                <p class="text-right">
                  <button type="submit" class="btn btn-space btn-primary" name="save"><?=$mode == 'alter' ? 'Salvar Alterações' : 'Cadastrar'?></button>
                  <a href="<?=base_url().'recurso'?>" class="btn btn-space btn-default">Voltar</a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<script>
window.onload = function(){
  window.addconhecimento = function(ev){
    ev.preventDefault();
    var tableconhecimento = document.getElementById('tconhecimentolist');
    var linha = tableconhecimento.insertRow();
    var cell = linha.insertCell();
    var txtconhecimento = document.getElementById('selectconhecimento').selectedOptions[0].innerText;
    cell.innerHTML = '' +txtconhecimento+ '<input type="hidden" name="conhecimento[]" value="'+txtconhecimento+'" >';
  }
};
</script>