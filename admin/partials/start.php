<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: /labor_application/admin/views/auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Labor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        :root {
            --bg-color: #f8fafc;
            --sidebar-bg: #ffffff;
            --primary-color: #2563eb;
            --primary-light: #eff6ff;
            --text-color: #4b5563;
            --text-hover: #1d4ed8;
            --border-color: #e5e7eb;
            --shadow-color: rgba(0, 0, 0, 0.05);
            --border-radius: 8px;
        }

        * {
            box-sizing: border-box;

        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI',
                Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji';
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }


        nav>* {
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: var(--sidebar-bg);
            width: 240px;
            padding: 1.5rem 1rem;
            box-shadow: 2px 0 8px var(--shadow-color);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            gap: 2rem;
            transition: width 0.3s ease;
        }


        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            color: #1f2937;
            font-size: 1.25rem;
            font-weight: 600;
            text-decoration: none;
            user-select: none;
        }

        .sidebar-brand-icon {
            color: var(--primary-color);
        }

        .sidebar-brand:hover {
            color: var(--primary-color);
        }


        .sidebar-nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar-nav-list a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            font-weight: 400;
            font-size: 0.95rem;
            border-radius: var(--border-radius);
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            user-select: none;
        }

        .sidebar-nav-list a:hover,
        .sidebar-nav-list a:focus-visible {
            color: var(--primary-color);
            background-color: var(--primary-light);
            outline: none;
        }

        .sidebar-nav-list a.active {
            color: var(--primary-color);
            background-color: var(--primary-light);
            font-weight: 600;
        }

        .sidebar-nav-list a .icon {
            font-size: 1.25rem;
            width: 20px;
            text-align: center;
        }

        .logout-link {
            margin-top: auto;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }

        main {
            height: 100vh;
            flex: 1;
            padding: 2rem;
            overflow-y: scroll;
        }

        .sidebar-nav-list .dropdown {
            position: relative;
            flex-direction: column;
        }

        .sidebar-nav-list .dropdown-menu {
            list-style: none;
            margin: 0;
            padding-left: 1.5rem;
            display: none;
            flex-direction: column;
            gap: 0.25rem;
        }

        .sidebar-nav-list .dropdown.open .dropdown-menu {
            display: flex;
        }

        .sidebar-nav-list .dropdown-menu a {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }


        @media (max-width: 768px) {
            nav {
                position: fixed;
                left: -240px;
                height: 100%;
                z-index: 1000;
                box-shadow: 2px 0 12px rgba(0, 0, 0, 0.2);
                transform: translateX(0);
                transition: transform 0.3s ease;
            }

            body.sidebar-open nav {
                transform: translateX(240px);
            }

            main {
                margin-left: 0;
            }
        }
    </style>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
</head>

<body>
    <?php
    $current = isset($_GET['vr']) ? $_GET['vr'] : 'dashboard';
    ?>

    <nav aria-label="Primary Sidebar Navigation">
        <a href="<?= BASE_URL . '?vr=dashboard' ?>" class="sidebar-brand">
            <i class="fa-solid fa-chart-line sidebar-brand-icon"></i>
            <span>Labor App</span>
        </a>
        <ul class="sidebar-nav-list">
            <li>
                <a href="<?= BASE_URL . '?vr=dashboard' ?>" class="<?= $current === 'dashboard' ? 'active' : '' ?>">
                    <i class="fa-solid fa-house icon"></i>
                    Dashboard
                </a>
            </li>
            <li class="dropdown <?= $current === 'labors' ? 'active' : '' ?>">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fa-solid fa-user-tie icon"></i>
                    Laborers <i class="fa-solid fa-chevron-down" style="margin-left:auto;font-size:0.8rem;"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= BASE_URL . '?vr=labors' ?>"
                            class="<?= $current === 'labors' && ($_GET['stus'] ?? '') === '' ? 'active' : '' ?>">
                            <i class="fa-solid fa-list icon"></i>
                            All Laborers
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '?vr=labors&stus=pending' ?>"
                            class="<?= ($current === 'labors' && ($_GET['stus'] ?? '') === 'pending') ? 'active' : '' ?>">
                            <i class="fa-solid fa-hourglass-half icon"></i>
                            Pending
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '?vr=labors&stus=resubmit' ?>"
                            class="<?= ($current === 'labors' && ($_GET['stus'] ?? '') === 'resubmit') ? 'active' : '' ?>">
                            <i class="fa-solid fa-repeat icon"></i>
                            Resubmit
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL . '?vr=labors&stus=approved' ?>"
                            class="<?= ($current === 'labors' && ($_GET['stus'] ?? '') === 'approved') ? 'active' : '' ?>">
                            <i class="fa-solid fa-circle-check icon"></i>
                            Approved
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= BASE_URL . '?vr=employer' ?>" class="<?= $current === 'employer' ? 'active' : '' ?>">
                    <i class="fa-solid fa-building icon"></i>
                    Employers
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL . '?vr=report' ?>" class="<?= $current === 'report' ? 'active' : '' ?>">
                    <i class="fa-solid fa-list icon"></i>
                    Report
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL . '?vr=users' ?>" class="<?= $current === 'users' ? 'active' : '' ?>">
                    <i class="fa-solid fa-users icon"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL . '?vr=messages' ?>" class="<?= $current === 'messages' ? 'active' : '' ?>">
                    <i class="fa-solid fa-envelope icon"></i>
                    Messages
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL . '?vr=about' ?>" class="<?= $current === 'about' ? 'active' : '' ?>">
                    <i class="fa-solid fa-circle-info icon"></i>
                    About
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL . '?vr=contact' ?>" class="<?= $current === 'contact' ? 'active' : '' ?>">
                    <i class="fa-solid fa-envelope icon"></i>
                    Contact
                </a>
            </li>
        </ul>
        <div class="logout-link">
            <a href="actions/logout.php" onclick="return confirm('Are you sure you want to logout?')">
                <i class="fa-solid fa-arrow-right-from-bracket icon"></i>
                Logout
            </a>
        </div>
    </nav>
    <script>
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            const parent = toggle.parentElement;
            const menuId = parent.querySelector('.dropdown-menu')?.id || 'laborers-dropdown';

            if (localStorage.getItem(menuId) === 'open' || parent.querySelector('.dropdown-menu a.active')) {
                parent.classList.add('open');
            }

            toggle.addEventListener('click', function () {
                parent.classList.toggle('open');

                if (parent.classList.contains('open')) {
                    localStorage.setItem(menuId, 'open');
                } else {
                    localStorage.setItem(menuId, 'closed');
                }
            });
        });
    </script>


    <main>