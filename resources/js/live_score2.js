var LiveScore2 = function ()
{
	var batsman1;
	var batsman2;
	var batsman1id;
	var batsman2id;
	var ballnumber;
	var onstrike;
	var onstrikeid;
	var url;
	var loader;

	/* Fields*/
	var batsmanId1Field;
	var batsmanId2Field;
	var onStrikeField;

	var batsman1NameField;
	var batsman1Runs;
	var batsman1balls;
	var batsman1Fours;
	var batsman1Sixes;

	var batsman2NameField;
	var batsman2Runs;
	var batsman2balls;
	var batsman2Fours;
	var batsman2Sixes;

	var bowlerIdField;
	var bowlerName;
	var bowledOver;
	var bowlerRuns;
	var bowlerWickets;

	var currentOverRuns;

	var ballNumberField;
	var inningIdField;
	var overIdField;
	var ballidField;
	var overNumberField;

	var totalScore;
	var totalWickets;
	var displayOver;
	var displayBalls;

	var totalOvers;
	var currentOverStatus;

	/* END */

	var newBowlerModal;
	var swapBatsmanModal;
	var WicketModal;
	var othersModal;

	/*Other action fields*/
	var teamWon;
	var matchComments;

	/* END */

	function init()
	{
		url = $('#url').val();
		newBowlerModal = $('#selectBowlermodal');
		WicketModal = $('#wicket-options');
		swapBatsmanModal = $('#swap-batsman');
		othersModal = $('#othersModal');
		scoreRuns();
		undoFunction();
		loader = $('.loader');

		// Highlight batsman 1 by default
		// $('#batsman1_highlight').css('font-weight', 'bold');

		batsmanId1Field = $('#batsman1_id');
		batsmanId2Field = $('#batsman2_id');
		onStrikeField = $('#on_strike_batsman');

		batsman1NameField = $('#batsman1_name');
		batsman1Runs = $('#batsman1_runs');
		batsman1balls = $('#batsman1_balls');
		batsman1Fours = $('#batsman1_fours');
		batsman1Sixes = $('#batsman1_sixes');

		batsman2NameField = $('#batsman2_name');
		batsman2Runs = $('#batsman2_runs');
		batsman2balls = $('#batsman2_balls');
		batsman2Fours = $('#batsman2_fours');
		batsman2Sixes = $('#batsman2_sixes');

		bowlerIdField = $('#bowler_id');
		bowlerName = $('#bowler_name');
		bowledOver = $('#bowled_over');
		bowlerRuns = $('#bowler_runs');
		bowlerWickets = $('#bowler_wickets');

		ballNumberField = $('#ballNumber');
		inningIdField = $('#inningId');
		overIdField = $('#overId');
		ballidField = $('#ballid');
		overNumberField = $('#overNumber');

		totalScore = $('#totalScore');
		totalWickets = $('#totalWickets');
		displayOver = $('#displayOver');
		displayBalls = $('#displayBalls');
		currentOverRuns = $('#currentOverRuns');
		currentOverStatus = $('#current_over_status');
		totalOvers = $('#total_overs');

		teamWon = $('#team-won');
		matchComments = $('#end-comments');

		highlightStrike();
		checkWicket();
		swapBatsman();
		verifyOverStatus();
		othersFunction();
	}

	function load()
	{
		loader.show();
	}

	function unLoad()
	{
		loader.hide();
	}

	function scoreRuns()
	{
		$('.runs').click(function ()
		{
			setOutBatsman();

			if ($("#wicket-type").val() == '' && $("#wicket").prop("checked") == true) {

				WicketModal.modal({backdrop: 'static', keyboard: false, show: true});

			}
			else {
				batsman1 = $('#batsman1_name').html();
				batsman2 = $('#batsman2_name').html();
				batsman1id = $('#batsman1_id').val();
				batsman2id = $('#batsman2_id').val();
				ballnumber = $('#ballNumber').val();
				onstrike = batsman1;
				onstrikeid = $('#on_strike_batsman').val();

				if (checkStrikeBatsman() === false) {
					return false;
				}

				var runs = $("input[name='runs']:checked").val();
				var extras = $("input[name='extras']:checked").val();
				var is_extras = $('input[name="extras"]').is(':checked') ? true : false;
				var is_byes = $('input[name="byes"]').is(':checked') ? true : false;
				var is_wicket = $('input[name="wicket"]').is(':checked') ? true : false;
				var how_out = $('#wicket-type').val();
				var wicketInvolved = $('#wicketInvolved').val();
				var wicketInvolved2 = $('#wicketInvolved2').val();
				var outBatsman = $("input[name='outBatsman']:checked").val();
				var newBatsman = $('#newBatsman').val();
				var inning_id = $('#inningId').val();
				var perball = {};

				perball['inning_id'] = inning_id;
				perball['runs_scored'] = parseInt(runs);
				perball['byes'] = 0;
				perball['noball'] = 0;
				perball['runout'] = 0;
				perball['wicket'] = 0;
				perball['wide'] = 0;
				perball['wicket_assist1'] = 0;
				perball['wicket_assist2'] = 0;

				if (!is_extras && !is_wicket) {
					if (is_byes) {
						perball['byes'] = parseInt(runs);
						ballnumber++;
					}
					else {
						perball['runs_scored'] = parseInt(runs);
						ballnumber++;
					}
				}
				else if (is_extras) {
					if (extras == 'wide') {
						perball['wide'] = 1;
						if (runs > 0) {
							perball['byes'] = parseInt(runs);
						}
						if (is_wicket) {
							perball['wicket_type'] = how_out;
							if (how_out === 'Run Out') {
								perball['runout'] = 1;
								if (wicketInvolved != '') {
									perball['wicket_assist1'] = wicketInvolved;
								}
								if (!wicketInvolved2 == '') {
									perball['wicket_assist2'] = wicketInvolved2;
								}
								perball['out_batsman'] = outBatsman;
								perball['new_batsman'] = newBatsman;
							}
							else if (how_out === 'Catch Out' || how_out === 'Stumped') {
								perball['wicket'] = 1;
								perball['wicket_assist1'] = wicketInvolved;
								perball['out_batsman'] = outBatsman;
								perball['new_batsman'] = newBatsman;
								if (wicketInvolved != '') {
									perball['wicket_assist1'] = wicketInvolved;
								}
							}
							else {
								perball['wicket'] = 1;
								perball['out_batsman'] = outBatsman;
								perball['new_batsman'] = newBatsman;
								if (wicketInvolved != '') {
									perball['wicket_assist1'] = wicketInvolved;
								}
								if (!wicketInvolved2 == '') {
									perball['wicket_assist2'] = wicketInvolved2;
								}
							}
						}
					}
					else {
						perball['noball'] = 1;
						if (is_byes) {
							perball['byes'] = parseInt(runs);
						}
						else {
							perball['runs_scored'] = parseInt(runs);
						}
						if (is_wicket) {
							perball['wicket_type'] = how_out;
							if (how_out === 'Run Out') {
								perball['runout'] = 1;
								if (wicketInvolved != '') {
									perball['wicket_assist1'] = wicketInvolved;
								}
								if (!wicketInvolved2 == '') {
									perball['wicket_assist2'] = wicketInvolved2;
								}
								perball['out_batsman'] = outBatsman;
								perball['new_batsman'] = newBatsman;
							}
							else if (how_out === 'Catch Out' || how_out === 'Stumped') {
								perball['wicket'] = 1;
								perball['wicket_assist1'] = wicketInvolved;
								perball['out_batsman'] = outBatsman;
								perball['new_batsman'] = newBatsman;
								if (wicketInvolved != '') {
									perball['wicket_assist1'] = wicketInvolved;
								}
							}
							else {
								perball['wicket'] = 1;
								perball['out_batsman'] = outBatsman;
								perball['new_batsman'] = newBatsman;
								if (wicketInvolved != '') {
									perball['wicket_assist1'] = wicketInvolved;
								}
								if (!wicketInvolved2 == '') {
									perball['wicket_assist2'] = wicketInvolved2;
								}
							}
						}
					}
				}
				else {
					perball['runs_scored'] = parseInt(runs);
					perball['wicket_type'] = how_out;
					if (how_out === 'Run Out') {
						perball['runout'] = 1;

						if (wicketInvolved != '') {
							perball['wicket_assist1'] = wicketInvolved;
						}
						if (!wicketInvolved2 == '') {
							perball['wicket_assist2'] = wicketInvolved2;
						}
						perball['out_batsman'] = outBatsman;
						perball['new_batsman'] = newBatsman;
					}
					else if (how_out === 'Catch Out' || how_out === 'Stumped') {
						perball['wicket'] = 1;
						perball['wicket_assist1'] = wicketInvolved;
						perball['out_batsman'] = outBatsman;
						perball['new_batsman'] = newBatsman;
						if (wicketInvolved != '') {
							perball['wicket_assist1'] = wicketInvolved;
						}
					}
					else {
						perball['wicket'] = 1;
						perball['out_batsman'] = outBatsman;
						perball['new_batsman'] = newBatsman;
						if (wicketInvolved != '') {
							perball['wicket_assist1'] = wicketInvolved;
						}
						if (!wicketInvolved2 == '') {
							perball['wicket_assist2'] = wicketInvolved2;
						}
					}
					ballnumber++;
				}

				perball['ballnumber'] = ballnumber;
				perball['onstrike'] = onstrike;
				perball['onstrikeid'] = onstrikeid;

				var bowler = $('#bowler_id').val();
				perball['bowler'] = bowler;
				perball['batsman1'] = batsman1id;
				perball['batsman2'] = batsman2id;
				// Function to insert Ball records
				insertBallRecords(perball);
				// Reset to default
				resetDefault();
			}
		});
	}

	function resetDefault()
	{
		$('input[type="radio"]').prop('checked', false);
		$('input[type="checkbox"]').prop('checked', false);
		$('#wicket-type').prop('selectedIndex', 0);
		$('#wicketInvolved').prop('selectedIndex', 0);
		$('#wicketInvolved2').prop('selectedIndex', 0);
		$('#newBatsman').prop('selectedIndex', 0);
		$('#WicketModal').modal('hide');
	}

	function highlightStrike()
	{
		$('#batsman1_strike,#batsman2_strike').removeClass('highlight');

		if (onStrikeField.val() === batsmanId1Field.val() && parseInt(batsmanId1Field.val()) !== 0) {
			$('#batsman1_strike').addClass('highlight')
		}

		if (onStrikeField.val() === batsmanId2Field.val() && parseInt(batsmanId2Field.val()) !== 0) {
			$('#batsman2_strike').addClass('highlight')
		}
	}

	function insertBallRecords(perball)
	{
		try {
			// temp value for over_id and batsman_id
			perball['over_id'] = $('#overId	').val();
			var ballid = $('#ballid');

			$.ajax({
				url: url + 'Live_score/insertBallRecords',
				type: "POST",
				data: perball,
				beforeSend: function ()
				{
					load();
				},
				success: function (data)
				{
					unLoad();
					var response = JSON.parse(data);
					updateScoreData(response);
					checkStrikeBatsman();
					verifyOverStatus();
					highlightStrike();
				},
				error: function (error)
				{
					unLoad();
					Swal.fire({
						icon: 'error',
						html:
							'Status : ' + error.status +
							'<br> Error :' + error.statusText,
						showCloseButton: true
					});
				}
			});
		} catch (err) {
			Swal.fire({
				icon: 'error',
				text: err.message,
				showCloseButton: true
			});
		}

	}

	function updateScoreData(res)
	{
		batsmanId1Field.val(res.batsman_record[0].batsman);
		batsmanId2Field.val(res.batsman_record[1].batsman);
		onStrikeField.val(res.on_strike_batsman);

		batsman1NameField.text(res.batsman_record[0].player_name);
		batsman1Runs.text(res.batsman_record[0].runs == null ? 0 : res.batsman_record[0].runs);
		batsman1balls.text(res.batsman_record[0].balls);

		batsman1Fours.text(res.batsman_record[0].total_4 == null ? 0 : res.batsman_record[0].total_4);
		batsman1Sixes.text(res.batsman_record[0].total_6 == null ? 0 : res.batsman_record[0].total_6);

		batsman2NameField.text(res.batsman_record[1].player_name);
		batsman2Runs.text(res.batsman_record[1].runs == null ? 0 : res.batsman_record[1].runs);
		batsman2balls.text(res.batsman_record[1].balls);
		batsman2Fours.text(res.batsman_record[1].total_4 == null ? 0 : res.batsman_record[1].total_4);
		batsman2Sixes.text(res.batsman_record[1].total_6 == null ? 0 : res.batsman_record[1].total_6);

		updateBowlerRecords(res);

		ballNumberField.val(res.team_score.balls);
		inningIdField.val(res.team_score.inning_id);
		overIdField.val(res.team_score.over_id);
		ballidField.val(res.team_score.ball_id);
		overNumberField.val(res.team_score.overs);

		totalScore.text(res.team_score.total_team_score);
		totalWickets.text(res.team_score.wickets);
		displayOver.text(res.team_score.overs);
		displayBalls.text(res.team_score.balls);

		currentOverStatus.val(res.over.is_completed);

		var overRuns = displayCurrentOverRuns(res.current_over_records);
		currentOverRuns.text(overRuns);

	}

	function updateBowlerRecords(res)
	{
		bowlerIdField.val(res.bowler_record.bowler);
		bowlerName.text(res.bowler_record.player_name);
		bowledOver.text(res.bowler_record.over_number + '.' + res.bowler_record.ball_number);
		bowlerRuns.text(res.bowler_record.bowler_runs_gave == null ? 0 : res.bowler_record.bowler_runs_gave);
		bowlerWickets.text(res.bowler_record.bowler_wickets == null ? 0 : res.bowler_record.bowler_wickets);
	}

	function verifyOverStatus()
	{
		if (parseInt(currentOverStatus.val()) === 1 && parseInt(overNumberField.val()) !== parseInt(totalOvers.val())) {
			$('#newBowler').val();
			newBowlerModal.modal({backdrop: 'static', keyboard: false, show: true});
			newOver();
		}

		if (parseInt(currentOverStatus.val()) === 1 && parseInt(overNumberField.val()) === parseInt(totalOvers.val())) {
			Swal.fire({
				icon: 'success',
				text: 'Innings completed',
				showCloseButton: true
			});

			inningsCompleted();
		}

	}

	function displayCurrentOverRuns(data)
	{
		var overRuns = '';
		$.each(data, function (key, value)
		{
			overRuns += ' ' + value.runs;
		});
		return overRuns;
	}

	function newOver()
	{
		newBowlerModal.modal({backdrop: 'static', keyboard: false, show: true});
		$('#selectNewBowler').unbind('click');

		$('#selectNewBowler').on('click', function ()
		{
			var newBowler = $('#newBowler').val();
			return $.ajax({
				url: url + 'Live_score/new_over',
				type: "POST",
				data: {'bowler': newBowler, 'inning_id': inningIdField.val()},
				beforeSend: function ()
				{
					load();
				},
				success: function (data)
				{
					unLoad();
					newBowlerModal.modal('hide');
					ballNumberField.val(0);
					var response = JSON.parse(data);
					overIdField.val(response.over_id);
					updateBowlerRecords(response);
				}
			});
		});
	}

	function undoFunction()
	{
		$('#undoRecord').on('click', function (e)
		{
			e.preventDefault();
			var ballid = $('#ballid').val();
			$.ajax({
				url: url + 'Live_score/undoBall',
				type: "POST",
				data: {ballid: ballid},
				success: function (data)
				{
					var response = JSON.parse(data);
					updateScoreData(response);
				}
			});

		});
	}

	function swapBatsman()
	{
		$('#changeStrikeBatsman').on('click', function (e)
		{
			e.preventDefault();
			$('#strikeBatsman1').val(batsmanId1Field.val());
			$('#strikeBatsman2').val(batsmanId2Field.val());

			$('#strikeBatsman1').next().text(batsman1NameField.text());
			$('#strikeBatsman2').next().text(batsman2NameField.text());

			swapBatsmanModal.modal({backdrop: 'static', keyboard: false, show: true});

			$('#changeStrike').on('click', function ()
			{

				onStrikeField.val($('input[name=strikeBatsman]:checked').val());
				highlightStrike();
			});

		});
	}

	function othersFunction()
	{
		$('#othersOption').on('click', function (e)
		{
			e.preventDefault();
			teamWon.hide();
			matchComments.hide();

			othersModal.modal({backdrop: 'static', keyboard: false, show: true});

			$('input[type=radio][name=endoptions]').change(function ()
			{
				if ($('input[name=endoptions]:checked').val() == 'endmatch') {
					teamWon.show();
					matchComments.show();
					$('#out-submit').click(function ()
					{
						matchCompleted();
					});
				}
				if ($('input[name=endoptions]:checked').val() == 'reschedulematch') {
					teamWon.hide();
					matchComments.show();
					$('#out-submit').click(function ()
					{
						reScheduleMatch();
					});
				}
				if ($('input[name=endoptions]:checked').val() == 'endinnings') {
					teamWon.hide();
					matchComments.hide();
					$('#out-submit').click(function ()
					{
						inningsCompleted();
					});
				}
			});
		});
	}

	function setOutBatsman()
	{
		$('#batsman1-out').val(batsmanId1Field.val());
		$('#batsman2-out').val(batsmanId2Field.val());

		$('#batsman1-out').next().text(batsman1NameField.text());
		$('#batsman2-out').next().text(batsman2NameField.text());
	}

	function checkWicket()
	{

		var selectedWicket;

		$('#wicket-options').on('hidden.bs.modal', function ()
		{
			$("input[name='runs']:checked").trigger('click');
		});

		// By Default

		$('#wicket-involved').hide();
		$('#wicket-involved2').hide();

		$('#wicket-dropdown').change(function ()
		{
			var selectedWicket = $('#wicket-dropdown option:selected').val();
			if (selectedWicket == 'Catch Out' || selectedWicket == 'Stumped') {
				$('#wicket-involved').show();
				$('#wicket-involved2').hide();
			}
			else if (selectedWicket == 'Run Out') {
				$('#wicket-involved').show();
				$('#wicket-involved2').show();
			}
			else {
				$('#wicket-involved').hide();
				$('#wicket-involved2').hide();
			}
		});
	}

	function checkStrikeBatsman()
	{
		if (onstrikeid !== batsman1id && onstrikeid !== batsman2id) {
			Swal.fire({
				icon: 'error',
				text: 'Please select on strike batsman',
				showCloseButton: true
			});
			resetDefault();
			return false;
		}
		return true;
	}

	function reScheduleMatch()
	{
		$.ajax({
			url: url + 'Live_score/match_reschedule',
			type: "POST",
			data: {'comments': $('#matchCommentsField').val()},
			beforeSend: function ()
			{
				load();
			},
			success: function (data)
			{
				unLoad();
				var response = JSON.parse(data);
				if (response.status === 'success') {
					$('#matchIndexUrl').get(0).click();
				}
			}
		});
	}

	function matchCompleted()
	{
		$.ajax({
			url: url + 'Live_score/match_completed',
			type: "POST",
			data: {'comments': $('#matchCommentsField').val(), 'teamWon': $('#teamWon').val()},
			beforeSend: function ()
			{
				load();
			},
			success: function (data)
			{
				unLoad();
				var response = JSON.parse(data);
				if (response.status === 'success') {
					$('#matchIndexUrl').get(0).click();
				}
			}
		});
	}

	function inningsCompleted()
	{
		$.ajax({
			url: url + 'Live_score/innings_completed',
			type: "POST",
			data: {},
			beforeSend: function ()
			{
				load();
			},
			success: function (data)
			{
				unLoad();
				var response = JSON.parse(data);
				if (response.status === 'success') {
					$('#matchIndexUrl').get(0).click();
				}
			}
		});
	}

	return {
		init: init
	};
}();
