<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tournament Teams</h3>
                <?php if($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The tournament team has been deleted.
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('edit_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The tournament team detail has been edited.
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('add_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The tournament team has been added.
                    </div>
                <?php } ?>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tournament_team/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table id="gplDataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tournament Name</th>
                            <th>Team Name</th>
                            <th>Captain Name</th>
                            <th>Vice Captain Name</th>
                            <th class="no-sort">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tournament_teams as $t){ ?>
                        <tr>
                            <td><?php echo $t['tournament_name']; ?></td>
                            <td><?php echo $t['team_name']; ?></td>
                            <td><?php echo $t['captain']; ?></td>
                            <td><?php echo $t['vice_captain']; ?></td>
                            <td>
                                <a href="<?php echo site_url('tournament_team/edit/'.$t['tournament_team_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                                <a href="<?php echo site_url('tournament_team/remove/'.$t['tournament_team_id']); ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>



