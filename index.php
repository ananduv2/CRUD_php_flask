<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Book Example in PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Contact Book</h2>
    <!-- <h4>Add new contact</h4> -->
  <form class="form-inline" method="POST" action="add.php">
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="pwd">Mobile:</label>
      <input type="text" class="form-control" id="mob" placeholder="Enter mobile number" name="mob">
    </div>
    <input type="submit" name="submit" class="btn btn-default" value="Add">
  </form>           
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
        include('connection.php');
        $q = "SELECT * FROM `contacts` ";
        $e=mysqli_query($con,$q);
        if(mysqli_num_rows($e)=='0'){
            echo "<tr><td style='cols:2'>No contacts found!</td>";
        }
        else{
            foreach ($e as $key) {
                echo "<tr><td>$key[name]</td><td>$key[mob]</td><td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#Edit_$key[id]_$key[name]'>Update</button></td><td><button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#Delete_$key[id]_$key[name]'>Delete</button></td></tr>";
                echo "<div class='modal fade' id='Edit_$key[id]_$key[name]' role='dialog'>
                <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Edit $key[name]'s contact</h4>
                  </div>
                  <form class='form-inline' method='POST' action='update.php'>
                  <div class='modal-body'>
                    <div class='form-group'>
                        <label for='email'>Mobile:</label>
                        <input type='hidden' name='name' value='$key[name]'>
                        <input type='hidden' name='id' value='$key[id]'>
                        <input type='text' class='form-control' id='mob' value='$key[mob]' name='mob'>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <input type='submit' name='submit' class='btn btn-success' value='Update'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                  </div>
                  </form>
                </div></div></div>";
                echo "<div class='modal fade' id='Delete_$key[id]_$key[name]' role='dialog'>
                <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Delete $key[name]'s contact</h4>
                  </div>
                  <form class='form-inline' method='POST' action='delete.php'>
                  <div class='modal-body'>
                    <div class='form-group'>
                        <input type='hidden' name='name' value='$key[name]'>
                        <input type='hidden' name='id' value='$key[id]'>
                        <input type='hidden' id='mob' value='$key[mob]' name='mob'>
                        <h5>Are you sure you want to delete this contact?</h5>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <input type='submit' name='submit' class='btn btn-danger' value='Delete'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                  </div>
                  </form>
                </div></div></div>";
            }
        }
    ?>
    </tbody>
  </table>
</div>

</body>
</html>

