<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tournaments</h3>
                <?php if($this->session->flashdata('edit_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The tournament detail has been edited.
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('add_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The tournament has been added.
                    </div>
                <?php } ?>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tournament/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
						<th>Tournament Name</th>
						<th>Tournament Year</th>
                        <th>Is active</th>
						<th class="no-sort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tournaments as $t){ ?>
                    <tr>
						<td><?php echo $t['tournament_name']; ?></td>
						<td><?php echo $t['tournament_year']; ?></td>
                        <td><?php echo $t['is_active']; ?></td>
						<td>
                            <a href="<?php echo site_url('tournament/edit/'.$t['tournament_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>                  
            </div>
        </div>
    </div>
</div>
