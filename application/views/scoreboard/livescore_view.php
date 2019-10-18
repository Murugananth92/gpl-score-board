<div class="modal fade" id="modal-selectplayer" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Select Batsmen & Bowler</h4>
			</div>
			<div class="modal-body">
				<!--<form role="form" method="post" action='--><? //= base_url()?><!--live_score/updateBatBowl'>-->
				<form role="form" method="post" action='#'>

					<label>Select Striker</label>
					<select class="form-control" name="batsman1" id="batsman1">
						<option value="empty">Select Striker</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option value="<?php echo $team1_player['player_id']; ?>" data-batsman1="<?php echo $team1_player['player_name']; ?>"><?php echo $team1_player['player_name']; ?>
								- <?php echo $team1_player['employee_id']; ?></option>
						<?php } ?>
					</select>
					<label>Select Non Striker</label>
					<select class="form-control" name="batsman2" id="batsman2">
						<option value="empty">Select Non Striker</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option value="<?php echo $team1_player['player_id']; ?>" data-batsman2="<?php echo $team1_player['player_name']; ?>"><?php echo $team1_player['player_name']; ?>
								- <?php echo $team1_player['employee_id']; ?></option>
						<?php } ?>
					</select>
					<label>Select Bowler</label>
					<select class="form-control" name="bowler" id="bowler">
						<option value="empty">Select Bowler</option>
						<?php foreach ($team2 as $team2_player) { ?>
							<option value="<?php echo $team2_player['player_id']; ?>" data-bowler="<?php echo $team2_player['player_name']; ?>"><?php echo $team2_player['player_name']; ?>
								- <?php echo $team2_player['employee_id']; ?></option>
						<?php } ?>
					</select>
					<inpu type="hidden" name="is_innings_progressing" id="isInningsProgressing" value="<?php echo $is_innings_progressing; ?>">
						<inpu type="hidden" name="url" id="url" value="<?php echo site_url(); ?>">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="startMatch">Start</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Live Match</h3>
			</div>
			<form role="form">
				<div class="box-body">
					<table class="table">
						<tr>
							<th><?php echo $team1_name . ' vs ' . $team2_name; ?></th>
							<td>First Innining</td>
						</tr>
						<tr>
							<?php foreach ($team_playing as $playing) : ?>
								<th><?php echo $playing; ?> : <?php echo isset($match_details['runs']) ? $match_details['runs'] : '0'; ?>/
									<?php echo isset($match_details['wickets']) ? $match_details['wickets'] : '0'; ?></th>
							<?php endforeach; ?>
							<td>Overs : <span><?php echo isset($match_details['over']) ? $match_details['over'] : '0'; ?>.<?php echo isset($match_details['ball']) ? $match_details['ball'] : '0'; ?></td>
						</tr>
					</table>


					<div class="box-header">
					</div>
					<div class="box-body no-padding">
						<table class="table table-striped">
							<tbody>
							<tr>
								<th style="width: 500px">Batsman</th>
								<th style="width: 50px">Runs</th>
								<th style="width: 50px">Balls</th>
								<th style="width: 50px">4s</th>
								<th style="width: 50px">6s</th>
							</tr>
							<tr>
								<td id="batsman1_name"><?php echo isset($match_details['strike_batsman']) ? $match_details['strike_batsman'] : 'Batsman 1'; ?></td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<td id="batsman2_name"><?php echo isset($match_details['batsman']) ? $match_details['batsman'] : 'Batsman 2'; ?></td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<th style="width: 500px">Bowler</th>
								<th style="width: 50px">Over</th>
								<th style="width: 50px">Runs</th>
								<th style="width: 50px">Wickets</th>
							</tr>
							<tr>
								<td id="bowler_name"><?php echo isset($match_details['bowler']) ? $match_details['bowler'] : 'Bowler'; ?></td>
								<td>0.0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-warning">
			<form role="form">
				<div class="box-body">
					<h4><b>This
							Over: </b><span class="1">1</span>&nbsp;<span class="2">2</span>&nbsp;<span class="3">3</span>&nbsp;<span class="4">4</span>&nbsp;<span class="5">5</span>&nbsp;<span class="6">6</span>&nbsp;<span class="7"></span>&nbsp;<span class="8"></span>
					</h4>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-danger">
			<form role="form">
				<div class="box-body">
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Wide
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								No Ball
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Byes
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Leg Byes
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Wicket
							</label>
						</div>
					</div>
					<div class="box-footer">
						<button class="btn btn-success">Retire</button>
						<button class="btn btn-success">Swap Batsman</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2">
		<div class="box box-info">
			<form role="form">
				<div class="box-body">
					<div class="form-group">
						<button class="btn btn-info form-control">Undo</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<div class="box box-info">
			<form role="form">
				<div class="box-body">
					<div class="radio">
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
							0
						</label>

						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
							1
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							2
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							3
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							4
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							5
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							6
						</label>
					</div>
					<button class="btn btn-info">Others</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo site_url('resources/js/live_score.js'); ?>"></script>

<script>
	$(document).ready(function ()
	{
		LiveScore.init();
	});
</script>



