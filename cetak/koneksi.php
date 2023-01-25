<?php

$mysqli = new mysqli('localhost', 'root', '', 'dbsimrs');

if ($mysqli->connect_errno) {

    die('kesalahan saat membuat koneksi ke database. <br>' . $mysqli->error);
}
