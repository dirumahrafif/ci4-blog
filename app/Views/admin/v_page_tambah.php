<div class="card-header">
    <i class="fas fa-table me-1"></i>
    <?php echo $templateJudul ?>
</div>
<div class="card-body">
    <?php
    $session = \Config\Services::session();
    if ($session->getFlashdata('warning')) {
    ?>
        <div class="alert alert-warning">
            <ul>
                <?php
                foreach ($session->getFlashdata('warning') as $val) {
                ?>
                    <li><?php echo $val ?></li>
                <?php
                }
                ?>
            </ul>
        </div>
    <?php
    }
    if ($session->getFlashdata('success')) {
    ?>
        <div class="alert alert-success"><?php echo $session->getFlashdata('success') ?></div>
    <?php
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="input_post_title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="input_post_judul" name="post_title" value="<?php echo (isset($post_title)) ? $post_title : "" ?>">
        </div>
        <div class="mb-3">
            <label for="input_post_status" class="form-label">Status</label>
            <select name="post_status" class="form-select">
                <option value="active" <?php echo (isset($post_status) && $post_status == 'active') ? "selected" : "" ?>>Aktif</option>
                <option value="inactive" <?php echo (isset($post_status) && $post_status == 'inactive') ? "selected" : "" ?>>Tidak Aktif</option>
            </select>
        </div>
        <?php
        if (isset($post_thumbnail)) {
        ?>
            <div class="mb-3">
                <img src="<?php echo base_url(LOKASI_UPLOAD . "/" . $post_thumbnail) ?>" class="pb-2 mb-2 img-thumbnail w-50" />
            </div>
        <?php
        }
        ?>
        <div class="mb-3">
            <label for="input_post_thumbnail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="input_post_thumbnail" name="post_thumbnail">
        </div>
        <div class="mb-3">
            <label for="input_post_description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="input_post_description" name="post_description" rows="2"><?php echo (isset($post_description)) ? $post_description : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="input_post_content" class="form-label">Konten</label>
            <textarea class="form-control" id="summernote" name="post_content" rows="10"><?php echo (isset($post_content)) ? $post_content : '' ?></textarea>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3">
                <input type='checkbox' name="set_halaman_depan" value="1" <?php echo (isset($set_halaman_depan)) ? 'checked' : '' ?> /> Halaman Depan?
            </div>
            <div class="col-lg-3">
                <input type='checkbox' name="set_halaman_kontak" value="1" <?php echo (isset($set_halaman_kontak)) ? 'checked' : '' ?> /> Halaman Kontak?
            </div>
        </div>
        <div>
            <input type="submit" name="submit" value="Simpan Data" class="btn btn-primary">
        </div>
    </form>
</div>