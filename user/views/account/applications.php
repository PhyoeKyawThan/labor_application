<?php if ($application['id'] ?? null):
    if ($_SESSION['type'] == 'employee'): ?>
        <div class="card" id="application-status">
            <h1><i class="fas fa-clipboard-list"></i> Application Status</h1>
            <div><i class="fas fa-hashtag"></i> Serial Number: <b><?= $application['serial_number'] ?></b></div>
            <div><i class="fas fa-user"></i> Name: <b><?= $application['name'] ?></b></div>
            <div>Status:
                <span class="status <?= $application['status'] ?>">
                    <i class="fas fa-info-circle"></i> <?= $application['status'] ?>
                </span>
            </div>
            <?php if ($application['status'] == 'Approved'): ?>
                <div>
                    <i class="fas fa-id-card"></i> View Labor Card:
                    <a href="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>views/cards/labor.php?sn=<?= $application['serial_number'] ?>"
                        target="_blank">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            <?php endif; ?>
            <?php if (!empty($application['message'])): ?>
                <div><i class="fas fa-comment-dots"></i> Remark:
                    <p><?= nl2br(htmlspecialchars($application['message'])) ?></p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="card" id="application-status">
            <h1><i class="fas fa-clipboard-list"></i> Application Status</h1>
            <div><i class="fas fa-user"></i> Name: <b><?= $application['name'] ?></b></div>
            <div><i class="fas fa-briefcase"></i> Position: <b><?= $application['position'] ?></b></div>
            <div>Status:
                <span class="status <?= $application['status'] ?>">
                    <i class="fas fa-info-circle"></i> <?= $application['status'] ?>
                </span>
            </div>
            <?php if ($application['status'] == 'Department Approvel'):
                $_SESSION['app_id'] = $application['id']; ?>
                <div><i class="fas fa-check-circle"></i> View Approval:
                    <a href="#"
                        onclick="window.open('<?= BASE_URL . '/views/approval/' ?>', 'Confirmation Form', 'width=1000,height=700,scrollbars=yes,resizable=yes'); return false;">
                        <i class="fas fa-eye"></i> Approval Confirmation
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($application['status'] == 'Finished'): ?>
                <div><i class="fas fa-id-card-alt"></i> Get Employed Cards:
                    <a href="#"
                        onclick="window.open('<?= BASE_URL . '/views/cards/employed_card.php' ?>', 'EmployeeCards', 'width=1000,height=700,scrollbars=yes,resizable=yes'); return false;">
                        <i class="fas fa-list"></i> Click here to get employee cards
                    </a>
                </div>
            <?php endif; ?>
            <?php if (!empty($application['message'])): ?>
                <div><i class="fas fa-comment-dots"></i> Remark:
                    <p><?= nl2br(htmlspecialchars($application['message'])) ?></p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif;
endif; ?>