<?php
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

//Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

//Die if connection was not sucessful
if(!$conn){
echo "Sorry we failed to connect to the database<br>" . mysqli_connect_error();
}


if(isset($_GET['delete'])){
$sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `NOTES` WHERE `Sr.No` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $discription = $_POST["discriptionEdit"];
    
    //insert data in table
  $sql = "UPDATE `notes` SET `title` = '$title' , `discription` = '$discription' WHERE `notes`.`Sr.No` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
  }else{
    echo "we can not update the record sucessfully";
  }
   
  }
  else{
  $title = $_POST["title"];
  $discription = $_POST["discription"];
  
  //insert data in table
$sql = "INSERT INTO `notes` (`title`, `discription`) VALUES ('$title', '$discription')";
$result = mysqli_query($conn, $sql);


//Check for the data addition sucessful
if($result){
    // echo 'The record has been inserted sucessfully <br>';
    $insert = true;
}
else{
    echo "The record was not inserted sucessfully because of this error----->".mysqli_error($conn);
}
  }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <title>iNotes - Notes taking make easy</title>


</head>

<body>
  <!-- edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
Edit Modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/project9/index.php?update=true" method="post">
        <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" />
            </div>
            <div class="form-group">
              <label for="desc">Note Discription</label>
              <textarea class="form-control" id="discriptionEdit" name="discriptionEdit" rows="3"></textarea>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/project9/"><img src="/project9/logo.svg" height ="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/project9/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
      </form>
    </div>
  </nav>


  <?php
if($insert){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been inserted sucessfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
    ?>
  <?php
if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been updated sucessfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
    ?>
  <?php
if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been deleted sucessfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
    ?>



  <div class="container my-5">
    <h2>Add a Note</h2>
    <form action="/project9/index.php?insert=true" method="post">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" />
      </div>
      <div class="form-group">
        <label for="desc">Note Discription</label>
        <textarea class="form-control" id="discription" name="discription" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container my-4">


    <!-- Table to store notes -->
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sr.No</th>
          <th scope="col">Title</th>
          <th scope="col">Discription</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>




        <?php

$sql = "SELECT * FROM `notes`";
$result = mysqli_query($conn, $sql);
$sno = 0;
while($row = mysqli_fetch_assoc($result)){
  $sno = $sno + 1;
   echo " <tr>
   <th scope='row'>".$sno." </th>
   <td>".$row['title']."</td>
   <td>".$row['discription']."</td>
   <td><button class='edit btn btn-sm btn-primary' id=".$row['Sr.No'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['Sr.No'].">Delete</button></td>
 </tr>";
    } 
    
  
  
    ?>



      </tbody>
    </table>
  </div>
  <hr>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <script>

    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        discription = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, discription);
        titleEdit.value = title;
        discriptionEdit.value = discription;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        sno = e.target.id.substr(1,);

        if (confirm("Are you sure you want to delete this note")) {
          console.log("yes");
          window.location = `/project9/index.php?delete=${sno}`;

        } else {
          console.log("no");
        }

      })
    })

  </script>

</body>

</html>