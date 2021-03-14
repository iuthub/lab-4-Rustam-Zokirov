<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">

    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>

<div id="listarea">
    <?php
    if(isset($_REQUEST["playlist"]))
    {
        $playlist = $_REQUEST["playlist"];
        $songnames = file("songs/$playlist");
        foreach ($songnames as $songname)
        {
            $songs = array();
            array_push($songs, "songs/$songname");
            foreach ($songs as $song){
                ?>
                <ul id="musiclist">
                    <li class="mp3item">
                        <a href="<?= $song ?>"><?= $songname ?></a>
                    </li>
                </ul>
            <?php }}}
    else{

        $tracks = glob("songs/*.mp3");

        foreach ($tracks as $track)
        { $trackname = basename($track);

            ?>
            <ul id="musiclist">
                <li class="mp3item">
                    <a href="<?= $track ?>"><?= $trackname ?></a>
                    <?php
                    if(filesize($track) <= 1023 )
                        echo "(" . filesize($track) . " b)";
                    else if (filesize($track) >= 1023 && filesize($track) <= 1048575)
                        echo "(" . round(filesize($track)/1024, 2) . " kb)";
                    else
                        echo "(" . round(filesize($track)/(1024*1024), 2) . " mb)"; ?>
                </li>

            </ul>
        <?php } ?>

        <?php

        $playlists = glob("songs/*.txt");

        foreach ($playlists as $playlist)
        { $playlistname = basename($playlist);
            ?>
            <ul id="musiclist">
                <li class="playlistitem">
                    <a href="<?= $playlist ?>"><?= $playlistname ?></a>
                </li>
            </ul>

        <?php } } ?>
</div>
</body>
</html>


