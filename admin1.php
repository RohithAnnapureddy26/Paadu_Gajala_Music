<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #1db954;
            text-align: center;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #282828;
        }

        th {
            background-color: #1db954;
            color: white;
        }

        tr:hover {
            background-color: #333;
        }

        /* Form styling */
        form {
            background-color: #222;
            padding: 20px;
            border-radius: 5px;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"], input[type="button"] {
            background-color: #1db954;
            border: none;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #1a9341;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        input[type="button"]:active {
            transform: translateY(2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        input[type="button"]::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.5);
            width: 300%;
            height: 300%;
            transition: all 0.6s ease;
            border-radius: 50%;
            opacity: 0;
            z-index: -1;
        }

        input[type="button"]:hover::before {
            width: 0%;
            height: 0%;
            opacity: 1;
        }

        /* Image styling inside tables */
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        /* Error and success message styling */
        p {
            padding: 10px;
            border-radius: 5px;
        }

        .error {
            background-color: #c23b22; /* Redish tone for errors */
        }

        .success {
            background-color: #1db954; /* Green tone for success messages */
        }

        /* Additional styles for delete animation */
        @keyframes throwInBin {
            0% { transform: translateX(0) scale(1); opacity: 1; }
            50% { transform: translateX(150%) scale(0.5); opacity: 0.5; }
            100% { transform: translateX(300%) scale(0); opacity: 0; }
        }

        .deleted {
            animation: throwInBin 1s forwards;
        }
    </style>
</head>
<body>
    <h1> Admin Dashboard - Paadu Gajala </h1>
    <!-- Your PHP and HTML content here -->

    <?php
    include 'includes/config.php';  // Ensure this file properly configures the connection to your database

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['deleteUserId'])) {
            // Handle the deletion of users
            $userId = intval($_POST['deleteUserId']);
            $deleteQuery = "DELETE FROM users WHERE id = ?";
            if ($stmt = mysqli_prepare($con, $deleteQuery)) {
                mysqli_stmt_bind_param($stmt, "i", $userId);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<p>User deleted successfully.</p>";
                } else {
                    echo "<p>Error deleting user.</p>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Error preparing statement: " . mysqli_error($con) . "</p>";
            }
        } elseif (isset($_FILES['songFile'])) {
            // Handle the song file upload
            $title = mysqli_real_escape_string($con, $_POST['title']);
            $artist = intval($_POST['artist']);
            $album = intval($_POST['album']);
            $genre = intval($_POST['genre']);
            $duration = mysqli_real_escape_string($con, $_POST['duration']);
            $albumOrder = intval($_POST['albumOrder']);
            $plays = intval($_POST['plays']);
            $rating = intval($_POST['rating']);
            $artistdup = intval($_POST['artistdup']);

            if ($_FILES['songFile']['error'] === UPLOAD_ERR_OK) {
                $tempName = $_FILES['songFile']['tmp_name'];
                $originalName = basename($_FILES['songFile']['name']);
                $safeName = hash('sha256', $originalName . microtime()) . strrchr($originalName, '.');
                $songPath = "assets/music/" . $safeName;

                if (move_uploaded_file($tempName, $songPath)) {
                    // Prepare SQL Query to insert data into the songs table
                    $query = "INSERT INTO songs (title, artist, album, genre, duration, path, albumOrder, plays, Rating, artistdup) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    if ($stmt = mysqli_prepare($con, $query)) {
                        mysqli_stmt_bind_param($stmt, "siiisssiii", $title, $artist, $album, $genre, $duration, $songPath, $albumOrder, $plays, $rating, $artistdup);
                        mysqli_stmt_execute($stmt);
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            echo "<p>Song added successfully!</p>";
                        } else {
                            echo "<p>Error adding song.</p>";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<p>Error preparing statement: " . mysqli_error($con) . "</p>";
                    }
                } else {
                    echo "<p>Error uploading file.</p>";
                }
            } else {
                echo "<p>Error: " . $_FILES['songFile']['error'] . "</p>";
            }
        }
    }
?>


    <h2>All Users</h2>
    <table>
      <tr>
        <th>Profile Picture</th>
        <th>Username</th>
        <th>Email</th>
        <th>Sign Up Date</th>
        <th>Action</th>
      </tr>
      <?php
        $query = "SELECT id, username, email, signUpDate, profilePic FROM users";
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><img src='{$row['profilePic']}' alt='Profile Picture' style='width:50px;height:50px;'></td><td>{$row['username']}</td><td>{$row['email']}</td><td>{$row['signUpDate']}</td><td><form method='post'><input type='hidden' name='deleteUserId' value='{$row['id']}'><input type='submit' value='Delete'></form></td></tr>";
            }
            mysqli_free_result($result);
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
      ?>
    </table>

    <h2>Subscribed Users</h2>
    <table>
      <tr>
        <th>Profile Picture</th>
        <th>Username</th>
        <th>Email</th>
      </tr>
      <?php
        // SQL query to retrieve subscribed users and their information
        $query = "SELECT u.username, u.profilePic, u.email FROM users u INNER JOIN subscribed_users s ON u.username = s.username";
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><img src='{$row['profilePic']}' alt='Profile Picture' style='width:50px;height:50px;'></td><td>{$row['username']}</td><td>{$row['email']}</td></tr>";
            }
            mysqli_free_result($result);
        } else {
            echo "<tr><td colspan='3'>No subscribed users found</td></tr>";
        }
      ?>
    </table>


    <h2>Add New Song</h2>
    <form action="admin1.php" method="post" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="Song Title" required>
      <input type="number" name="artist" placeholder="Artist ID" required>
      <input type="number" name="album" placeholder="Album ID" required>
      <input type="number" name="genre" placeholder="Genre ID" required>
      <input type="text" name="duration" placeholder="Duration (e.g., 3:45)" required>
      <input type="file" name="songFile" required>
      <input type="number" name="albumOrder" placeholder="Album Order" required>
      <input type="number" name="plays" placeholder="Initial Plays" required>
      <input type="number" name="rating" placeholder="Rating" required>
      <input type="number" name="artistdup" placeholder="Duplicate Artist ID" required>
      <input type="submit" value="Add Song">
    </form>

    <script>
        // Add event listeners to delete buttons
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll('input[type="submit"][value="Delete"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Stop form from submitting immediately
                    const row = button.closest('tr'); // Find the parent row

                    // Apply animation
                    row.classList.add('deleted');

                    // Wait for animation to complete before submitting form
                    setTimeout(() => {
                        button.form.submit(); // Submit the form after the animation
                    }, 1000); // Adjust time to match animation duration
                });
            });
        });
    </script>
</body>
</html>
