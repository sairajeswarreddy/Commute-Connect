<?php
include 'db_connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ride_id = (int)$_POST['ride_id'];

    // Fetch the ride details
    $sql = "SELECT * FROM rides WHERE id = $ride_id AND status = 'Available'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $ride = $result->fetch_assoc();

        // Mark the ride as "Booked"
        $sql_update = "UPDATE rides SET status = 'Booked' WHERE id = $ride_id";

        // Insert into "Requested Rides" for the current user
        $sql_insert = "INSERT INTO rides (name, pickup_point, destination_point, pick_date, pick_time, type, status)
                       VALUES ('Guest', '{$ride['pickup_point']}', '{$ride['destination_point']}', '{$ride['pick_date']}', '{$ride['pick_time']}', 'Requested', 'Booked')";

        if ($conn->query($sql_update) === TRUE && $conn->query($sql_insert) === TRUE) {
            echo "<script>alert('Ride booked successfully'); window.location.href = 'myrides.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Ride is no longer available'); window.location.href = 'find_a_ride.php';</script>";
    }

    $conn->close();
}
?>
