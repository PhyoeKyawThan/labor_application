<?php

/**
 * Generates a mailto link with pre-filled subject and body.
 *
 * @param string $email The recipient's email address.
 * @param string $name The recipient's first name.
 * @param string $message The original message from the recipient.
 * @param string $replyMessage The reply message you want to send.
 * @return string The HTML mailto link.
 */
function generateMailtoLink(string $email, string $name, $subject, string $message, string $replyMessage): string
{
    // Sanitize inputs
    $email =$email;
    $name = htmlspecialchars($name);
    $message = htmlspecialchars($message);
    $replyMessage = htmlspecialchars($replyMessage);

    // URL encode the body
    $body = "Hi " . $name . ",\n\n" .
            $replyMessage . "\n\n" .
            "--- \n" .
            "Original Message: " . $message;

    $body = rawurlencode($body);

    $subject = rawurlencode("Re: ".$subject);

    $htmlLink = "<a href='mailto:".$email."?subject=".$subject."&body=".$body."'
       target='_blank'
       style='display:inline-block;margin-top:10px;color:white;background:#007bff;padding:8px 12px;border-radius:5px;text-decoration:none;'>
        Reply via Email
    </a>";
    return $htmlLink;
}
?>
