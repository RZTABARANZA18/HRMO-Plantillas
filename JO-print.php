<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Order Print</title>
    <link rel="stylesheet" href="print-style.css">
    <style>
        .button-container {
            position: absolute;
            top: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }
        
        .button-container button {
            padding: 8px 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
        }

        .edit-btn {
            background-color: #008245;
            color: white;
            margin-right: 50px;
        }

        @media print {
            .button-container {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="button-container">
        <button class="back-btn" onclick="goBack()">← Back</button>
        <button class="edit-btn" onclick="editData()">Edit Data</button>
    </div>
    <div class="header">
        <p>Republic of the Philippines</p>
        <p>Province of Agusan del Sur</p>
        <p style="font-size: 16px;">MUNICIPALITY OF SIBAGAT</p>
        <br>
        <h1>JOB ORDER</h1>
    </div>
    
    <div class="table">
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
            <tr id="dataRow">
                <!-- Data will be filled by JavaScript -->
            </tr>
        </table>

        <p>The said job order shall automatically cease upon its expiration as stipulated above, unless renewed. However, services of any or all of the above-named can be terminated prior to the expiration of this Job Order for lack of funds or when their services are no longer needed. The above-named hereby attest that he/she is not related within the third degree (fourth degree in case of LGUs) of consanquinity or affinity to the 1.) hiring authority and/or 2.) representatives of the hiring agency; that he/she has not been previously dismissed from government service by the reason of an administrative offense; that he/she has not already reached the compulsory retirement age of sixty-five (65). Furthermore the Service rendered is not considered or will never be accredited as government services. </p>
        <br>
        <div class="signature-title">
            <p><b>Prepared By:</b></p>
            <p style="margin-left: 400px;">Certified to the existence of Appropriation/Obligation:</p>   
            <p style="margin-left: 150px;">APPROVED:</p>
        </div>
        <br>

        <div class="signature">
            <p><b><u>GRACE S. BARES, RN</u></b></p>
            <p style="margin-left: 300px;"><b><u>DELIA M. HAGOPAR</u></b></p> 
            <p style="margin-left: 100px;"><b><u>DOREEN O. EVITE</u></b></p> 
            <p style="margin-left: 230px;"><b><u>THELMA G. LAMANILAO,MD.</u></b></p>
        </div>
        <div class="position">
            <p>HRMO II</p>
            <p style="margin-left: 356px;">Municipal Budget Office</p> 
            <p style="margin-left: 99px;">Municipal Accountant</p> 
            <p style="margin-left: 295px;">Municipal Mayor</p>
        </div>
    </div>

    <script>
    window.onload = function() {
        const fields = ['name', 'designation', 'rate', 'dateFrom', 'dateTo', 
                       'funding', 'office', 'acknowledgement'];
        
        const dataRow = document.getElementById('dataRow');
        
        fields.forEach(field => {
            const td = document.createElement('td');
            // Get the data and add line breaks after each number followed by a period
            const data = localStorage.getItem(field) || '';
            // Add line breaks after numbers followed by periods (e.g., "1.", "2.", etc.)
            const formattedData = data.replace(/(\d+\.\s*[^,\n]+)/g, '$1<br>');

            const lines = formattedData.split('<br>').filter(line => line.trim());
            if (lines.length > 0) {
                // Add centered XXXXXXX after the last non-empty line
                td.innerHTML = lines.join('<br>') + '<br><div style="text-align: center;">xxxxxxxxxxxx</div>';
            } else {
                td.innerHTML = formattedData;
            }

            td.style.padding = '10px';
            td.style.textAlign = 'left';
            td.style.verticalAlign = 'top';
            td.style.fontSize = '18px';
            dataRow.appendChild(td);
        });

        // Automatically trigger print dialog after a short delay to ensure everything is loaded
        setTimeout(() => {
            window.print();
        }, 500);
    }

    function goBack() {
        window.location.href = 'JO.php'; // Replace with your main page URL
    }

    function editData() {
        // Cancel the print operation if it's pending
        window.onbeforeprint = function() {
            window.onbeforeprint = null;
            return false;
        };
        
        // Set a flag in localStorage to indicate we're in edit mode
        localStorage.setItem('isEditing', 'true');
        
        // Navigate back to the form page
        window.location.href = 'JO.php#edit'; // Adding #edit hash to indicate edit mode
    }
    </script>
</body>
</html> 