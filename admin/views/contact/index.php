<?php
require_once __DIR__ . '/../../../commons/Connection.php';

$db = new Connection();
$connection = $db::$connection;

$query = "SELECT * FROM contact ORDER BY id DESC LIMIT 1";
$result = $connection->query($query);
$contact = $result->fetch_assoc();
if ($result && $result->num_rows > 0) {
} else {
      $contact = array(
    "google_map"=> "",
    "phone"=> "",
    "email"=> "",
    "address" => "",
  );
}

?>

<style>
  h1 {
    font-weight: 700;
    font-size: 48px;
    line-height: 1.1;
    color: #111827;
    margin-bottom: 2rem;
    user-select: none;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  label {
    font-weight: 600;
    color: #374151;
    font-size: 1rem;
    user-select: none;
  }

  input[type="text"],
  input[type="email"] {
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border-radius: 0.5rem;
    border: 1.5px solid #d1d5db;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-family: inherit;
  }

  input[type="text"]:focus,
  input[type="email"]:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
    outline: none;
  }

  button[type="submit"] {
    padding: 1rem;
    font-weight: 700;
    background-color: #111827;
    color: white;
    font-size: 1.125rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s ease;
  }

  button[type="submit"]:hover,
  button[type="submit"]:focus-visible {
    background-color: #2563eb;
    outline: none;
  }
</style>
<h1 id="page-title">Contact Details</h1>
<form method="POST" action="/labor_application/admin/actions/update_contact.php" novalidate>
  <label for="google_map">Google Map Link</label>
  <input id="google_map" name="google_map" type="text" required value="<?= htmlspecialchars($contact['google_map']); ?>"
    placeholder="Google Maps Embed URL" autocomplete="off" />

  <label for="phone">Phone</label>
  <input id="phone" name="phone" type="text" required value="<?= htmlspecialchars($contact['phone']); ?>"
    placeholder="Phone Number" autocomplete="tel" />

  <label for="email">Email</label>
  <input id="email" name="email" type="email" required value="<?= htmlspecialchars($contact['email']); ?>"
    placeholder="Email Address" autocomplete="email" />
  <label for="address">Address</label>
  <input type="text" name="address" id="address" placeholder="Address" required value="<?= htmlspecialchars($contact['address']); ?>">
  <button type="submit">Submit</button>
</form>