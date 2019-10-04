<?php
print_r($params);
?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Select Players</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form role="form" method="post" action="">
				<div class="box-body">
				<div class="col-xs-6">
				<table class="table table-striped">
				<thead><tr>
					<th style="width:100%">Team 1 </th>
					</tr></thead>
                <tbody><tr>
                  <th style="width: 50px">Players</th>
                  <th style="width: 50px">Reject</th>
                </tr>
                <tr>
                  <td>Ahmed</td>
                  <td>00</td>
                </tr>
			  </tbody></table></div>
			  <div class="col-xs-6">
				<table class="table table-striped">
				<thead><tr>
					<th style="width:100%">Team 2 </th>
					</tr></thead>
                <tbody><tr>
                  <th style="width: 50px">Players</th>
                  <th style="width: 50px">Reject</th>
                </tr>
                <tr>
                  <td>Ahmed</td>
                  <td>00</td>
                </tr>
              </tbody></table></div>
				</div>
				<div class="box-footer">
					<!-- <button type="submit" class="btn btn-primary">Previous</button> -->
					<a href="<?= base_url()?>start_match" class="btn btn-primary">Previous</a>
					<button type="submit" class="btn btn-primary pull-right">Next</button>
				</div>
			</form>
		</div>
	</div>
</div>
