<style>

  h2 {
    font-weight: 600;
    font-size: 24px;
    margin-top: 2rem;
    margin-bottom: 0.75rem;
    color: #111827;
  }

  p {
    margin-bottom: 1rem;
  }

  ul {
    list-style-type: disc;
    margin-left: 1.25rem;
    margin-bottom: 1rem;
  }

  #about-title {
    text-align: center;
  }

  #about {
    width: 90%;
    border-radius: 8px;
    padding: 20px;
    margin: auto;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

</style>

<?php
require_once __DIR__ . '/../../../commons/Connection.php';
$db = new Connection();
$connection = $db::$connection;
$query = "SELECT * FROM about LIMIT 1";
$result = $connection->query($query);
$about = $result->fetch_assoc();
?>
<main>
  <div id="about">
    <h1 id="about-title"><?= $about['title'] ?></h1>
    <p><?= $about['body'] ?></p>
  </div>
</main>
