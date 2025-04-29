<?php
require_once 'config.php';

// Fetch existing job orders
$query = "SELECT * FROM job_orders";
$result = $conn->query($query);
$jobOrders = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $jobOrders[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plantilla</title>
    <link rel="stylesheet" href="style.css" />
    <style>
      .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 4px;
        color: white;
        font-weight: bold;
        z-index: 1000;
        animation: slideIn 0.5s ease-in-out;
        display: none;
      }

      .notification.success {
        background-color: #4CAF50;
      }

      .notification.error {
        background-color: #f44336;
      }
      .button-container {
        position: absolute;
        top: 30px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 30px;
      }

      .button-container button {
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
        border-color: black;
        background-color: white; /* Default background color */
        color: black; /* Default text color */
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
      }

      .button-container button:hover {
          background-color: black; /* Change background to black */
          color: white; /* Change text color to white for contrast */
      }

      .back-btn {
          background-color: white;
          color: black;
      }

      @keyframes slideIn {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
    </style>
  </head>
  <body>
    <div id="notification" class="notification"></div>
    <div class="button-container">
        <button class="back-btn" onclick="goBack()">← Back</button>
    </div>
    <div class="header">
      <div class="logo">
        <img src="images/sibagat.png" />
      </div>
      <h1>JOB ORDER</h1>
    </div>

    <div class="table">
      <form id="jobOrderForm">
        <table>
          <tr>
            <th rowspan="2">NAME</th>
            <th rowspan="2">DESIGNATION</th>
            <th rowspan="2">RATE/DAY</th>
            <th colspan="2">PERIOD OF JOB ORDER</th>
            <th rowspan="2">FUNDING CHARGES</th>
            <th rowspan="2">OFFICE ASSIGNMENT</th>
            <th rowspan="2">ACKNOWLEDGEMENT</th>
          </tr>
          <tr>
            <th>FROM</th>
            <th>TO</th>
          </tr>
          <tr>
            <td>
              <textarea id="name" name="name" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="designation" name="designation" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="rate" name="rate" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="dateFrom" name="dateFrom" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="dateTo" name="dateTo" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="funding" name="funding" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="office" name="office" rows="30" cols="30"></textarea>
            </td>
            <td>
              <textarea id="acknowledgement" name="acknowledgement" rows="30" cols="30"></textarea>
            </td>
          </tr>
        </table>
        <div style="text-align: right; margin-top: 30px; margin-bottom: 20px; padding-right: 20px;">
          <button 
            style="padding: 12px 24px; 
                   background-color: #008245; 
                   color: #fff; 
                   border: 2px solid black;
                   border-radius: 5px;
                   font-size: 20px;
                   cursor: pointer;
                   transition: background-color 0.3s ease;"
            type="button" 
            onmouseover="this.style.backgroundColor='#006234'" 
            onmouseout="this.style.backgroundColor='#008245'"
            onclick="submitAndPrint()"
            class="submit-btn">
            Submit & Print Job Order
          </button>
        </div>
      </form>
    </div>

    <script>
      // Add this function to handle textarea input
      function handleTextareaInput(event) {
        const textarea = event.target;
        // When user presses Enter
        if (event.key === "Enter") {
          event.preventDefault(); // Prevent default enter behavior
          const cursorPosition = textarea.selectionStart;
          const currentValue = textarea.value;
          const currentLineNumber = currentValue
            .substr(0, cursorPosition)
            .split("\n").length;

          // Insert new numbered line
          const newLine = `${currentLineNumber + 1}. `;
          const beforeCursor = currentValue.substr(0, cursorPosition);
          const afterCursor = currentValue.substr(cursorPosition);
          textarea.value = beforeCursor + "\n" + newLine + afterCursor;

          // Place cursor after the new line number
          const newPosition = cursorPosition + newLine.length + 1;
          textarea.selectionStart = newPosition;
          textarea.selectionEnd = newPosition;
        }
      }

      function goBack() {
        window.location.href = 'main.php'; // Replace with your main page URL
      }

      // Add this to initialize textareas
      window.onload = function () {
        const textareas = document.getElementsByTagName("textarea");
        for (let textarea of textareas) {
          // Initialize first line number
          if (textarea.value === "") {
            textarea.value = "1. ";
          }
          // Add event listener for enter key
          textarea.addEventListener("keydown", handleTextareaInput);
        }

        // Check if we're in edit mode
        if (window.location.hash === '#edit' && localStorage.getItem('isEditing') === 'true') {
          // Load saved data from localStorage
          const fields = [
            "name",
            "designation",
            "rate",
            "dateFrom",
            "dateTo",
            "funding",
            "office",
            "acknowledgement",
          ];

          fields.forEach(field => {
            const savedValue = localStorage.getItem(field);
            if (savedValue) {
              document.getElementById(field).value = savedValue;
            }
          });

          // Clear the edit flag
          localStorage.removeItem('isEditing');
          
          // Show notification
          showNotification('Edit mode: Your previous data has been loaded', 'success');
        }
      };

      function showNotification(message, type) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = 'notification ' + type;
        notification.style.display = 'block';

        // Hide after 3 seconds
        setTimeout(() => {
          notification.style.display = 'none';
        }, 3000);
      }

      function submitAndPrint() {
        // Check if textareas are empty
        const fields = [
          "name",
          "designation",
          "rate",
          "dateFrom",
          "dateTo",
          "funding",
          "office",
          "acknowledgement",
        ];

        let emptyFields = [];

        fields.forEach((field) => {
          const textarea = document.getElementById(field);
          const value = textarea.value;
          if (!value || value === "" || value === "1. ") {
            emptyFields.push(field.charAt(0).toUpperCase() + field.slice(1));
          }
        });

        if (emptyFields.length > 0) {
          showNotification("Please fill in all required fields: " + emptyFields.join(", "), "error");
          return;
        }

        // Create form data
        const formData = new FormData(document.getElementById('jobOrderForm'));

        // Save the job order
        fetch('save_job_order.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (response.redirected) {
            const url = new URL(response.url);
            const status = url.searchParams.get('status');
            const count = url.searchParams.get('count');
            
            if (status === 'success') {
              showNotification(`Successfully saved ${count} job order(s)!`, 'success');
              
              // Store the form data in localStorage for printing
              fields.forEach((field) => {
                const textarea = document.getElementById(field);
                localStorage.setItem(field, textarea.value);
              });

              // Navigate to print page
              window.location.href = "JO-print.php";
            } else {
              const errorCount = url.searchParams.get('error');
              showNotification(`Saved ${count} job order(s), but ${errorCount} failed.`, 'error');
            }
          }
        })
        .catch(error => {
          showNotification('An error occurred while saving the job order.', 'error');
        });
      }
    </script>
  </body>
</html> 