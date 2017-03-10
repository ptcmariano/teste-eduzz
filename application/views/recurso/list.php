<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				Recursos
				<div class="tools">
					<a class="btn btn-space btn-success" href="<?=base_url().'recurso/form/' ?>">Novo recurso</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width: 60px">Id</th>
							<th>Nome</th>
							<th style="width: 40px"></th>
							<th style="width: 40px"></th>
						</tr>
					</thead>
					<tbody>
						<?php if($recurso != null){ ?>
							<?php foreach ($recurso as $recur) { ?>
								<tr>
									<td><?=$recur->rcs_id?></td>
									<td><?=$recur->rcs_nome?></td>
									<td class="actions">
										<a href="<?=base_url().'recurso/form/'.$recur->rcs_id ?>" class="btn btn-default" data-toggle="tooltip" title="Editar"><i class="mdi mdi-edit"></i></a>
									</td>
									<td class="actions">
									   <form method="POST" style="width:55px;display: inline-block;">
					             <input type="hidden" name="rcs_id" value="<?= $recur->rcs_id ?>">
					             <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este item?');" class="btn btn-default" data-toggle="tooltip" title="Apagar" name="delete">
					               <i class="mdi mdi-delete"></i>
					             </button>
				             </form>
									</td>
								</tr>
							<?php } ?>
						<?php } else{ ?>
							<tr>
								<td colspan="4">Nenhum registro encontrado</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div><!-- panel-body -->
		</div><!-- panel -->
	</div>
</div>