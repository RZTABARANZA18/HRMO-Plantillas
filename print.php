<?php
include "db_conn.php";

?>
<!DOCTYPE html>
<html>

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>CONTRACT OF SERVICE </title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.4;
                width: 8.5in;
                height: 14in;
                margin: 0 auto;
                padding: 1in;
                box-sizing: border-box;
                font-size: 19px;
            }

            @media print {
                @page {
                    size: legal;
                    margin: 0.30in;
                }

                body {
                    width: 100%;
                    height: 100%;
                    margin: 0;
                    padding: 0.5in;
                }

                .page-break {
                    page-break-before: always;
                }

                #print-button {
                    display: none;
                }
            }

            .vertical-text {
                writing-mode: vertical-rl;
                transform: rotate(180deg);
            }

            .sidebar {
                font-size: small;
                width: .5em;
                float: left;
                margin-left: -2em;
            }

            #sibagatlogo {
                float: left;
                width: 125px;
                height: 125px;
                margin-left: 15%;
                margin-top: -3%;

            }

            table {
                width: 110%;
                border-collapse: collapse;
            }

            th,
            td {
                border: none;
                padding: .3%;
                font-size: 16px;
            }

            th {
                background-color: none;
            }

            li {
                padding-left: 1em;
                margin-left: 2em;
                text-align: justify;
                page-break-inside: avoid;
            }

            td:empty {
                border-bottom: 1px solid;
            }

            #notary {

                text-align: right;
                margin-right: 5em;
            }

            .textright {

                text-align: right;
            }

            .page-break {
                page-break-after: always;
                page-break-inside: avoid;
            }

            .tab {
                margin-left: 2em;
            }

            .duties-list {
                page-break-inside: avoid;
                display: block;
            }

            li li {
                page-break-inside: avoid;
            }
        </style>


        <script>
            function printPage() {
                window.print();
            }
        </script>

    </head>

<body>

    <?php
    $cos_id = $_GET['cos_id'];

    $sql = "SELECT * FROM employees WHERE cos_id = '$cos_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("query Failed" . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_array($result);
    }

    if (mysqli_num_rows($result) > 0) {

    } else {
        echo "No data found";
    }
    ?>
    <button id="print-button" onclick="printPage()">Print</button>
    <form action="" method="GET">
        <div class="page">
            <img src="images/sibagat.png" id="sibagatlogo"
                alt="SIBAGAT LOGO">
            <p style="margin-top: auto; margin-bottom: auto; padding-left: 37.8%;">Republic of the Philippines</p>
            <p style="margin-top: auto; margin-bottom: auto; padding-left: 37.5%;">Province of Agusan del Sur</p>
            <p style="margin-top: auto; margin-bottom: auto; padding-left: 37%;">MUNICIPALITY OF SIBAGAT</b></p><br><br>
            <center>
                <h3><b>OFFICE OF THE MUNICIPAL MAYOR</b></h3>
            </center>
            <hr style="height:8px;border-width:100%;color:black;background-color:black; ">

            <center>

                <h3><b>CONTRACT OF SERVICE</b></h3>

            </center>
            <br>
            <p>&emsp;&emsp;<span>This CONTRACT entered into by and between the Municipality of Sibagat, Agusan del
                </span> Sur represented by <b>HON. THELMA G. LAMANILAO, MD.</b> Municipal Mayor, hereinafter referred to
                as the "<b>FIRST PARTY</b>".</p>

            <center>
                <p>-and-</p>
            </center>

            <p><b>&emsp;&emsp;
                    <?php echo $row['cos_name']; ?>
                </b>, legal age, Filipino and with residence address at
                <?php echo $row['cos_address']; ?>, hereinafter referred to as the "<b>Second party</b>".
            </p>
            <ol class="tab3">
                <div class="sidebar">
                    <div class="vertical-text">THELMA G. LAMANILAO, MD.
                    </div>
                    <div class="vertical-text">
                        &emsp13;&emsp13;&emsp13;
                        <?php echo $row['cos_name']; ?>&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;
                    </div>
                    <div class="vertical-text">&emsp13;&emsp13;&emsp13;GRACE S. BARES,RN&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;</div>

                    <div class="vertical-text">
                        &emsp13;&emsp13;&emsp13;
                        <?php echo $row['sign1']; ?>&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;
                    </div>
                    <div class="vertical-text">
                        &emsp13;&emsp13;&emsp13;
                        <?php echo $row['sign2']; ?>
                    </div>
                </div>
                <center>
                    <p>-WITNESSETH-</p>
                </center>
                <br>
                <li> That the First Party is in need of the services of the Second party who shall perform work not
                    performed by the regular personnel of the First Party.</li><br>
                <li> That the Second Party has signified his/her intention, to which the First Party has accepted, to
                    provide the service needed by the latter;</li><br>

                <li> That the Second Party hereby possessed the experience and skills required to perform the job as
                    described herein;</li>
                <br>
                <li> That in view hereof, the Second Party is hereby contracted as
                    <?php echo $row['cos_position']; ?> assigned at the
                    <?php echo $row['cos_office']; ?> of the Municipality of Sibagat, Agusan del Sur effective
                    <?php echo $row['cos_from']; ?> to
                    <?php echo $row['cos_to']; ?>,
                     in consideration of ₱
                    <?php echo $row['cos_salary']; ?> per month equivalent to one hundred sixty (160) hours of services
                    rendered per month, and entitled to overtime pay upon exigency of the service by a memorandum issued
                    by the First party, chargeable to
                    <?php echo $row['cos_charging']; ?>.
                </li>
                <br>
                <li> That the Second Party may claim travelling expenses and seminar in connection of his/her functions and duties herein specified, provided it is needed in the exigency of service and
                duly approved by the first party; Provided, further, that it is supported with a specific written order by the First Party.</li>
                <br>

                <li class="duties-list"> That the Second Party is expected to perform the following duties and responsibilities:
                    <li style="margin-left: 4em; display: block; page-break-inside: avoid;">
                        <?php
                        function displaySecondTable($conn, $cos_id)
                        {
                            $query2 = "SELECT duties FROM `df` WHERE cos_id = '$cos_id'";
                            $result2 = mysqli_query($conn, $query2);

                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                echo '<div style="page-break-inside: avoid;">';
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo $row2['duties'] . "<br>";
                                }
                                echo '</div>';
                            } else {
                                echo "No duties data found.";
                            }
                        }
                        displaySecondTable($conn, $cos_id); ?>
                    </li>
                </li>
                <br>
                <li> That the Second Party shall perform work at a time and schedule to be agreed upon both parties
                    and
                    as required by law.</li>
                <br>
                <li> That it is understood that this contract does not create an employer-employee relationship between
                    the First Party and the Second Party, that the services rendered hereunder are not considered and
                    will not be accredited as government service; </li>
            </ol>

            <p><b>IN WITNESS WHEREOF,</b> both parties have hereunto set their hands this
                <?php echo $row['cos_receive']; ?> at Sibagat, Agusan del Sur.
            </p>

            <p><b>LOCAL GOVERNMENT UNIT-SIBAGAT</b></p>

            <p>By</p>
            <br><br>

            <table>
                <tr>
                    <th>
                        <center>THELMA G. LAMANILAO, MD</center>
                    </th>
                    <th>
                        <center>
                            <?php echo $row['cos_name']; ?>
                        </center>
                    </th>
                </tr>
                <tr>
                    <td>
                        <center>Municipal Mayor</center>
                    </td>
                    <td>
                        <center>Second Party</center>
                    </td>
                </tr>
            </table>
            <br>
            <p> SIGNED IN THE PRESENCE OF:</p>
            <br><br>
            <table>
                <tr>
                    <th>
                        <center>GRACE S. BARES, RN</center>
                    </th>
                    <th>
                        <center>
                            <?php echo $row['sign1']; ?>
                        </center>
                    </th>
                </tr>
                <tr>
                    <td>
                        <center>HRMO II</center>
                    </td>
                    <td>
                        <center>
                            <?php echo $row['signrank1']; ?>
                        </center>
                    </td>
                </tr>
            </table><br><br><br>
            <table>
                <tr>
                    <th>
                        <center>
                            <?php echo $row['sign2']; ?>
                        </center>
                    </th>

                </tr>
                <tr>
                    <td>
                        <center>
                            <?php echo $row['signrank2']; ?>
                        </center>
                    </td>

                </tr>
            </table>
    </form>


    <div class="page-break">
        <center><br>
            <h3><b>ACKNOWLEDGEMENT</b> </h3>
        </center>
        <br>
        <p>REPUBLIC OF THE PHILIPPINES
            <br>PROVINCE OF AGUSAN DEL SUR, S.S.
            <br>MUNICIPALITY OF SIBAGAT
        </p><br>

        <p> BEFORE ME, a Notary Public for an in the above jurisdiction, personally appeared the following:</p>

        <table>
            <tr>
                <th>
                    <center>NAME </center>
                </th>
                <th>
                    <center>CTC NO./GOV. ISSUED ID </center>
                </th>
                <th>
                    <center>DATE/ PLACE ISSUED </center>
                </th>
            </tr>
            <tr>
                <td>THELMA G. LAMANILAO, MD.</td>
                <td></td>
                <td>&emsp;&emsp; /
                    <script>document.write(new Date().getFullYear())</script>, Sibagat, ADS
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $row['cos_name']; ?>
                </td>
                <td></td>
                <td>&emsp;&emsp; /
                    <script>document.write(new Date().getFullYear())</script>, Sibagat, ADS
                </td>
            </tr>
            <tr>
                <td>GRACE S. BARES</td>
                <td></td>
                <td>&emsp;&emsp; /
                    <script>document.write(new Date().getFullYear())</script>, Sibagat, ADS
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $row['sign1']; ?>
                </td>
                <td></td>
                <td>&emsp;&emsp; /
                    <script>document.write(new Date().getFullYear())</script>, Sibagat, ADS
                </td>
            </tr>
            <tr>
                <?php if (!empty($row['sign2'])): ?>
                    <td>
                        <?php echo $row['sign2']; ?>
                    </td>
                    <td></td>
                    <td class="tab2">&emsp;&emsp;&emsp;&emsp; /
                        <script>document.write(new Date().getFullYear())</script>, Sibagat, ADS
                    </td>
                <?php endif; ?>
            </tr>
        </table>
        <p>Known to me to be the named persons who executed the foregoing instrument and acknowledged to me that the
            same is their own free will and voluntary act and deed.</p>
        <p><span class="tab"></span>This instrument consists of three (3) pages including this page wherein this
            Acknowledgement is written, and is signed by the parties and their instrumental witnesses on each and
            every page hereof.</p>
        <p><span class="tab"></span>WITNESS MY HAND AND SEAL, this _________ day of _________,
            <script>document.write(new Date().getFullYear())</script> at Municipality of Sibagat, Province of Agusan
            del Sur, Philippines.
        </p>

        <div class="textright">
            <p>______________________________</p>
        </div>
        <div id="notary">
            <p>Notary Public</p>
        </div>



        <p>Doc No. ___________
            <br>Page No. __________
            <br>Book No. __________
            <br>Series of __________
        </p>
    </div>

</body>

</html>