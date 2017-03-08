
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default panel-table">
			
			<div class="panel-heading">
				Lista de Projetos
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
						<?php if($projetos != null){ ?>
							<?php foreach ($projetos as $proj) { ?>
								<tr>
									<td><?=$proj->prj_cod?></td>
									<td><?=$proj->prj_nome?></td>
									<td class="actions">
										<a href="<?=base_url().'priorizacao/manual' ?>" class="btn btn-default" data-toggle="tooltip" title="Manual">Manual <i class="mdi mdi-edit"></i></a>
									</td>
									<td class="actions">
										<a href="<?=base_url().'priorizacao/automatica' ?>" class="btn btn-default" data-toggle="tooltip" title="Manual">Automatica <i class="mdi mdi-refresh"></i></a>
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
			</div>
		</div>	
	</div>
</div>