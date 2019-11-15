<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="refresh" content="5">
	<title>GPL - Livew Score</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('resources/css/live-score.css');?>">
</head>
<body>
<div class="logo"><img src="<?php echo site_url('resources/img/gpl-logo.png'); ?>" alt="GPL"></div>
<div class="container">



	<?php if($match && !empty($batsman_record)){ ?>
	<div class="row mt25">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
                <span class="panel-title" id="team1">
                <?php echo $details['team_1'];?>
				</span>
					Vs
					<span class="panel-title" id="team2">
                <?php echo $details['team_2'];?>
					</span>
					<span class="first-innings"><?php if(!empty($played_innings)){
							echo $played_innings['0']['team_name']. " : ".$played_innings['0']['runs_scored']." / ".$played_innings['0']['wickets_lost'];
						}?></span>
					<button class="refresh-btn">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path d="M9 13.5c-2.49 0-4.5-2.01-4.5-4.5S6.51 4.5 9 4.5c1.24 0 2.36.52 3.17 1.33L10 8h5V3l-1.76 1.76C12.15 3.68 10.66 3 9 3 5.69 3 3.01 5.69 3.01 9S5.69 15 9 15c2.97 0 5.43-2.16 5.9-5h-1.52c-.46 2-2.24 3.5-4.38 3.5z"/></svg>
					</button>
				</div>

				<div class="panel-body">
				<div class="score-card">
						<div class="team-score"><?php echo $playing_team['batting_team']['team_name']; ?> : <?php echo $team_score['total_team_score']; ?> / <?php echo $team_score['wickets']; ?></div>
						<div class="team-overs">Overs : <?php echo $team_score["overs"];?>.<?php echo $team_score["balls"];?></div>
					</div>
					<table class="table table-striped borderless">
						<tbody>
						<tr>
							<th width="40%">Batsman</th>
							<th width="15%">Runs</th>
							<th width="15%">Balls</th>
							<th width="15%">4s</th>
							<th width="15%">6s</th>
						</tr>
						</tr>
						<?php foreach($batsman_record as $record){ ?>
							<tr class="<?php echo ($record['batsman'] === $on_strike_batsman)?"on-strike-batsman":""; ?>">
								<td><span ><?php echo $record['player_name']; ?></td>
								<td><?php echo ($record['runs'])?$record['runs']:'0'; ?></td>
								<td><?php echo ($record['balls'])?$record['balls']:'0'; ?></td>
								<td><?php echo ($record['total_4'])?$record['total_4']:'0'; ?></td>
								<td><?php echo ($record['total_6'])?$record['total_6']:'0'; ?></td>
							</tr>
						<?php  }?>
						<tr>
						<tr>
							<th>Bowler</th>
							<th>Over</th>
							<th>Runs</th>
							<th>Wickets</th>
							<th></th>
						</tr>
						<tr>
							<td><?php echo $bowler_record['player_name'];?></td>
							<td><?php echo $bowler_record['over_number'].'.'.$bowler_record['ball_number']; ?></td>
							<td><?php echo $bowler_record['bowler_runs_gave']; ?></td>
							<td><?php echo $bowler_record['bowler_wickets']; ?></td>
							<td></td>
						</tr>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
	<div class="mt25 ball-by-ball">
		<div class="col-md-2">Current over records : </div>
		<div class="col-md-10">
			<?php if(!empty($current_over_records)){
				foreach ($current_over_records as $record){ ?>
					<span><?php echo $record['runs']?></span>
				<?php }
			}?>
		</div>
	</div>
	<?php } else { ?>
		<h1 class="text-center">Match Not Started Yet</h1>
	<?php } ?>
</div>

<script src="<?php echo site_url('resources/js/jquery.min.js');?>"></script>
<script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
<script>
	$('document').ready(function () {
		$('.refresh-btn').click(function () {
			location.reload();
		});
	});
</script>
</body>
</html>
