<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tournament Team Add</h3>
            </div>
            <?php echo form_open('tournament_team/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="tournament_name" class="control-label"><span class="text-danger">*</span>Tournament Id</label>
						<select name="tournament_name" class='form-control'>
						<option value="">select tournament</option>
						<?php 
						foreach($all_tournaments as $tournament)
						{
							$selected = ($tournament['tournament_id'] == $this->input->post('tournament_id')) ? ' selected="selected"' : "";

							echo '<option value="'.$tournament['tournament_id'].'" '.$selected.'>'.$tournament['tournament_name'].'</option>';
						} 
						?>
					</select>
					<span class="text-danger"><?php echo form_error('tournament_name');?></span>
					</div>
					
					<div class="col-md-6">
						<label for="team_name" class="control-label"><span class="text-danger">*</span>Team Name</label>
						<select name="team_name" class='form-control'>
							<option value="">select team</option>
							<?php 
							foreach($all_teams as $team)
							{
								$selected = ($team['team_id'] == $this->input->post('team_id')) ? ' selected="selected"' : "";

								echo '<option value="'.$team['team_id'].'" '.$selected.'>'.$team['team_name'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('team_name');?></span>
					</div>
					<div class="col-md-6">
						<label for="captain" class="control-label"><span class="text-danger">*</span>Captain</label>
						<select name="captain" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $this->input->post('captain')) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].' - '.$player['employee_id'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('captain');?></span>
					</div>
					<div class="col-md-6">
						<label for="vice_captain" class="control-label"><span class="text-danger">*</span>Vice Captain</label>
						<select name="vice_captain" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $this->input->post('vice_captain')) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].' - '.$player['employee_id'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('vice_captain');?></span>
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