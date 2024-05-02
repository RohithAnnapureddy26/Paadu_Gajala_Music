<?php
include("includes/includedFiles.php");
include("includes/config.php");
?>

<div class="playlistsContainer">

    <div class="gridViewContainer">
        <h2>PLAYLISTS</h2>

        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist()">NEW PLAYLIST</button>
        </div>

        <?php
        // Get the username
        $username = $userLoggedIn->getUsername();

        // Prepare the statement to fetch playlists
        $playlistsQuery = $con->prepare("SELECT * FROM playlists WHERE owner=?");
        $playlistsQuery->bind_param("s", $username);
        $playlistsQuery->execute();

        // Check for errors
        if ($playlistsQuery->errno) {
            echo "<span class='error'>Error fetching playlists: " . $playlistsQuery->error . "</span>";
        }

        // Get result
        $result = $playlistsQuery->get_result();

        // Check if there are any playlists
        if ($result->num_rows == 0) {
            echo "<span class='noResults'>You don't have any playlists yet.</span>";
        } else {
            // Fetch and display playlists
            while ($row = $result->fetch_assoc()) {
                try {
                    // Create a new Playlist object
                    $playlist = new Playlist($con, $row);

                    // Display playlist information
                    echo "<div class='gridViewItem' role='link' tabindex='0' 
                            onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>

                        <div class='playlistImage'>
                            <img src='assets/images/icons/playlist.png'>
                        </div>
                        
                        <div class='gridViewInfo'>"
                    . $playlist->getName() .
                    "</div>

                    </div>";
                } catch (Exception $e) {
                    // Handle any exceptions thrown during playlist creation
                    echo "<span class='error'>" . $e->getMessage() . "</span>";
                }
            }
        }

        // Close the statement
        $playlistsQuery->close();
        ?>
    </div>
</div>
