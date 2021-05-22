<div class="row">
	<div class="col-md-4 col-lg-3">

		<section class="panel">
			<div class="panel-body">
				<div class="thumb-info mb-md">
					<?php
					echo $this->Html->image("/img/!logged-user.jpg", [
							"alt" => $myself->name,
							"class" => "rounded img-responsive"
					]);
					?>
					<div class="thumb-info-title">
						<span class="thumb-info-inner"><?=$myself->name?></span>
						<span class="thumb-info-type"><?=$myself->role->name?></span>
					</div>
				</div>

				<div class="widget-toggle-expand mb-md">
					<div class="widget-content-expanded">
						<ul class="simple-todo-list">
							<?php
							$icon = $myself->user_status->id == 1 ? 'check' : 'times';
							?>
							<li><i class="fa fa-<?=$icon?>" aria-hidden="true"></i>&nbsp;<?=$myself->user_status->name?></li>
						</ul>
					</div>
				</div>

			</div>
		</section>

	</div>

</div>