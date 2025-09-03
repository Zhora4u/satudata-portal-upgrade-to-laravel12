<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">

        <form action="<?= base_url('backend/admin/editrole/' . $role['id']); ?>" method="post">

            <div class="form-group">
                <input type="text" class="form-control" id="role" name="role" placeholder="Role name" value="<?= $role['role']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->