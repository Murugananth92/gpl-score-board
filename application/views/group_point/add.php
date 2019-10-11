<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Add Group</h3>
			</div>
			
			<?php echo form_open('group_point/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
							<input type="hidden" name="group_id" value="<?php echo $this->uri->segment(3);?>" class="form-control" id="group_id" />
							<input disabled type="hidden" name="tournament_name" value="<?php $all_tournaments[0]['tournament_id']; print_r($all_tournaments[0]['tournament_name']);?>" class="form-control" id="group_name" />
						<label for="tournament_team_name" class="control-label"><span class="text-danger">*</span>Tournament Team</label>
						<select name="tournament_team_name" class="form-control">
							<option value="">select tournament_team</option>
							<?php 
							foreach($all_tournament_teams as $tournament_team)
							{
								$selected = ($tournament_team['tournament_team_id'] == $this->input->post('tournament_team_id')) ? ' selected="selected"' : "";

								echo '<option value="'.$tournament_team['tournament_team_id'].'" '.$selected.'>'.$tournament_team['team_name'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('tournament_team_name');?></span>
					</div>
					<div class="col-md-6">
						<label for="net_run_rate" class="control-label"><span class="text-danger">*</span>Net Run Rate</label>
						<input type="text" class="form-control" name="net_run_rate" value="<?php echo ($this->input->post('net_run_rate') ? $this->input->post('net_run_rate') : 0);?>" />
						<span class="text-danger"><?php echo form_error('net_run_rate');?></span>
					</div>
					<div class="col-md-6">
						<label for="points" class="control-label"><span class="text-danger">*</span>Points</label>
						<input type="text" class="form-control" name="points" value="<?php echo ($this->input->post('points') ? $this->input->post('net_run_rate') : 0);?>" />
						<span class="text-danger"><?php echo form_error('points');?></span>
					</div>
					<div class="col-md-6">
						<label for="wins" class="control-label"><span class="text-danger">*</span>wins</label>
						<input type="text" class="form-control" name="wins" value="<?php echo ($this->input->post('wins') ? $this->input->post('net_run_rate') : 0);?>" />
						<span class="text-danger"><?php echo form_error('wins');?></span>
					</div>
					<div class="col-md-6">
						<label for="losses" class="control-label"><span class="text-danger">*</span>losses</label>
						<input type="text" class="form-control" name="losses" value="<?php echo ($this->input->post('losses') ? $this->input->post('net_run_rate') : 0);?>" />
						<span class="text-danger"><?php echo form_error('losses');?></span>
					</div>
					<div class="col-md-6">
						<label for="n/r" class="control-label"><span class="text-danger">*</span>n/r</label>
						<input type="text" class="form-control" name="n/r" value="<?php echo ($this->input->post('n/r') ? $this->input->post('net_run_rate') : 0);?>" />
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
