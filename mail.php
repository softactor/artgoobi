<?php
    ini_set("SMTP", "mail.artgoobi.com");
    ini_set("sendmail_from", "info@artgoobi.com");

    $message = "The mail message was sent with the following mail setting:\r\nSMTP = aspmx.l.google.com\r\nsmtp_port = 25\r\nsendmail_from = YourMail@address.com";

    $headers = "From: info@artgoobi.com";


    mail("tanveerqureshee1@gmail.com", "Testing", $message, $headers);
    echo "Check your email now....<BR/>";
?>