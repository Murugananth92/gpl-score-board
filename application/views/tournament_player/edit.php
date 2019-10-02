<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tournament Player Edit</h3>
            </div>
			<?php echo form_open('tournament_player/edit/'.$tournament_player['tournament_players_id']); ?>
			<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="tournament_team_id" class="control-label"><span class="text-danger">*</span>Tournament Team Name</label>
						<select name="tournament_team_id" class='form-control'>
							<option value="">select tournament_team</option>
							<?php 
							foreach($all_tournament_teams as $tournament_team)
							{
								$selected = ($tournament_team['tournament_team_id'] == $tournament_player['tournament_team_id']) ? ' selected="selected"' : "";

								echo '<option value="'.$tournament_team['tournament_team_id'].'" '.$selected.'>'.$tournament_team['team_name'].'</option>';
							} 
							?>
						</select>
					<span class="text-danger"><?php echo form_error('tournament_id');?></span>
					</div>
					<div class="col-md-6">
						<label for="player_id" class="control-label"><span class="text-danger">*</span>Player Id</label>
						<select name="player_id" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $tournament_player['player_id']) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].'</option>';
							} 
							?>
						</select>
					<span class="text-danger"><?php echo form_error('player_id');?></span>
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