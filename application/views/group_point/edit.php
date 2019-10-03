<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Group Add</h3>
			</div>
			
			<?php echo form_open('group_point/edit/'.$group_point['group_points_id']); ?>
          	<div class="box-body">
          		<div class="row clearfix">
				  <div class="col-md-6">
						<label for="group_name" class="control-label"><span class="text-danger">*</span>Group Name</label>
							<input type="hidden" name="tournament_id" value="<?php echo $all_tournaments[0]['tournament_id'];?>" class="form-control" id="group_name" />
							<input disabled type="hidden" name="tournament_name" value="<?php $all_tournaments[0]['tournament_id']; print_r($all_tournaments[0]['tournament_name']);?>" class="form-control" id="group_name" />
						<label for="group_name" class="control-label"><span class="text-danger">*</span>Tournament Team</label>
							<input disabled type="text" name="team_name" value="<?php echo $group_point['team_name']; ?>" class="form-control" id="group_name" />
							<input type="hidden" name="tournament_team_id" value="<?php echo $group_point['tournament_team_id']; ?>" class="form-control" id="group_name" />
					</div>
					<div class="col-md-6">
						<label for="net_run_rate" class="control-label"><span class="text-danger">*</span>Net Run Rate</label>
						<input type="text" class="form-control" name="net_run_rate" value="<?php echo ($this->input->post('net_run_rate') ? $this->input->post('net_run_rate') : $group_point['net_run_rate']); ?>" />
						<span class="text-danger"><?php echo form_error('net_run_rate');?></span>
					</div>
					<div class="col-md-6">
						<label for="points" class="control-label"><span class="text-danger">*</span>Points</label>
						<input type="text" class="form-control" name="points" value="<?php echo ($this->input->post('points') ? $this->input->post('points') : $group_point['points']); ?>" />
						<span class="text-danger"><?php echo form_error('points');?></span>
					</div>
					<div class="col-md-6">
						<label for="wins" class="control-label"><span class="text-danger">*</span>wins</label>
						<input type="text" class="form-control" name="wins" value="<?php echo ($this->input->post('wins') ? $this->input->post('wins') : $group_point['wins']); ?>" />
						<span class="text-danger"><?php echo form_error('wins');?></span>
					</div>
					<div class="col-md-6">
						<label for="losses" class="control-label"><span class="text-danger">*</span>losses</label>
						<input type="text" class="form-control" name="losses" value="<?php echo ($this->input->post('losses') ? $this->input->post('losses') : $group_point['losses']); ?>" />
						<span class="text-danger"><?php echo form_error('losses');?></span>
					</div>
					<div class="col-md-6">
						<label for="n/r" class="control-label"><span class="text-danger">*</span>n/r</label>
						<input type="text" class="form-control" name="n/r" value="<?php echo ($this->input->post('n/r') ? $this->input->post('n/r') : $group_point['n/r']); ?>" />
						<span class="text-danger"><?php echo form_error('n/r');?></span>
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
