
<style>
    *{
        box-sizing: border-box;
    }
    main {
        width: fit-content;
        margin: 4rem auto 6rem auto;
        padding: 20px;
        background: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 10px 30px rgb(0 0 0 / 0.05);
        color: #6b7280;
        
    }

    main h2 {
        font-weight: 700;
        font-size: 36px; /* Adjusted font size */
        color: #111827;
        margin-bottom: 1rem;
    }

    main p {
        font-size: 16px; /* Adjusted font size */
        /* line-height: 1.6; */
    }

    main a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    main a:hover,
    main a:focus {
        color: #1e40af;
        text-decoration: underline;
    }

    .container {
        display: flex;
        gap: 20px; /* Increased gap for better spacing */
        
    }

    .contact-info {
        flex: 1; /* Allow contact info to take available space */
        display: flex;
        flex-direction: column;
        /* gap: 10px; Space between contact info items */
    }

    .map-container {
        border-radius: 0.75rem;
        overflow: hidden;
        margin-bottom: 1rem; /* Space below the map */
    }

    .map-container iframe {
        width: 100%;
        height: 300px; /* Adjusted height */
        border: 0;
    }

    .contact-form {
        flex: 1; /* Allow form to take available space */
        display: flex;
        flex-direction: column;
        gap: 1rem; /* Space between form fields */
    }

    .contact-form label {
        font-weight: 600;
        color: #374151;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1.5px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Added shadow */
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
        border-color: #2563eb;
        outline: none;
    }

    .contact-form button {
        padding: 0.75rem;
        background-color: #2563eb;
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Added shadow */
    }

    .contact-form button:hover {
        background-color: #1e40af;
    }
    
</style>
<?php 
require_once __DIR__ . '/../../../commons/Connection.php'; 

$db = new Connection();
$connection = $db::$connection;
// Fetch contact information
$query = "SELECT * FROM contact LIMIT 1"; // Assuming only one row for contact details
$result = $connection->query($query);
$contact = $result->fetch_assoc();
?>

<main role="main" aria-labelledby="contact-title">
    <h2 id="contact-title">Get in Touch</h2>
    <p>We’re here to help. If you have questions or need assistance, please contact the Ministry of Labor at:</p>
    <div class="container">
        <div class="contact-info">
            <div class="map-container">
                <iframe
                    src="<?= $contact['google_map'] ?>"
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
            <p>Email us at: <a href="mailto:<?= $contact['email'] ?>"><?= $contact['email'] ?></a></p>
            <p>Phone: <a href="tel:<?= $contact['phone'] ?>"><?= $contact['phone'] ?></a></p>
            <p>Address: <?= $contact['address'] ?></p>
        </div>

        <form class="contact-form" action="/labor_application/user/actions/submit_contact.php" method="POST">
            <?php
                if(isset($_GET['msg'])):
            ?>
                <h4 class="message" style="color: green; text-align: center;"><?= $_GET['msg'] ?></h4>
            <?php endif; ?>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required placeholder="Your Name" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Your Email" />

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required placeholder="Subject" />

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required placeholder="Your Message"></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</main>
