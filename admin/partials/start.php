<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sidebar Navigation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap');

        :root {
            --bg-color: #ffffff;
            --sidebar-bg: #f9fafb;
            --primary-color: #2563eb;
            --text-color: #374151;
            --text-hover: #1d4ed8;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI',
                Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji';
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            max-height: 100vh;
            overflow: hidden;
        }

        nav {

            background-color: var(--sidebar-bg);
            width: 220px;
            max-height: 100vh;
            padding: 2rem 1.5rem;
            box-shadow: 2px 0 8px var(--shadow-color);
            border-radius: 0 12px 12px 0;
            /* position: sticky; */
            /* top: 0; */
            overflow: auto;
            display: flex;
            flex-direction: column;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        nav li {
           
        }

        nav a {
            display: block;
            padding: 0.6rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            border-radius: var(--border-radius);
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            user-select: none;
        }

        nav a:hover,
        nav a:focus-visible {
            color: var(--primary-color);
            background-color: rgba(37, 99, 235, 0.1);
            outline: none;
            transform: translateX(4px);
        }

        nav a:focus-visible {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.4);
        }

        main {
            flex: 1;
            padding: 2rem;
            max-height: 100vh;
            overflow: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            nav {
                position: fixed;
                width: 180px;
                z-index: 1000;
                height: 100vh;
                border-radius: 0;
                box-shadow: 2px 0 12px rgba(0, 0, 0, 0.2);
                transform: translateX(0);
                transition: transform 0.3s ease;
            }

            body {
                padding-left: 180px;
            }
        }
    </style>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
</head>

<body>
    <nav aria-label="Primary Sidebar Navigation">
        <ul>
            <li><a href="<?= BASE_URL.'?vr=dashboard' ?>" style="font-size: 30px; border-bottom: 1px solid black;">Welcome</a></li>
            <li><a href="<?= BASE_URL.'?vr=dashboard' ?>">Dashboard</a></li>
            <li><a href="<?= BASE_URL.'?vr=labors' ?>">Laborers</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="contact_msg.php">Messages</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="actions/logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
            </li>
        </ul>
    </nav>
    <main>