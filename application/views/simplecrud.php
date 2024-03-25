<?php include('header.php');?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="">Crud Using Ajax
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary text-light" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add New Student
                                </button>
                            </div>
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Caste</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($studentsData as $value)
                                    echo'
                                            <tr>
                                              <td>'.$value->id.'</td>
                                              <td>'.$value->name.'</td>
                                              <td>'.$value->fname.'</td>
                                              <td>'.$value->caste.'</td>
                                              <td>'.$value->phone.'</td>
                                              <td>
                                              <button class="btn btn-secondary" id="editbtn" data-id="'.$value->id.'" data-bs-toggle="modal" data-bs-target="#exampleModal2">Edit</button>
                                              <button class="btn btn-danger text-light" id="deletebtn" data-id="'.$value->id.'">Delete</button></td>
                                            </tr>
                                  ';
                                  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addform" class="form-group">
                        <label for="">Name</label>
                        <input type="text" id="name" name="name" class="form-control input1">
                        <label for="">Father Name</label>
                        <input type="text" id="fname" name="fname" class="form-control input1">
                        <label for="">Caste</label>
                        <input type="text" id="caste" name="caste" class="form-control input1">
                        <label for="">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control input1">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="savebtn" class="btn btn-primary text-light">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal Ends  -->
    <!-- Edit Modal Starts  -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editform" class="form-group">
                        <input type="text" id="id2" name="id" hidden><br>
                        <label for="">Name</label>
                        <input type="text" id="name2" name="name" class="form-control input1">
                        <label for="">Father Name</label>
                        <input type="text" id="fname2" name="fname" class="form-control input1">
                        <label for="">Caste</label>
                        <input type="text" id="caste2" name="caste" class="form-control input1">
                        <label for="">Phone</label>
                        <input type="text" id="phone2" name="phone" class="form-control input1">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="updatebtn" class="btn btn-success text-light">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal  -->
    <?php include('footer.php')?>

    <script>
    // Ready function is use to read the code of document
    $(document).ready(function() {
        // Insert Student data using modal in which we use form , and submit form
        $('#addform').submit(function() {
            var form = $('#addform').serialize();
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>Simplecrud/insert',
                data: form,
                success: function(data) {
                    location.reload();
                }
            })
        })
        // Insert Ends

        // Edit System use for getting data from database , and show in edit modal
        $(document).on('click', '#editbtn', function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>Simplecrud/getStudent',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(result) {
                    $("#id2").val(result.id);
                    $("#name2").val(result.name);
                    $("#fname2").val(result.fname);
                    $("#caste2").val(result.caste);
                    $("#phone2").val(result.phone);
                }
            })
        });
        // Edit Modal Ends

        //  Update function in which we target the specific id and edit the data of that id
        $("#updatebtn").click(function() {
            var form = $('#editform').serialize();
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>Simplecrud/update',
                data: form,
                success: function(data) {
                    if (data == "Correct") {
                        alert('Date Updated');
                        location.reload();
                    } else {
                        alert('Error, Try Again');
                        location.reload();
                    }
                }
            })
        })
        // Update Ends

        // Delete function in which selected id is goes to delete so we have to target that which we want to delete
        $(document).on('click', '#deletebtn', function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: "<?= base_url()?>Simplecrud/delete",
                data:{ id:id },
                success: function(data) {
                    if(data == "Correct")
                    {
                        alert('Deleted');
                        // easily
                        location.reload();
                    }
                }
            })
        })        
    })
    </script>