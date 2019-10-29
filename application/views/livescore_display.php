<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Live score</h3>
            </div>
            <?php echo form_open('player/add'); ?>
          	<div class="box-body">
              <div class="row clearfix">
					<div class="col-md-6">
						<label for="teams" class="control-label"><span class="text-danger"></span>teams</label>
						<div class="form-group">
							<input type="text" name="teams" value="" class="form-control" id="teams" />
						</div>
					</div>
				</div>
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="live_score" class="control-label"><span class="text-danger"></span>Live score</label>
						<div class="form-group">
							<input type="text" name="live_score" value="" class="form-control" id="live_score" />
						</div>
					</div>
				</div>
			</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>


<script>
    $(document).ready(function ()
		{
            alert('hii1');
                function getScore(){
                    $.ajax({
                    // alert('hii');
                    url: "<?php echo site_url('Livescore_display/match_detail'); ?>",
                    type: "POST",
                    data: {},
                    success: function (response)
                        {
                            var response = JSON.parse(response);
                            // getPlayers(response);
                            // var matchID = response.match_id;
                            var team_name = response.team1_name+' vs '+response.team2_name;
                            // console.log(response)
                            // console.log('matchID', matchID)
                            $('#live_score').val(response.runs);
                            $('#teams').val(team_name);
                            setTimeout(function(){ getScore(); }, 5000);
                        }
                    });
                }
                getScore();
		});
</script>
