<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
                    <a class="btn btn-primary btn-sm" href="<?= base_url() ?>admin/addArticle">Tambah Data</a>
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

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <div class="container-fluid">
            <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $article['title']; ?></td>
                        <td><?= $article['content']; ?></td>
                        <td><?= $article['author_name']; ?></td>
                        <td><?= $article['categories']; ?></td>
                        <td><?= $article['tags']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm"
                                href="<?= base_url() ?>Admin/editArticle/<?= $article['article_id']; ?>"><i
                                    class="fa fa-edit"></i></a>
                            <a class="btn btn-info btn-sm"
                                href="<?= base_url() ?>Admin/detailArticle/<?= $article['article_id'] ?>"><i
                                    class="fa fa-eye"></i></a>
                            <a href="<?= base_url('admin/deleteArticle/' . $article['article_id']); ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this article?');"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->