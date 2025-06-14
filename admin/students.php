<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-3 mb-3">All Students</h2>
        <table class="table table-striped" id="example" class="display">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require '../connection.php';
                    $sql="SELECT * FROM students";
                    $result=mysqli_query($conn,$sql);
                    while($students=mysqli_fetch_array($result)){?>
                <tr>
                    <td class="user_id"><?php echo $students['id'] ?></td>
                    <td><?php echo $students['name'] ?></td>
                    <td><?php echo $students['email'] ?></td>
                    <td><?php echo $students['contact'] ?></td>
                    <td>
                        <a href="studentEdit.php?id=<?php echo $students['id'] ?>" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-primary confirm_delete_btn" data-bs-toggle="modal" data-bs-target="#deleteModel">Delete</button>

                    </td>
                </tr>

            <?php } ?>
            </tbody>
        </table>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="deleteModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModelLabel">Confirm Delete</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
            <input type="hidden" name="id" id="confirm_delete_id">
        <div class="modal-body">
            Are you sure you want to delete this student?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary confirm_delete">Yes, Delete</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

    <script>
        new DataTable('#example');
    </script>


    <!-- confirm delete -->
    <Script>
        $('.confirm_delete_btn').click(function () {
          var user_id = $(this).closest('tr').find('.user_id').text();
          $('#confirm_delete_id').val(user_id);
        });

        $('.confirm_delete').click(function () {
            var user_id = $('#confirm_delete_id').val();

            $.ajax({
                method: "POST",
                url: "deleteStudent.php",
                data: {
                    'confirm_delete': true,
                    'user_id': user_id,
                },
                success: function (response) {
                    //alert(response); // Optional
                    location.reload(); // Refresh to update table
                }
        });
});


    </Script>




</body>
</html>

