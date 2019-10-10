<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Groups Listing</h3>
				<?php if($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The group point team has been deleted.
                    </div>
                <?php } ?>
				<?php if($this->session->flashdata('edit_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The group point team detai has been edited.
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('add_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The group point team has been added.
                    </div>
                <?php } ?>
            	<div class="box-tools">
                    <!-- <a href="<?php echo site_url('group_point/add'); ?>" class="btn btn-success btn-sm">Add</a>  -->
                </div>
            </div>
            <div class="box-body">
				<table id="gplDataTable" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Group Name</th>
						<th>Tournament Team </th>
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
                        	 	<a href="<?php echo site_url('group_point/remove/'.$g['group_points_id']); ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
				</table>                 
            </div>
        </div>
    </div>
</div>
