<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Table</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    
    <?php
    include 'config.php';

    try {
        $query = "SELECT * FROM events";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

       // Start HTML table
       echo '
       <h2 class="event-heading">Events</h2>
       <div style="overflow-x:auto;" class="event-table-container">
           <table class="event-table">
               <tr>
                   <th class="event-table-header">No</th>
                   <th class="event-table-header">Start</th>
                   <th class="event-table-header">End</th>
                   <th class="event-table-header">Message</th>
               </tr>';

   // Loop through the results and populate the table rows
   foreach ($result as $row) {
       echo '<tr class="event-table-row">
               <td class="event-table-data">' . $row["evt_id"] . '</td>
               <td class="event-table-data">' . $row["evt_start"] . '</td>
               <td class="event-table-data">' . $row["evt_end"] . '</td>
               <td class="event-table-data">' . $row["evt_text"] . '</td>
           </tr>';
   }

   // Close the HTML table
   echo '</table>
       </div>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>

</body>

</html>