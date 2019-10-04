<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Groups Listing</h3>
            	<div class="box-tools">
                    <!-- <a href="<?php echo site_url('group_point/add'); ?>" class="btn btn-success btn-sm">Add</a>  -->
                </div>
            </div>
            <div class="box-body">
				<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Group Id</th>
						<th>Tournament Team Id</th>
						<th>Net Run Rate</th>
						<th>Points</th>
						<th>Wins</th>
						<th>Losses</th>
						<th>N/r</th>
						<th class="no-sort">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($group_points as $g){ ?>
					<tr>
						<td><?php echo $g['group_name']; ?></td>
						<td><?php echo $g['team_name']; ?></td>
						<td><?php echo $g['net_run_rate']; ?></td>
						<td><?php echo $g['points']; ?></td>
						<td><?php echo $g['wins']; ?></td>
						<td><?php echo $g['losses']; ?></td>
						<td><?php echo $g['n/r']; ?></td>
						<td>
							<a href="<?php echo site_url('group_point/edit/'.$g['group_points_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                        	 	<a href="<?php echo site_url('group_point/remove/'.$g['group_points_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
				</table>                 
            </div>
        </div>
    </div>
</div>

