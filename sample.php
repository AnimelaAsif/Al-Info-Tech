<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $destination = $_POST['destination'];
    $departure = $_POST['departure'];
    $return = $_POST['return'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $message = $_POST['message'];

    // Email details
    $to = "animelaasif@gmail.com";
    $subject = "New Travel Booking";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nDestination: $destination\nDeparture Date: $departure\nReturn Date: $return\nAdults: $adults\nChildren: $children\nAdditional Requests: $message";

    // Send email
    if (mail($to, $subject, $body)) {
        echo "Thank you for your booking! We will contact you shortly.";
    } else {
        echo "Sorry, there was an error processing your request. Please try again later.";
    }
}
?>
