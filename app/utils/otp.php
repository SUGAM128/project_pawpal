<?php
function generateOtp() {
    return rand(100000, 999999); // Generate a random 6-digit OTP
}

function sendOtp($email, $otp) {
    // Logic to send OTP to user's email
    // You can use mail() function or any email sending library/service
    $subject = "Your OTP Code";
    $message = "Your OTP code is: " . $otp;
    $headers = "From: no-reply@furreverfriends.com";
    
    mail($email, $subject, $message, $headers);
}