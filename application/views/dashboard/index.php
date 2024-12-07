<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <!-- Tabel Authors -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Authors</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/addAuthor'); ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Input Author Name ..." required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Input Author Email ..." required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($authors as $a): ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $a['name']; ?></td>
                                            <td><?= $a['email']; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editAuthorModal<?= $a['id']; ?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('admin/deleteAuthor/' . $a['id']); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this author?');"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <!-- Tabel Categories -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Categories</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/addCategory'); ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Input Category Name ..." required>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($categories as $category): ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $category['name']; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editCategoryModal<?= $category['id']; ?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('admin/deleteCategory/' . $category['id']); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this category?');"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <!-- Tabel Tags -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Tags</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/addTag'); ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Input Tag Name ..." required>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tag Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($tags as $tag): ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $tag['name']; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editTagModal<?= $tag['id']; ?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('admin/deleteTag/' . $tag['id']); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this Tag?');"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Edit Author -->
<?php foreach ($authors as $a): ?>
<div class="modal fade" id="editAuthorModal<?= $a['id']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editAuthorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAuthorModalLabel">Edit Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form to Update Author -->
            <form action="<?= base_url('admin/updateAuthor'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $a['name']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $a['email']; ?>"
                            required>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?= $a['id']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Edit Category -->
<?php foreach ($categories as $category): ?>
<div class="modal fade" id="editCategoryModal<?= $category['id']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form to Update Author -->
            <form action="<?= base_url('admin/updateCategory'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $category['name']; ?>"
                            required>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?= $category['id']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Edit Tag -->
<?php foreach ($tags as $tag): ?>
<div class="modal fade" id="editTagModal<?= $tag['id']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editTagModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagModalLabel">Edit Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form to Update Author -->
            <form action="<?= base_url('admin/updateTag'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $tag['name']; ?>"
                            required>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?= $tag['id']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>