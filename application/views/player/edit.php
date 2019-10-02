<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Player Edit</h3>
            </div>
			<?php echo form_open('player/edit/'.$player['player_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="player_name" class="control-label"><span class="text-danger">*</span>Player Name</label>
						<div class="form-group">
							<input type="text" name="player_name" value="<?php echo ($this->input->post('player_name') ? $this->input->post('player_name') : $player['player_name']); ?>" class="form-control" id="player_name" />
							<span class="text-danger"><?php echo form_error('player_name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="player_email" class="control-label"><span class="text-danger">*</span>Player Email</label>
						<div class="form-group">
							<input type="text" name="player_email" value="<?php echo ($this->input->post('player_email') ? $this->input->post('player_email') : $player['player_email']); ?>" class="form-control" id="player_email" />
							<span class="text-danger"><?php echo form_error('player_email');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="company" class="control-label"><span class="text-danger">*</span>Company</label>
						<div class="form-group">
							<input type="text" name="company" value="<?php echo ($this->input->post('company') ? $this->input->post('company') : $player['company']); ?>" class="form-control" id="company" />
							<span class="text-danger"><?php echo form_error('company');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="employee_id" class="control-label"><span class="text-danger">*</span>Employee Id</label>
						<div class="form-group">
							<input type="text" name="employee_id" value="<?php echo ($this->input->post('employee_id') ? $this->input->post('employee_id') : $player['employee_id']); ?>" class="form-control" id="employee_id" />
							<span class="text-danger"><?php echo form_error('employee_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="player_role" class="control-label"><span class="text-danger">*</span>Player Role</label>
						<div class="form-group">
							<input type="text" name="player_role" value="<?php echo ($this->input->post('player_role') ? $this->input->post('player_role') : $player['player_role']); ?>" class="form-control" id="player_role" />
							<span class="text-danger"><?php echo form_error('player_role');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>