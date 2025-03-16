<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Moje Zeszyty</h2>

<a href="index.php?action=addNotebook" class="btn-add">➕ Dodaj nowy zeszyt</a>

<?php if (empty($notebooks)): ?>
    <p>Brak zeszytów. Dodaj swój pierwszy zeszyt!</p>
<?php else: ?>
    <ul class="notebooks-list">
        <?php foreach ($notebooks as $notebook): ?>
            <li class="notebook-item">
                <a href="index.php?notebook=<?= htmlspecialchars($notebook['id']) ?>">
                    <?= htmlspecialchars($notebook['name']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
