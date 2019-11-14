<div class="modal fade" id="modal-selectplayer" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Select Batsmen & Bowler</h4>
			</div>
			<div class="modal-body">
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
					<input type="hidden" name="is_innings_progressing" id="isInningsProgressing" value="<?php echo $is_innings_progressing; ?>">
					<input type="hidden" name="url" id="url" value="<?php echo site_url(); ?>">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="startMatch">Start</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="selectBowlermodal" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Select Bowler</h4>
			</div>
			<div class="modal-body">
				<form role="form" method="post" action='#'>
					<label>Select Bowler</label>
					<select class="form-control" name="new_bowler" id="newBowler">
						<option value="empty">Select Bowler</option>
						<?php foreach ($team2 as $team2_player) { ?>
							<option value="<?php echo $team2_player['player_id']; ?>" data-bowler="<?php echo $team2_player['player_name']; ?>"><?php echo $team2_player['player_name']; ?>
								- <?php echo $team2_player['employee_id']; ?></option>
						<?php } ?>
					</select>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="selectNewBowler">Start</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div id="swap-batsman" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Select Batsman On Strike</h4>
			</div>
			<div class="modal-body">

				<div id="strike-batsman">
					<label>Select Strike Batsman</label>
					<div class="radio">
						<label><input type="radio" name="strikeBatsman" id="strikeBatsman1" value=""><span></span></label>
					</div>
					<div class="radio">
						<label><input type="radio" name="strikeBatsman" id="strikeBatsman2" value=""><span></span></label>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="changeStrike">Confirm</button>
			</div>
		</div>
	</div>
</div>

<div style="display: none">
	<a href="<?php echo site_url('Matches'); ?>" id="matchIndexUrl">TEST</a>
	<a href="<?php echo site_url() . 'Live_score/index/' . $details['match_id'] ?>" id="currentUrl"></a>
</div>

<div class="loader"></div>
<section class="live_match">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header with-border hidden-xs">
					<h3 class="box-title">Live Match</h3>
				</div>
				<form role="form">
					<div class="box-body">
						<table class="table">
							<tr>
								<th><?php echo $details['team_1'] . ' vs ' . $details['team_2']; ?></th>
								<?php if (!empty($played_innings)) { ?>
									<th><?php echo $played_innings[0]['team_name'] ?> : <?php echo $played_innings[0]['runs_scored'] . '/' . $played_innings[0]['wickets_lost'] ?></th>
								<?php } ?>
								<input type='hidden' id='inningId' name='inningId' value="<?php echo isset($match['team_score']['inning_id']) ? $match['team_score']['inning_id'] : 0 ?>">
								<input type='hidden' id='overId' name='overId' value="<?php echo isset($match['team_score']['over_id']) ? $match['team_score']['over_id'] : 0 ?>">
								<input type='hidden' id='ballid' name='ballid' value="<?php echo isset($match['team_score']['ball_id']) ? $match['team_score']['ball_id'] : 0 ?>">
								<input type='hidden' id='ballNumber' name='ballNumber' value="<?php echo isset($match['team_score']['balls']) ? $match['team_score']['balls'] : 0 ?>">
								<input type='hidden' id='overNumber' name='overNumber' value="<?php echo isset($match['team_score']['overs']) ? $match['team_score']['overs'] : 0 ?>">
								<input type='hidden' id='on_strike_batsman' name='on_strike_batsman' value="<?php echo isset($match['on_strike_batsman']) ? $match['on_strike_batsman'] : 0; ?>">
								<input type='hidden' id='current_over_status' name='current_over_status' value="<?php echo isset($match['over']['is_completed']) ? $match['over']['is_completed'] : 0; ?>">
								<input type='hidden' id='total_overs' name='total_overs' value="<?php echo isset($details['match_overs']) ? $details['match_overs'] : 0 ?>">

							</tr>
							<tr>
								<?php foreach ($team_playing as $playing) : ?>
									<th><?php echo $playing; ?> : <span id="totalScore"><?php echo isset($match['team_score']['total_team_score']) ? $match['team_score']['total_team_score'] : '0'; ?> </span>/
										<span id="totalWickets"><?php echo isset($match['team_score']['wickets']) ? $match['team_score']['wickets'] : '0'; ?></span></th>
								<?php endforeach; ?>
								<td>Overs :
									<span id="displayOver"><?php echo isset($match['team_score']['overs']) ? $match['team_score']['overs'] : '0'; ?></span>.
									<span id="displayBalls"><?php echo isset($match['team_score']['balls']) ? $match['team_score']['balls'] : '0'; ?></span>
								</td>
							</tr>
						</table>

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
								<tr class="" id="batsman1_strike">
									<td><span id="batsman1_name"><?php echo isset($match['batsman_record'][0]['player_name']) ? $match['batsman_record'][0]['player_name'] : 'Batsman 1'; ?></span>
									</td>
									<input type='hidden' id="batsman1_id" value="<?php echo isset($match['batsman_record'][0]['batsman']) ? $match['batsman_record'][0]['batsman'] : 0 ?>">
									<td id="batsman1_runs"><?php echo isset($match['batsman_record'][0]['runs']) ? $match['batsman_record'][0]['runs'] : 0 ?></td>
									<td id="batsman1_balls"><?php echo isset($match['batsman_record'][0]['balls']) ? $match['batsman_record'][0]['balls'] : 0 ?></td>
									<td id="batsman1_fours"><?php echo isset($match['batsman_record'][0]['total_4']) ? $match['batsman_record'][0]['total_4'] : 0 ?></td>
									<td id="batsman1_sixes"><?php echo isset($match['batsman_record'][0]['total_6']) ? $match['batsman_record'][0]['total_6'] : 0 ?></td>
								</tr>
								<tr class="" id="batsman2_strike">
									<td><span id="batsman2_name"><?php echo isset($match['batsman_record'][1]['player_name']) ? $match['batsman_record'][1]['player_name'] : 'Batsman 2'; ?></span>
									</td>
									<input type='hidden' id="batsman2_id" value="<?php echo isset($match['batsman_record'][1]['batsman']) ? $match['batsman_record'][1]['batsman'] : 0 ?>">
									<td id="batsman2_runs"><?php echo isset($match['batsman_record'][1]['runs']) ? $match['batsman_record'][1]['runs'] : 0 ?></td>
									<td id="batsman2_balls"><?php echo isset($match['batsman_record'][1]['balls']) ? $match['batsman_record'][1]['balls'] : 0 ?></td>
									<td id="batsman2_fours"><?php echo isset($match['batsman_record'][1]['total_4']) ? $match['batsman_record'][1]['total_4'] : 0 ?></td>
									<td id="batsman2_sixes"><?php echo isset($match['batsman_record'][1]['total_6']) ? $match['batsman_record'][1]['total_6'] : 0 ?></td>
								</tr>
								<tr>
									<th style="width: 500px">Bowler</th>
									<th style="width: 50px">Over</th>
									<th style="width: 50px">Runs</th>
									<th style="width: 50px">Wickets</th>
								</tr>
								<tr>
									<td id="bowler_name"><?php echo isset($match['bowler_record']['player_name']) ? $match['bowler_record']['player_name'] : 'Bowler'; ?></td>
									<input type='hidden' id="bowler_id" value="<?php echo isset($match['bowler_record']['bowler']) ? $match['bowler_record']['bowler'] : 0 ?>">
									<td id="bowled_over"><?php echo isset($match['bowler_record']['over_number']) ? $match['bowler_record']['over_number'] : 0; ?>.
										<?php echo isset($match['bowler_record']['ball_number']) ? $match['bowler_record']['ball_number'] : 0; ?></td>
									<td id="bowler_runs"><?php echo isset($match['bowler_record']['bowler_runs_gave']) ? $match['bowler_record']['bowler_runs_gave'] : 0; ?></td>
									<td id="bowler_wickets"><?php echo isset($match['bowler_record']['bowler_wickets']) ? $match['bowler_record']['bowler_wickets'] : 0; ?></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>

		<section class="this_over">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-body">
						<strong>This Over : </strong>
						<p id="currentOverRuns">
							<?php if (!empty($match['current_over_records'])) {
								foreach ($match['current_over_records'] as $r) {
									echo $r['runs'] . '&nbsp';
								}
							} ?>
						</p>
					</div>
				</div>
			</div>
		</section>

		<section class="extras_field">
			<div class="col-md-12">
				<div class="box box-danger">
					<form role="form">
						<div class="box-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 col-xs-4">
										<div class="radio">
											<label><input type="radio" name="extras" id="wideoption" value="wide">Wide</label>
										</div>
										<div class="radio">
											<label><input type="radio" name="extras" id="noballoption" value="noball">No Ball</label>
										</div>
									</div>
									<div class="col-md-4 col-xs-4">
										<div class="checkbox">
											<label><input type="checkbox" name="byes" id="byes">Byes</label>
										</div>
									</div>
									<div class="col-md-4 col-xs-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="wicket" id="wicket">
												Wicket
											</label>
										</div>
									</div>

									<div class="col-md-12 col-xs-12">
										<div class="box-footer">
											<button class="btn btn-success" id="changeStrikeBatsman">Swap Batsman</button>
										</div>
									</div>
								</div>
							</div>
					</form>
				</div>
			</div>
		</section>


		<div class="modal fade" id="selectBowlermodal" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Select Bowler</h4>
					</div>
					<div class="modal-body">
						<form role="form" method="post" action='#'>
							<label>Select Bowler</label>
							<select class="form-control" name="new_bowler" id="newBowler" required>
								<option value="empty">Select Bowler</option>
								<?php foreach ($team2 as $team2_player) { ?>
									<option value="<?php echo $team2_player['player_id']; ?>" data-bowler="<?php echo $team2_player['player_name']; ?>"><?php echo $team2_player['player_name']; ?>
										- <?php echo $team2_player['employee_id']; ?></option>
								<?php } ?>
							</select>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="selectNewBowler">Start</button>
					</div>
					</form>
				</div>
			</div>
		</div>


		<div id="wicket-options" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Select Wicket Options</h4>
					</div>
					<div class="modal-body">
						<div id="wicket-dropdown">
							<label>Select Wicket Option</label>
							<select class="form-control" id='wicket-type' required>
								<option value="">--Select--</option>
								<option value="Bowled">Bowled</option>
								<option value="Catch Out">Catch Out</option>
								<option value="Run Out">Run Out</option>
								<option value="Stumped">Stumped</option>
								<option value="Hit Wicket">Hit Wicket</option>
								<option value="Ball Handled">Ball Handled</option>
								<option value="Field Obstruction">Field Obstruction</option>
								<option value="Retired">Retired</option>
							</select>
						</div>

						<div id="wicket-involved">
							<label>Select Player Involved</label>
							<select class="form-control" name="wicketInvolved" id="wicketInvolved">
								<option value="">--Select--</option>
								<?php foreach ($team2_all as $team2_player_all) { ?>
									<option value="<?php echo $team2_player_all['player_id']; ?>" data-bowler="<?php echo $team2_player_all['player_name']; ?>"><?php echo $team2_player_all['player_name']; ?>
										- <?php echo $team2_player_all['employee_id']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div id="wicket-involved2">
							<label>Select Player Involved 2</label>
							<select class="form-control" name="wicketInvolved2" id="wicketInvolved2">
								<option value="">--Select--</option>
								<?php foreach ($team2_all as $team2_player_all) { ?>
									<option value="<?php echo $team2_player_all['player_id']; ?>" data-bowler="<?php echo $team2_player_all['player_name']; ?>"><?php echo $team2_player_all['player_name']; ?>
										- <?php echo $team2_player_all['employee_id']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div id="out-batsman">
							<label>Select Out Batsman</label>
							<div class="radio">
								<label><input type="radio" name="outBatsman" id="batsman1-out" value=""><span></span></label>
							</div>
							<div class="radio">
								<label><input type="radio" name="outBatsman" id="batsman2-out" value=""><span></span></label>
							</div>
						</div>

						<div id="new-batsman">
							<label>Select New Batsman</label>
							<select class="form-control" name="newBatsman" id="newBatsman">
								<option value="">--Select--</option>
								<?php foreach ($team1 as $team1_player) { ?>
									<option value="<?php echo $team1_player['player_id']; ?>" data-batsman1="<?php echo $team1_player['player_name']; ?>"><?php echo $team1_player['player_name']; ?>
										- <?php echo $team1_player['employee_id']; ?></option>
								<?php } ?>
							</select>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Proceed</button>
					</div>
				</div>
			</div>
		</div>

		<div id="swap-batsman" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Select Batsman On Strike</h4>
					</div>
					<div class="modal-body">

						<div id="strike-batsman">
							<label>Select Out Batsman</label>
							<div class="radio">
								<label><input type="radio" name="strikeBatsman" id="strikeBatsman1" value=""><</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="strikeBatsman" id="strikeBatsman2" value=""></label>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Confirm</button>
					</div>
				</div>
			</div>
		</div>

		<div id="othersModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Select Other Options</h4>
					</div>
					<div class="modal-body">
						<div id="end-radio">
							<label>Select Other Options</label>
							<div class="radio">
								<label><input type="radio" name="endoptions" id="endinnings" value="endinnings">End Innings</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="endoptions" id="endmatch" value="endmatch">End Match</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="endoptions" id="reschedulematch" value="reschedulematch">Reschedule Match</label>
							</div>
						</div>

						<div id="team-won">
							<label>Select Team Won</label>
							<select class="form-control" name="teamWon" id="teamWon">
								<option value="">--Select--</option>
								<option value="<?php echo $details['teamid_1']; ?>"><?php echo $details['team_1']; ?></option>
								<option value="<?php echo $details['teamid_2']; ?>"><?php echo $details['team_2']; ?></option>
							</select>
						</div>

						<div id="end-comments">
							<label>Comments</label>
							<textarea class="form-control" rows="4" cols="50" id="matchCommentsField">
							
							</textarea>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" id="out-submit" class="btn btn-default" data-dismiss="modal">Confirm</button>
					</div>
				</div>
			</div>
		</div>

		<section class="runs_scored">
			<div class="col-md-12">
				<div class="box box-info">
					<form role="form">
						<div class="box-body">
							<div class="radio run_button">
								<input type="radio" id="runs0" class="runs" name="runs" value="0">
								<label for="runs0">0</label>
								<input type="radio" id="runs1" class="runs" name="runs" value="1">
								<label for="runs1">1</label>
								<input type="radio" id="runs2" class="runs" name="runs" value="2">
								<label for="runs2">2</label>
								<input type="radio" id="runs3" class="runs" name="runs" value="3">
								<label for="runs3">3</label>
								<input type="radio" id="runs4" class="runs" name="runs" value="4">
								<label for="runs4">4</label>
								<input type="radio" id="runs5" class="runs" name="runs" value="5">
								<label for="runs5">5</label>
								<input type="radio" id="runs6" class="runs" name="runs" value="6">
								<label for="runs6">6</label>
								<input type="radio" id="runs7" class="runs" name="runs" value="7">
								<label for="runs7">7</label>
								<input type="radio" id="runs8" class="runs" name="runs" value="8">
								<label for="runs8">8</label>
							</div>
							<button class="btn btn-info" id="othersOption">Others</button>
							<button class="btn btn-info" id="undoRecord">Undo</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
</section>

<script src="<?php echo site_url('resources/js/live_score.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/live_score2.js'); ?>"></script>
<style>
	.highlight {
		color: green;
		font-weight: bold;
	}
</style>
<script>
	$(document).ready(function ()
	{
		LiveScore.init();
		LiveScore2.init();

		$('#batsman1').on('change', function ()
		{
			var batsman1 = $(this).val();
			$("#batsman2 option").attr('disabled', 'disabled')
				.siblings().removeAttr('disabled');
			$("#batsman2 option[value='" + batsman1 + "']").attr('disabled', true);
		});

		$('#batsman2').on('change', function ()
		{
			var batsman2 = $(this).val();
			$("#batsman1 option").attr('disabled', 'disabled')
				.siblings().removeAttr('disabled');
			$("#batsman1 option[value='" + batsman2 + "']").attr('disabled', true);
		});

		var res = {
			loader: $('<div />', {class: 'loading-bar'}),
			container: $('.live_match')
		}


	});
</script>



