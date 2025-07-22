
<style>
    .dashboard {
        display: flex;
        justify-content: space-between; 
        align-items: flex-start; 
        flex-wrap: wrap;
        padding: 2rem;
        gap: 2rem; 
        height: 100%;
    }

    .dashboard > div {
        background-color: var(--sidebar-bg); 
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: 0 2px 8px var(--shadow-color);
        flex: 1; 
        min-width: 250px; 
        max-width: 300px;
        transition: transform 0.2s; 
    }

    .dashboard > div:hover {
        transform: scale(1.02);
    }

    .dashboard h2 {
        color: var(--primary-color); 
        margin-bottom: 1rem; 
    }

    .dashboard p {
        margin: 0.5rem 0; 
        color: var(--text-color); 
        font-size: 1rem; 
    }

    .dashboard span {
        font-weight: bold;
        color: var(--text-hover); 
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .dashboard {
            flex-direction: column;
            align-items: center;
        }

        .dashboard > div {
            max-width: 100%; 
        }
    }
</style>
<h1>Dashboard</h1>
<div class="dashboard">
    <div>
        <h2>Contact Messages</h2>
        <p>Total Messages: <span id="total-messages"><?php// echo $total_messages; ?></span></p>
        <p>Replied Messages: <span id="replied-messages"><?php// echo $replied_messages; ?></span></p>
        <p>Unreplied Messages: <span id="unreplied-messages"><?php// echo $unreplied_messages; ?></span></p>
        <p>Latest Message: <span id="latest-message"><?php// echo $latest_message_display; ?></span></p>
    </div>
    <div>
        <h2>Labors</h2>
        <p>Total Laborers: <span id="total-laborers"><?php// echo $total_laborers; ?></span></p>
        <p>Approved Laborers: <span id="approved-laborers"><?php// echo $approved_laborers; ?></span></p>
        <p>Pending Applications: <span id="pending-applications"><?php// echo $pending_laborers; ?></span></p>
        <p>Rejected Applications: <span id="rejected-applications"><?php// echo $rejected_laborers; ?></span></p>
        <p>Latest Laborer: <span id="latest-laborer"><?php// echo $latest_laborer_display; ?></span></p>
    </div>
    <div>
        <h2>Users</h2>
        <p>Total Users: <span id="total-users"><?php// echo $total_users; ?></span></p>
        <p>Labor Users: <span id="labor-users"><?php// echo $labor_users; ?></span></p>
        <p>Non-Labor Users: <span id="non-labor-users"><?php// echo $non_labor_users; ?></span></p>
        <p>Latest User: <span id="latest-user"><?php// echo $latest_user_display; ?></span></p>
    </div>
</div>

