<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tournament Player Add</h3>
            </div>
            <?php echo form_open('tournament_player/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="tournament_team_name" class="control-label"><span class="text-danger">*</span>Tournament Team Name</label>
						<select name="tournament_team_name" class='form-control'>
							<option value="">select tournament_team</option>
							<?php 
							foreach($all_tournament_teams as $tournament_team)
							{
								$selected = ($tournament_team['team_id'] == $this->input->post('team_id')) ? ' selected="selected"' : "";

								echo '<option value="'.$tournament_team['team_id'].'" '.$selected.'>'.$tournament_team['team_name'].'</option>';
							} 
							?>
						</select>
					<span class="text-danger"><?php echo form_error('tournament_team_name');?></span>
					</div>
					<div class="col-md-6">
						<label for="player_name" class="control-label"><span class="text-danger">*</span>Player Id</label>
						<select name="player_name" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $this->input->post('player_id')) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.ucfirst($player['player_name']).' - '.$player['employee_id'].'</option>';
							} 
							?>
						</select>
					<span class="text-danger"><?php echo form_error('player_name');?></span>
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

