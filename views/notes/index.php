<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Wszystkie notatki</h2>

<a href="index.php?action=add" class="btn-add">➕ Dodaj nową notatkę</a>

<?php if (empty($notes)): ?>
    <p>Brak notatek. Dodaj swoją pierwszą notatkę!</p>
<?php else: ?>
    <ul class="notes-list">
        <?php foreach ($notes as $note): ?>
            <li class="note-item">
                <h3><?= htmlspecialchars($note['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($note['content'])) ?></p>
                <small>Utworzono: <?= date('d.m.Y H:i', strtotime($note['created_at'])) ?></small>
                <div class="note-actions">
                    <a href="index.php?action=edit&id=<?= htmlspecialchars($note['id']) ?>" class="btn-edit">✏️ Edytuj</a>
                    <a href="index.php?action=delete&id=<?= htmlspecialchars($note['id']) ?>" class="btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć tę notatkę?');">🗑️ Usuń</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
