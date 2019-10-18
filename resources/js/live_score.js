var LiveScore = function ()
{
	var url;
	var liveScoreModal;
	var isInningsProgressing;
	var inningId;
	var overId;
	var batsman1;
	var batsman2;
	var bowler;
	var batsmanName1;
	var batsmanName2;
	var bowlerName;
	var batsmanField1;
	var batsmanField2;
	var bowlerField;

	function init()
	{
		url = $('#url').val();
		liveScoreModal = $('#modal-selectplayer');
		inningId = $('#inningId');
		overId = $('#overId');
		isInningsProgressing = $('#isInningsProgressing').val();


		batsmanField1 = $('#batsman1_name');
		batsmanField2 = $('#batsman2_name');
		bowlerField = $('#bowler_name');

		if (parseInt(isInningsProgressing) === 0) {
			liveScoreModal.modal({backdrop: 'static', keyboard: false, show: true});
		}

		selectPlayers();
	}

	function selectPlayers()
	{
		$('#startMatch').on('click', function ()
		{
			batsman1 = $('#batsman1').val();
			batsman2 = $('#batsman2').val();
			bowler = $('#bowler').val();

			batsmanName1 = $('#batsman1 option:selected').attr('data-batsman1');
			batsmanName2 = $('#batsman2 option:selected').attr('data-batsman2');
			bowlerName = $('#bowler option:selected').attr('data-bowler');

			setInnings(batsman1, batsman2, bowler);
		});
	}

	function setInnings(batsman1, batsman2, bowler)
	{
		return $.ajax({
			url: url + 'Live_score/start_innings',
			type: "POST",
			data: {batsman1: batsman1, batsman2: batsman2, bowler: bowler},
			success: function (data)
			{
				liveScoreModal.modal('hide');
				inningId.val(data.inning_id);
				overId.val(data.over_id);
				batsmanField1.text(batsmanName1);
				batsmanField2.text(batsmanName2);
				bowlerField.text(bowlerName);
			}
		});
	}

	return {
		init: init
	};
}();
