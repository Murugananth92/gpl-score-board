<?php print_r($params);?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Select Players</h3>
			</div>
			<form role="form" method="post" action="<?= base_url('start_match/add_squad');?>" id="playins_elevens">
				<div class="box-body">
					<?php $i = 1; foreach ($players as $key => $value) { ?>
						<div class="col-xs-6">
							<table class="table table-striped">
								<thead>
								<tr>
									<th style="width:75%"><?php echo $key; ?></th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<th>Players - Employee ID</th>
									<th>Selected</th>
								</tr>
								<?php foreach ($value as $player) { ?>
									<tr>
										<td> <?php echo $player['player_name'].' - '.$player['employee_id']; ?> </td>
										<td>
											<input type="checkbox" name="players[]" class="team_<?php echo $i;?>" checked value="<?php echo $player['player_id']; ?>">
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>

					<?php $i++; } ?>
					<input type='hidden' name="matches" value="<?php echo $params['matches']?>">
					<input type='hidden' name="teamid_1"  value="<?php echo $params['teamid_1']?>">
					<input type='hidden' name="teamid_2"  value="<?php echo $params['teamid_2']?>">
				</div>
				</form>
				<form role="form" method="post" action="<?= base_url() ?>start_match">
				<input type='hidden' name="matches" value="<?php echo $params['matches']?>">
				<input type='hidden' name="team1"  value="<?php echo $params['team1']?>">
				<input type='hidden' name="team2"  value="<?php echo $params['team2']?>">
				<input type='hidden' name="teamid_1"  value="<?php echo $params['teamid_1']?>">
				<input type='hidden' name="teamid_2"  value="<?php echo $params['teamid_2']?>">
				<input type='hidden' name="match_date" value="<?php echo $params['match_date']?>">
				<input type='hidden' name="match_venue"  value="<?php echo $params['match_venue']?>">
				<input type='hidden' name="team1_toss" value="<?php echo $params['team1_toss']?>">
				<input type='hidden' name="toss_options" value="<?php echo $params['toss_options']?>">
				<input type='hidden' name="overs"  value="<?php echo $params['overs']?>">					
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Previous</button>
					<button type="button" class="btn btn-primary pull-right" id="startMatch">Start Match</button>
				</div>
				</form>
		</div>
	</div>
</div>
