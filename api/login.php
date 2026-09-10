<?php
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

$name = $input['name'];
$phone = $input['phone'];

// IBI BIRAFUNGUYE - BISHYIRE IBYAWE
$SUPABASE_URL = "https://xxxx.supabase.co"; 
$SUPABASE_KEY = "eyJhbGc...";

// 1. SHYAKA UMUKILIKIYA
$ch = curl_init($SUPABASE_URL . "/rest/v1/users?phone=eq." . $phone);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["apikey: $SUPABASE_KEY", "Authorization: Bearer $SUPABASE_KEY"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$user = json_decode(curl_exec($ch), true);

// 2. NIBA ATARIHO UMWANDIKISHE
if(empty($user)){
    $referral = "JUMBO" . substr(str_shuffle("ABCDEF123456"),0,6);
    $data = json_encode(["name"=>$name, "phone"=>$phone, "referral_code"=>$referral]);
    $ch = curl_init($SUPABASE_URL . "/rest/v1/users");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["apikey: $SUPABASE_KEY", "Authorization: Bearer $SUPABASE_KEY", "Content-Type: application/json"]);
    curl_exec($ch);
}

// 3. REBA NIBA ARI ADMIN
$isAdmin = ($input['email'] == "riburalearnmoneyeazy@gmail.com");

echo json_encode(["success"=>true, "isAdmin"=>$isAdmin]);
?>
