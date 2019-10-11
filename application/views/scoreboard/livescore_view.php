<div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Select Batsmen & Bowler</h4>
              </div>
              <div class="modal-body">
			  <form role="form" method="post" action=''>

					<label>Select Striker</label>
					<select class="form-control" name="matches" id="matches">
						<option value="empty">Select Striker</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option  value=""><?php echo $team1_player; ; ?></option >
						<?php } ?>
					</select>
					<label>Select Non Striker</label>
					<select class="form-control" name="matches" id="matches">
						<option value="empty">Select Non Striker</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option  value=""><?php echo $team1_player; ; ?></option >
						<?php } ?>
					</select>
					<label>Select Bowler</label>
					<select class="form-control" name="matches" id="matches">
						<option value="empty">Select Bowler</option>
						<?php foreach ($team2 as $team2_player) { ?>
							<option  value=""><?php echo $team2_player; ; ?></option >
						<?php } ?>
					</select>
			  </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Start</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">  
            <div class="box-header with-border">
              <h3 class="box-title">Live Match	</h3>
            </div>
            <form role="form">
              <div class="box-body">
								<h5 class="col-xs-6">Team 1, <span>Innining number</span></h5>
								<h1 class="col-xs-12">Runs - Wicket<span>(Balls)</span></h1>
									<div class="box-header">
									</div>
										<!-- /.box-header -->
									<div class="box-body no-padding">
									<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
										Select Batsmen & Bowler
									</button>
										<table class="table table-striped">
											<tbody>
												<tr>
													<th style="width: 500px">Batsman	</th>
													<th style="width: 50px">Runs</th>
													<th style="width: 50px">Balls</th>
													<th style="width: 50px">4s</th>
													<th style="width: 50px">6s</th>
												</tr>
												<tr>
													<td>Batsman 1</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
												</tr>
												<tr>
													<td>Batsman 2</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
													<td>0</td>
												</tr>
												<tr>
													<th style="width: 500px">Bowler</>
													<th style="width: 50px">Over</th>
													<th style="width: 50px">Maiden</th>
													<th style="width: 50px">Runs</th>
													<th style="width: 50px">Wickets</th>
												</tr>
												<tr>
													<td>Bowler</td>
													<td>0.0</td>
													<td>0</td>
													<td>0.0</td>
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
			  				<h4><b>This Over: </b><span class="1">1</span>&nbsp;<span class="2">2</span>&nbsp;<span class="3">3</span>&nbsp;<span class="4">4</span>&nbsp;<span class="5">5</span>&nbsp;<span class="6">6</span>&nbsp;<span class="7"></span>&nbsp;<span class="8"></span></h4>
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
				</div><div class="form-group">
			  <button class="btn btn-info form-control">Extras</button>
			  </div><div class="form-group">
			  <button class="btn btn-info form-control">Partnerships</button>
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
<script type="text/javascript">
    $(window).on('load',function(){
        $('#modal-default').modal('show');
    });
</script>
