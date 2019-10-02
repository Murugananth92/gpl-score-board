

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tournament Team Edit</h3>
            </div>
			<?php echo form_open('tournament_team/edit/'.$tournament_team['tournament_team_id']); ?>
			<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="tournament_id" class="control-label"><span class="text-danger">*</span>Tournament Id</label>
						<select name="tournament_id" class='form-control'>
						<option value="">select tournament</option>
						<?php 
						foreach($all_tournaments as $tournament)
						{
							$selected = ($tournament['tournament_id'] == $tournament_team['tournament_id']) ? ' selected="selected"' : "";

							echo '<option value="'.$tournament['tournament_id'].'" '.$selected.'>'.$tournament['tournament_name'].'</option>';
						} 
						?>
					</select>
					<span class="text-danger"><?php echo form_error('tournament_id');?></span>
					</div>
					
					<div class="col-md-6">
						<label for="team_id" class="control-label"><span class="text-danger">*</span>Team Name</label>
						<select name="team_id" class='form-control'>
							<option value="">select team</option>
							<?php 
							foreach($all_teams as $team)
							{
								$selected = ($team['team_id'] == $tournament_team['team_id']) ? ' selected="selected"' : "";

								echo '<option value="'.$team['team_id'].'" '.$selected.'>'.$team['team_name'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('team_id');?></span>
					</div>
					<div class="col-md-6">
						<label for="captain" class="control-label"><span class="text-danger">*</span>Captain</label>
						<select name="captain" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $tournament_team['captain']) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].'</option>';
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
								$selected = ($player['player_id'] == $tournament_team['vice_captain']) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].'</option>';
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