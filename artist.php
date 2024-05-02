<?php
include("includes/includedFiles.php");

// Check if artist ID is set in the URL
if(isset($_GET['id'])) {
    $artistId = $_GET['id'];
} else {
    // Redirect to index.php if artist ID is not provided
    header("Location: index.php");
    exit(); // Terminate script execution after redirection
}

// Retrieve artist information
$artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName(); ?></h1>
            <div class="headerButtons">
                <button class="button green" onclick="playFirstSong()">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        <?php
        // Retrieve song IDs for the artist
        $songIdArray = $artist->getSongIds();

        // Display up to 5 songs
        $i = 1;
        foreach($songIdArray as $songId) {
            if($i > 5) {
                break;
            }

            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>
                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>
                    <div class='trackOptions'>
                        <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>
                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                </li>";

            $i++;
        }
        ?>
        <!-- Convert song ID array to JSON for JavaScript use -->
        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php
    // Retrieve albums for the artist
    $albumQuery = $con->prepare("SELECT id, title, artworkPath FROM albums WHERE artist=?");
    $albumQuery->bind_param("s", $artistId);
    $albumQuery->execute();
    $result = $albumQuery->get_result();

    while($row = $result->fetch_assoc()) {
        echo "<div class='gridViewItem'>
                <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                    <img src='" . $row['artworkPath'] . "'>
                    <div class='gridViewInfo'>" . $row['title'] . "</div>
                </span>
            </div>";
    }

    // Close the prepared statement
    $albumQuery->close();
    ?>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>
