<?php
include "db_conn.php";

// Add this code near the top to fetch duties
$duties_query = "SELECT DISTINCT duties FROM df ORDER BY duties ASC";
$duties_result = mysqli_query($conn, $duties_query);
$duties_list = [];
while($row = mysqli_fetch_assoc($duties_result)) {
    $duties_list[] = $row['duties'];
}

if (isset($_POST["submit"])) {
    // Validate required fields
    $required_fields = [
        'cos_id' => 'ID Number',
        'cos_name' => 'Name',
        'cos_address' => 'Address',
        'cos_position' => 'Position',
        'cos_salary' => 'Salary',
        'cos_office' => 'Office',
        'cos_from' => 'Effectivity From',
        'cos_to' => 'Effectivity To',
        'cos_charging' => 'Charging',
        'cos_receive' => 'Receive Date',
        'sign1' => 'First Witness',
        'signrank1' => 'First Witness Position'
    ];

    $errors = [];
    foreach ($required_fields as $field => $label) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = "$label is required";
        }
    }

    // Validate duties
    if (empty($_POST['duties']) || empty(trim($_POST['duties'][0]))) {
        $errors[] = "At least one duty is required";
    }

    if (empty($errors)) {
        $cos_name = mysqli_real_escape_string($conn, $_POST['cos_name']);
        $cos_address = mysqli_real_escape_string($conn, $_POST['cos_address']);
        $cos_position = mysqli_real_escape_string($conn, $_POST['cos_position']);
        $cos_salary = mysqli_real_escape_string($conn, $_POST['cos_salary']);
        $cos_office = mysqli_real_escape_string($conn, $_POST['cos_office']);
        $cos_from = mysqli_real_escape_string($conn, $_POST['cos_from']);
        $cos_to = mysqli_real_escape_string($conn, $_POST['cos_to']);
        $cos_id = mysqli_real_escape_string($conn, $_POST['cos_id']);
        $cos_charging = mysqli_real_escape_string($conn, $_POST['cos_charging']);
        $cos_receive = mysqli_real_escape_string($conn, $_POST['cos_receive']);
        $sign1 = mysqli_real_escape_string($conn, $_POST['sign1']);
        $sign2 = mysqli_real_escape_string($conn, $_POST['sign2']);
        $signrank1 = mysqli_real_escape_string($conn, $_POST['signrank1']);
        $signrank2 = mysqli_real_escape_string($conn, $_POST['signrank2']);

        // Check if ID already exists
        $check_sql = "SELECT * FROM employees WHERE cos_id = '$cos_id'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "ID Number already exists";
        } else {
            $sql = "INSERT INTO employees(`cos_name`, `cos_address`, `cos_position`, `cos_salary`,`cos_office`,`cos_from`,`cos_to`,`cos_charging`,`cos_receive`,`cos_id`,`sign1`,`sign2`,`signrank1`,`signrank2`) 
                    VALUES ('$cos_name','$cos_address','$cos_position','$cos_salary','$cos_office','$cos_from','$cos_to','$cos_charging','$cos_receive','$cos_id','$sign1','$sign2','$signrank1','$signrank2')";

            if (mysqli_query($conn, $sql)) {
                $employee_id = $conn->insert_id;

                // Insert duties
                $duties_success = true;
                foreach ($_POST['duties'] as $duty) {
                    if (!empty(trim($duty))) {
                        $duty = mysqli_real_escape_string($conn, $duty);
                        $query3 = "INSERT INTO df(cos_id, duties) VALUES ('$cos_id', '$duty')";
                        if (!mysqli_query($conn, $query3)) {
                            $duties_success = false;
                            break;
                        }
                    }
                }

                if ($duties_success) {
                    header("Location: index.php?msg=Data Added successfully");
                    exit();
                } else {
                    $errors[] = "Error adding duties";
                }
            } else {
                $errors[] = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Contract of Service</title>

   <!-- Add this CSS in the head section or in your stylesheet -->
   <style>
      .duties-input::-webkit-calendar-picker-indicator {
         display: none !important;
      }
      input.duties-input {
         width: 100%;
      }
      datalist {
         max-height: 300px;
         overflow-y: auto;
      }
      .error-message {
         color: red;
         margin-bottom: 15px;
      }
      .required-field::after {
         content: " *";
         color: red;
      }
   </style>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Contract of Service
   </nav>

   <div class="container">
      <div class="text-center">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <?php if (!empty($errors)): ?>
         <div class="alert alert-danger">
            <ul class="mb-0">
               <?php foreach ($errors as $error): ?>
                  <li><?php echo $error; ?></li>
               <?php endforeach; ?>
            </ul>
         </div>
      <?php endif; ?>

      <form action="" autocomplete="on" method="post" class="row g-3" onsubmit="return validateForm()">
         <div class="col-md-2">
            <label class="form-label required-field">Id Number</label>
            <input type="text" class="form-control" name="cos_id" placeholder="" required>
         </div>

         <div class="col-md-10">
            <label class="form-label required-field">Name</label>
            <input type="text" class="form-control" name="cos_name" placeholder="" required>
         </div>

         <div class="col-md-8">
            <label class="form-label required-field">Address</label>
            <input type="text" class="form-control" name="cos_address"
               placeholder="" required>
         </div>
         <div class="col-md-2">
            <label class="form-label required-field">Position</label>
            <input type="text" class="form-control" name="cos_position" placeholder="" required>
         </div>
         <div class="col-md-2">
            <label class="form-label required-field">Salary</label>
            <input type="text" class="form-control" name="cos_salary" placeholder="" required>
         </div>
         <div class="col-md-4">
            <label class="form-label required-field">Office</label>
            <input type="text" class="form-control" name="cos_office" placeholder="" required>
         </div>
         <div class="col-md-2">
            <label class="form-label required-field">Effectivity from</label>
            <input type="text" class="form-control" name="cos_from" placeholder="From" required>
         </div>
         <div class="col-md-2">
            <label class="form-label required-field">Effectivity to</label>
            <input type="text" class="form-control" name="cos_to" placeholder="To" required>
         </div>
         <div class="col-md-4">
            <label class="form-label required-field">Charging</label>
            <input type="text" class="form-control" name="cos_charging" placeholder="Other MOOE" required>
         </div>
         <div class="col-md-12">
            <div id="dynamic_field3">
               <div class="form-row">
                  <div class="col-md-12">
                     <label class="form-label required-field">Duties and Function</label>
                     <input type="text" class="form-control duties-input" name="duties[]" list="dutiesList" placeholder="Duties and Function" required>
                     <datalist id="dutiesList">
                        <?php foreach($duties_list as $duty): ?>
                           <option value="<?php echo htmlspecialchars($duty); ?>">
                        <?php endforeach; ?>
                     </datalist>
                  </div>
                  <div class="col-md-2">
                     <button type="button" name="add" id="add3" class="btn btn-success"><i
                           class="fa fa-plus"></i></button>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-4">
            <label class="form-label required-field">Receive Date</label>
            <input type="text" class="form-control" name="cos_receive" placeholder="" required>
         </div>
         <div class="col-2">
            <label class="form-label required-field">First Witness</label>
            <input type="text" class="form-control" name="sign1" placeholder="Head of Office" required>
         </div>
         <div class="col-2">
            <label class="form-label required-field">First Witness Position</label>
            <input type="text" class="form-control" name="signrank1" placeholder="Position" required>
         </div>
         <div class="col-2">
            <label class="form-label">Second Witness</label>
            <input type="text" class="form-control" name="sign2" placeholder="Optional">
         </div>
         <div class="col-2">
            <label class="form-label">Second Witness Postion</label>
            <input type="text" class="form-control" name="signrank2" placeholder="Optional">
         </div>
         <div class="col-12">
            <button type="submit" class="btn btn-success" name="submit">Save</button>
            <a href="index.php" class="btn btn-danger">Cancel</a>
         </div>
      </form>
   </div>


   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>


   <script>
      $(document).ready(function () {
         var i = 1;

         $('#add3').click(function () {
            i++;
            $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"> <div class="col"> <input type="text" class="form-control duties-input" list="dutiesList" name="duties[]"> </div> <div class="col"><button type="button" name="add" class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa fa-trash"></i></button></div> </div>');
         });
         $(document).on('click', '.btn_remove3', function () {
            var button_id = $(this).attr("id");

            $('#row3' + button_id + '').remove();
         });


      });

      function validateForm() {
         let isValid = true;
         const requiredFields = document.querySelectorAll('[required]');
         
         requiredFields.forEach(field => {
            if (!field.value.trim()) {
               isValid = false;
               field.classList.add('is-invalid');
            } else {
               field.classList.remove('is-invalid');
            }
         });

         // Check if at least one duty is filled
         const duties = document.getElementsByName('duties[]');
         let hasDuty = false;
         for (let duty of duties) {
            if (duty.value.trim()) {
               hasDuty = true;
               break;
            }
         }
         
         if (!hasDuty) {
            isValid = false;
            duties[0].classList.add('is-invalid');
         }

         return isValid;
      }
   </script>

</body>

</html>