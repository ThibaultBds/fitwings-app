<section class="card">
    <h2>Messages de contact</h2>

    <?php if (!empty($contact_messages_error)): ?>
        <p class="admin-empty"><?= htmlspecialchars($contact_messages_error) ?></p>
    <?php elseif (empty($contact_messages)): ?>
        <p class="admin-empty">Aucun message.</p>
    <?php else: ?>
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contact_messages as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['created_at']) ?></td>
                            <td><?= htmlspecialchars($m['nom']) ?></td>
                            <td><?= htmlspecialchars($m['email']) ?></td>
                            <td><?= nl2br(htmlspecialchars($m['message'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>