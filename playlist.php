<?php include("includes/includedFiles.php");

// Check if playlist ID is set in the URL
if(isset($_GET['id'])) {
    $playlistId = $_GET['id'];
} else {
    // Redirect to index.php if playlist ID is not provided
    header("Location: index.php");
    exit(); // Terminate script execution after redirection
}

// Retrieve playlist information
$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<div class="entityInfo">
    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png">
        </div>
    </div>

    <div class="rightSection">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $owner->getUsername(); ?></p>
        <p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
        <!-- Check if the user owns the playlist before displaying delete button -->
        <?php if($userLoggedIn->getUsername() == $owner->getUsername()): ?>
            <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>
        <?php endif; ?>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        // Retrieve the array of song IDs in the playlist
        $songIdArray = $playlist->getSongIds();

        $i = 1;
        foreach($songIdArray as $songId) {
            // Create Song object for each song in the playlist
            $playlistSong = new Song($con, $songId);
            $songArtist = $playlistSong->getArtist();

            echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $playlistSong->getTitle() . "</span>
                        <span class='artistName'>" . $songArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <input type='hidden' class='songId' value='" . $playlistSong->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $playlistSong->getDuration() . "</span>
                    </div>
                </li>";

            $i++;
        }
        ?>

        <!-- Convert song ID array to JSON for JavaScript use -->
        <script>
            var tempSongIds = <?php echo json_encode($songIdArray); ?>;
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<!-- Options menu for playlist songs -->
<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <!-- Display dropdown menu to select other playlists -->
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
    <!-- Option to remove song from playlist -->
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>
</nav>
