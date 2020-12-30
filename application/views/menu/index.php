<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $judul; ?></h1>
    <div class="row">
        <div class="col-6">
            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('menu'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Add New Menu
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $mnu) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $mnu['menu']; ?></td>
                            <td>
                                <a href="<?= base_url() ?>menu/edit/<?= $mnu['id']; ?>" data-toggle="modal" data-target="#editModal<?= $mnu['id']; ?>" class="badge badge-pill badge-success">Edit</a>
                                <a href="<?= base_url('menu/hapus/') ?><?= $mnu['id']; ?>" class="badge badge-pill badge-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endModal -->

<!-- editModel -->
<?php foreach ($menu as $mnu) : ?>
    <div class="modal fade" id="editModal<?= $mnu['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if (empty($_POST['menu'] = null)) : ?>
                    <form action="<?= base_url() ?>menu/edit/<?= $mnu['id']; ?>" method="POST">
                    <?php else : ?>
                        <form action="<?= base_url('menu'); ?>" method="POST">
                        <?php endif; ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="menu" name="menu" value="<?= $mnu['menu'] ?>">
                                <small id="menu" class="form-text text-danger"><?= form_error('menu'); ?></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="edit" class="btn btn-primary">edit menu</button>
                        </div>
                        </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- end EditModel -->