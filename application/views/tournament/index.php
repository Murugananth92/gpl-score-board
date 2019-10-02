<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tournaments Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tournament/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Tournament Name</th>
						<th>Tournament Year</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($tournaments as $t){ ?>
                    <tr>
						<td><?php echo $t['tournament_name']; ?></td>
						<td><?php echo $t['tournament_year']; ?></td>
						<td>
                            <a href="<?php echo site_url('tournament/edit/'.$t['tournament_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('tournament/remove/'.$t['tournament_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
