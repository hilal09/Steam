<?php
if(isset($_GET['query']) && !empty($_GET['query'])) {
    // suchlogik
    $search_query = $_GET['query'];
    echo "You searched for: " . $search_query;
}
?>