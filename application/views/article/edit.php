<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php echo form_open('admin/updateArticle/'.$article['id']); ?>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="<?= set_value('title', $article['title']); ?>">
                        <?= form_error('title', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <!-- Content Field -->
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content"
                            rows="5"><?= set_value('content', $article['content']); ?></textarea>
                        <?= form_error('content', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <!-- Author Field (Optional) -->
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select class="form-control" name="author_id" id="author_id">
                            <option value="">Select Author</option>
                            <?php foreach ($authors as $author): ?>
                            <option value="<?= $author['id']; ?>"
                                <?= set_select('author_id', $author['id'], ($article['author_id'] == $author['id'])); ?>>
                                <?= $author['name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('author_id', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id']; ?>"
                                <?= set_select('category_id', $category['id'], in_array($category['id'], $selected_categories)); ?>>
                                <?= $category['name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('category_id', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <!-- Tags Field -->
                    <div class="form-group">
                        <label>Tags</label><br>
                        <?php foreach ($tags as $tag): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="<?= $tag['id']; ?>"
                                <?= (in_array($tag['id'], $selected_tags)) ? 'checked' : ''; ?>>
                            <label class="form-check-label"><?= $tag['name']; ?></label>
                        </div>
                        <?php endforeach; ?>
                        <?= form_error('tags[]', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Article</button>
                </div>
            </div>
            <?php echo form_close(); ?>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->