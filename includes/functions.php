<?php
function clean($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/maktoz/admin/login.php');
    }
}

function timeAgo($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;
    if ($diff < 60) return $diff . " seconds ago";
    if ($diff < 3600) return floor($diff/60) . " minutes ago";
    if ($diff < 86400) return floor($diff/3600) . " hours ago";
    return floor($diff/86400) . " days ago";
}

function createSlug($title) {
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return $slug;
}
?>
