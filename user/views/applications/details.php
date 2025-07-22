<style>
    #container {
        background: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        text-align: center;
        margin: auto;
    }

    #container h1 {
        margin-bottom: 1.2rem;
        font-size: 2rem;
        color: #333;
    }

    #types {
        margin-bottom: 1.5rem;
    }

    #types a {
        display: inline-block;
        padding: 0.6rem 1.4rem;
        margin: 0 0.5rem;
        border-radius: 30px;
        background-color: #4a90e2;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    #types a:hover {
        background-color: #357ab8;
    }

    #container p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
    }
</style>

<div id="container">
    <h1>Application</h1>
    <div id="types">
        <?php
        if ($_SESSION['type'] ?? null) {
            if ($_SESSION['type'] == 'employee'):
                echo '<a href="?vr=applications&ee">Application For Employee card</a>';
            else:
                echo '<a href="?vr=applications&er">Employer</a>';
            endif;
        }
        ?>
    </div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit quos illum, accusantium rerum in possimus
        laborum! Mollitia a eius laudantium nulla odio quae cupiditate, nam suscipit aliquid deserunt facere fugiat.</p>
</div>
