<?php
function get_db_connection() {
    static $conn;
    if (!$conn) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    return $conn;
}

function get_book_by_id($id) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function get_all_books($search = '') {
    $conn = get_db_connection();
    $query = "SELECT * FROM books";
    if ($search) {
        $query .= " WHERE title LIKE ? OR author LIKE ?";
        $search_term = "%$search%";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $search_term, $search_term);
    } else {
        $stmt = $conn->prepare($query);
    }
    $stmt->execute();
    return $stmt->get_result();
}
?>