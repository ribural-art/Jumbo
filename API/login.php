<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$phone = $data['phone'];

// IKI NICYO CEO PASSWORD YAWE
if($name === 'riburalearnmoneyeazy@gmail.com' && $phone === '0780046617'){
    echo json_encode(['isAdmin' => true]);
} else {
    echo json_encode(['isAdmin' => false, 'name' => $name]);
}
?>
