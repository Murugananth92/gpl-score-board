var LiveScore = function () {
	
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
	var bowlerid;
	var batsman1id;
	var batsman2id;
	var loader;

	function init() {
		
		url = $('#url').val();
		liveScoreModal = $('#modal-selectplayer');
		inningId = $('#inningId');
		overId = $('#overId');
		isInningsProgressing = $('#isInningsProgressing').val();
		loader = $('.loader');
		batsmanField1 = $('#batsman1_name');
		batsmanField2 = $('#batsman2_name');
		bowlerField = $('#bowler_name');

		if (parseInt(isInningsProgressing) === 0) {
			liveScoreModal.modal({backdrop: 'static', keyboard: false, show: true});
		}

		selectPlayers();
	}

	function validateRequiredFields(fields,modal = '') {
		let validation = true;
		if(fields.length) {
			$.each(fields, function( index, value ) {
				let field_id = $("#"+value);
				val = $.trim(field_id.val());
				if(val === '') {
					validation = false;
					field_id.addClass('has-error');
				} else {
					field_id.removeClass('has-error');
				}
			  });
		}
		if(modal !== '' && validation) {
			$('#'+modal).modal('hide');
		}
		return validation;
	}

	function selectPlayers() {
		$('#startMatch').on('click', function () {
			
			if(validateRequiredFields(['batsman1','batsman2','bowler'],'modal-selectplayer')) {
				batsman1 = $('#batsman1').val();
				batsman2 = $('#batsman2').val();
				bowler = $('#bowler').val();
				bowlerid = $('#bowler_id');
				batsman1id = $('#batsman1_id');
				batsman2id = $('#batsman2_id');
	
				batsmanName1 = $('#batsman1 option:selected').attr('data-batsman1');
				batsmanName2 = $('#batsman2 option:selected').attr('data-batsman2');
				bowlerName = $('#bowler option:selected').attr('data-bowler');
				setInnings(batsman1, batsman2, bowler);
			}
		});
	}

	function load() {
		loader.show();
	}

	function unLoad() {
		loader.hide();
	}

	function setInnings(batsman1, batsman2, bowler) {
		return $.ajax({
			url: url + 'Live_score/start_innings',
			type: "POST",
			data: {batsman1: batsman1, batsman2: batsman2, bowler: bowler},
			beforeSend: function () {
				load();
			},
			success: function (data) {
				unLoad();
				var response = JSON.parse(data);
				liveScoreModal.modal('hide');
				inningId.val(response.inning_id);
				overId.val(response.over_id);
				$('#on_strike_batsman').val(response.on_strike_batsman);
				$('#batsman1_id').val(response.batsman1);
				$('#batsman2_id').val(response.batsman2);
				batsmanField1.text(batsmanName1);
				batsmanField2.text(batsmanName2);
				bowlerField.text(bowlerName);
				bowlerid.val(bowler);
				batsman1id.val(batsman1);
				batsman2id.val(batsman2);
				$('#batsman1_strike').addClass('highlight');
			}
		});
	}

	return {
		init: init
	};

}();

// Select Batsman Disable Function
$(document).ready(function () {
	$('#batsman1').on('change', function () {
		var batsman1 = $(this).val();
		$("#batsman2 option").attr('disabled', 'disabled')
			.siblings().removeAttr('disabled');
		$("#batsman2 option[value='" + batsman1 + "']").attr('disabled', true);
	});

	$('#batsman2').on('change', function () {
		var batsman2 = $(this).val();
		$("#batsman1 option").attr('disabled', 'disabled')
			.siblings().removeAttr('disabled');
		$("#batsman1 option[value='" + batsman2 + "']").attr('disabled', true);
	});
});
