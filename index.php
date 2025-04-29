<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <title>Contract of Service</title>
</head>

<body>     
<nav class="navbar navbar-light fs-1 mb-5 text-white" style="background-color: #008245; display: flex; justify-content: space-between; align-items: center;">
    <a href="main.php" class="btn btn-light btn-outline-dark border border-dark border-2 mt-3 mb-3 ms-5 ps-3">← Back</a>
    <span class="text-center">Contract of Service</span>
    <div style="width: 100px;"></div> <!-- Adjust width as needed for centering -->
</nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div style="text-align: right; margin-bottom: 2px;">
      <a href="add-new.php" class="btn btn-success mb-2">
        <i class="fa fa-plus me-1"></i> Add New
      </a>
    </div>
    <div class="row g-3">
      <table class="table table-hover text-center" style="border: 2px solid black;">
        <thead class="table-dark">
          <tr>
            <th scope="col" style="border: 1px solid white;">ID</th>
            <th scope="col" style="border: 1px solid white;">Name</th>
            <th scope="col" style="border: 1px solid white;">Position</th>
            <th scope="col" style="border: 1px solid white;">Charging</th>
            <th scope="col" style="border: 1px solid white;">Salary</th>
            <th scope="col" style="border: 1px solid white;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `employees`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td style="border: 1px solid black;">
                <?php echo $row["cos_id"] ?>
              </td>
              <td style="border: 1px solid black;">
                <?php echo $row["cos_name"] ?>
              </td>
              <td style="border: 1px solid black;">
                <?php echo $row["cos_position"] ?>
              </td>
              <td style="border: 1px solid black;">
                <?php echo $row["cos_charging"] ?>
              </td>
              <td style="border: 1px solid black;">
                <?php echo $row["cos_salary"] ?>
              </td>
              <td style="border: 1px solid black;">
                <a href="edit.php?cos_id=<?php echo $row["cos_id"] ?>" class="link-dark"><i
                    class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="print.php?cos_id=<?php echo $row["cos_id"] ?>" class="link-dark"><i
                    class="fa-solid fa-print fs-5 me-3"></i></a>
                <a href="delete.php?cos_id=<?php echo $row["cos_id"] ?>" class="link-dark"><i
                    class="fa-solid fa-trash fs-5"></i></a>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous">
  </script>

    

</body>

</html>