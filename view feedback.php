<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js"></script>
</head>
<body>
    <h1>Feedback Records</h1>
    <button id="toggleButton">Click here to see the feedback</button>
    <div id="feedbackContainer" style="display:none;">
        <?php
        // Establish a connection to the campaign_feedback database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "campaign_feedback";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Implement pagination
        $limit = 10;  // Number of entries to show in a page.
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $limit;

        // Write a SQL query to select all records from the feedback table
        $sql = "SELECT * FROM feedback ORDER BY submission_date DESC LIMIT $start_from, $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display the retrieved data in an HTML table on the web page
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        <th>Date</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["feedback"] . "</td>
                        <td>" . $row["rating"] . "</td>
                        <td>" . $row["submission_date"] . "</td>
                      </tr>";
            }
            echo "</table>";

            // Pagination
            $sql = "SELECT COUNT(id) FROM feedback";
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            $total_records = $row[0];
            $total_pages = ceil($total_records / $limit);
            $pagLink = "<div class='pagination'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                $pagLink .= "<a href='view feedback.php?page=" . $i . "'>" . $i . "</a>";
            }
            echo $pagLink . "</div>";
        } else {
            echo "No records found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
