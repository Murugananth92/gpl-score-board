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
								<th><?php echo $team1_name . ' vs ' . $team2_name; ?></th>
								<td>First Innining</td>
								<input type='hidden' id='inningId' name='inningId' value="<?php echo isset($team_score['inning_id']) ? $team_score['inning_id'] : 0 ?>">
								<input type='hidden' id='overId' name='overId' value="<?php echo isset($team_score['over_id']) ? $team_score['over_id'] : 0 ?>">
								<input type='hidden' id='ballid' name='ballid' value="<?php echo isset($team_score['ball_id']) ? $team_score['ball_id'] : 0 ?>">
								<input type='hidden' id='ballNumber' name='ballNumber' value="<?php echo isset($team_score['balls']) ? $team_score['balls'] : 0 ?>">
								<input type='hidden' id='overNumber' name='overNumber' value="<?php echo isset($team_score['overs']) ? $team_score['overs'] : 0 ?>">
								<input type='hidden' id='on_strike_batsman' name='on_strike_batsman' value="<?php echo isset($on_strike_batsman) ? $on_strike_batsman : 0; ?>">

							</tr>
							<tr>
								<?php foreach ($team_playing as $playing) : ?>
									<th><?php echo $playing; ?> : <span id="totalScore"><?php echo isset($team_score['total_team_score']) ? $team_score['total_team_score'] : '0'; ?> </span>/
										<span id="totalWickets"><?php echo isset($team_score['wickets']) ? $team_score['wickets'] : '0'; ?></span></th>
								<?php endforeach; ?>
								<td>Overs :
									<span id="displayOver"><?php echo isset($team_score['overs']) ? $team_score['overs'] : '0'; ?></span>.<span id="displayBalls"><?php echo isset($team_score['balls']) ? $team_score['balls'] : '0'; ?></span>
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
								<tr>
									<td id="batsman1_highlight"><span id="batsman1_name"><?php echo isset($batsman_record[0]['player_name']) ? $batsman_record[0]['player_name'] : 'Batsman 1'; ?></span><span id="batsman1_onstrike"></span>
									</td>
									<input type='hidden' id="batsman1_id" value="<?php echo isset($batsman_record[0]['batsman']) ? $batsman_record[0]['batsman'] : 0 ?>">
									<td id="batsman1_runs"><?php echo isset($batsman_record[0]['runs']) ? $batsman_record[0]['runs'] : 0 ?></td>
									<td id="batsman1_balls"><?php echo isset($batsman_record[0]['balls']) ? $batsman_record[0]['balls'] : 0 ?></td>
									<td id="batsman1_fours"><?php echo isset($batsman_record[0]['total_4']) ? $batsman_record[0]['total_4'] : 0 ?></td>
									<td id="batsman1_sixes"><?php echo isset($batsman_record[0]['total_6']) ? $batsman_record[0]['total_6'] : 0 ?></td>
								</tr>
								<tr>
									<td id="batsman2_highlight"><span id="batsman2_name"><?php echo isset($batsman_record[1]['player_name']) ? $batsman_record[1]['player_name'] : 'Batsman 2'; ?></span><span id="batsman2_onstrike"></span>
									</td>
									<input type='hidden' id="batsman2_id" value="<?php echo isset($batsman_record[1]['batsman']) ? $batsman_record[1]['batsman'] : 0 ?>">
									<td id="batsman2_runs"><?php echo isset($batsman_record[1]['runs']) ? $batsman_record[1]['runs'] : 0 ?></td>
									<td id="batsman2_balls"><?php echo isset($batsman_record[1]['balls']) ? $batsman_record[1]['balls'] : 0 ?></td>
									<td id="batsman2_fours"><?php echo isset($batsman_record[1]['total_4']) ? $batsman_record[1]['total_4'] : 0 ?></td>
									<td id="batsman2_sixes"><?php echo isset($batsman_record[1]['total_6']) ? $batsman_record[1]['total_6'] : 0 ?></td>
								</tr>
								<tr>
									<th style="width: 500px">Bowler</th>
									<th style="width: 50px">Over</th>
									<th style="width: 50px">Runs</th>
									<th style="width: 50px">Wickets</th>
								</tr>
								<tr>
									<td id="bowler_name"><?php echo isset($bowler_record['player_name']) ? $bowler_record['player_name'] : 'Bowler'; ?></td>
									<input type='hidden' id="bowler_id" value="<?php echo isset($bowler_record['bowler']) ? $bowler_record['bowler'] : 0 ?>">
									<td id="bowled_over"><?php echo isset($bowler_record['over_number']) ? $bowler_record['over_number'] : 0; ?>.
										<?php echo isset($bowler_record['ball_number']) ? $bowler_record['ball_number'] : 0; ?></td>
									<td id="bowler_runs"><?php echo isset($bowler_record['bowler_runs_gave']) ? $bowler_record['bowler_runs_gave'] : 0; ?></td>
									<td id="bowler_wickets"><?php echo isset($bowler_record['bowler_wickets']) ? $bowler_record['bowler_wickets'] : 0; ?></td>
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
					<form role="form">
						<div class="box-body">
							<h4><b>This Over: </b><span id="currentOverRuns"><?php if (!empty($current_over_records)) {
										foreach ($current_over_records as $r) {
											echo $r['runs'] . '&nbsp';
										}
									} ?> </span></h4>
						</div>
					</form>
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
											<button class="btn btn-success">Retire</button>
											<button class="btn btn-success">Swap Batsman</button>
										</div>
									</div>
								</div>
							</div>
					</form>
				</div>
			</div>
		</section>

		<section id='wicket-options'>
			<div class="col-md-12">
				<div class="box box-secondary">
					<div class="box-body">
						<div id="wicket-dropdown">
							<label>Select Wicket Option</label>
							<select class="form-control" id='wicket-type'>
								<option value="">--Select--</option>
								<option value="bowled">Bowled</option>
								<option value="catchout">Catch Out</option>
								<option value="runout">Run Out</option>
								<option value="stumped">Stumped</option>
								<option value="hitwicket">Hit Wicket</option>
								<option value="ballhandled">Ball Handled</option>
								<option value="fieldobstruction">Field Obstruction</option>
							</select>
						</div>

						<div id="wicket-involved">
							<label>Select Player Involved</label>
							<select class="form-control" name="wicketInvolved" id="wicketInvolved">
								<option value="">--Select--</option>
								<?php foreach (team2_all as $team2_player_all) { ?>
									<option value="<?php echo $team2_player_all['player_id']; ?>" data-bowler="<?php echo $team2_player_all['player_name']; ?>"><?php echo $team2_player_all['player_name']; ?>
										- <?php echo $team2_player_all['employee_id']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div id="wicket-involved2">
							<label>Select Player Involved 2</label>
							<select class="form-control" name="wicketInvolved2" id="wicketInvolved2">
								<option value="">--Select--</option>
								<?php foreach (team2_all as $team2_player_all) { ?>
									<option value="<?php echo $team2_player_all['player_id']; ?>" data-bowler="<?php echo $team2_player_all['player_name']; ?>"><?php echo $team2_player_all['player_name']; ?>
										- <?php echo $team2_player_all['employee_id']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div id="out-batsman">
							<label>Select Out Batsman</label>
							<div class="radio">
								<label><input type="radio" name="outBatsman" id="batsman1-out" value=1><?php echo isset($match_details['strike_batsman']) ? $match_details['strike_batsman'] : 'Batsman 1'; ?></label>
							</div>
							<div class="radio">
								<label><input type="radio" name="outBatsman" id="batsman2-out" value=2><?php echo isset($match_details['batsman']) ? $match_details['batsman'] : 'Batsman 2'; ?></label>
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
				</div>
			</div>
		</section>

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
							</div>
							<button class="btn btn-info">Others</button>
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

		$('#wicket-involved').hide();
		$('#wicket-involved2').hide();
		var selectedWicket = '';

		$('input[name=wicket]').on('click init-post-format', function ()
		{
			$('#wicket-options').toggle($('#wicket').prop('checked'));
		}).trigger('init-post-format');

		$('#wicket-dropdown').change(function ()
		{
			var selectedWicket = $('#wicket-dropdown option:selected').val();
			if (selectedWicket == 'catchout' || selectedWicket == 'stumped') {
				$('#wicket-involved').show();
				$('#wicket-involved2').hide();
			}
			else if (selectedWicket == 'runout') {
				$('#wicket-involved').show();
				$('#wicket-involved2').show();
			}
			else {
				$('#wicket-involved').hide();
				$('#wicket-involved2').hide();
			}
		});

		var res = {
			loader: $('<div />', {class: 'loading-bar'}),
			container: $('.live_match')
		}

		$('#undoRecord').on('click', function (e)
		{
			e.preventDefault();
			var ballid = $('#ballid').val();
			$.ajax({
				url: url + 'Live_score/undoBall',
				type: "POST",
				data: {ballid: ballid},
				async: false,
				beforeSend: function ()
				{
					// $('.spinner-load').show();
					// res.container.append(res.loader);
				},
				success: function (data)
				{
					$('#undoRecord').prop('disabled', true);
					// $('.spinner-load').hide();
				}
			});

		});
	});
</script>



