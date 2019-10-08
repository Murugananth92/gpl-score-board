<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Players Listing</h3>
                <?php if($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The player has been deleted.
                    </div>
                <?php } ?>
            	<div class="box-tools">
                    <a href="<?php echo site_url('player/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                            <tr>
                                <th>Player Name</th>
                                <th>Player Email</th>
                                <th>Company</th>
                                <th>Employee Id</th>
                                <th>Player Role</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php foreach($players as $p){ ?>
                            <tr>
                                <td><?php echo $p['player_name']; ?></td>
                                <td><?php echo $p['player_email']; ?></td>
                                <td><?php echo $p['company']; ?></td>
                                <td><?php echo $p['employee_id']; ?></td>
                                <td><?php echo $p['player_role']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('player/edit/'.$p['player_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                                    <a href="<?php echo site_url('player/remove/'.$p['player_id']);  ?>" onclick="return confirm('Are you sure?')"  class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>


