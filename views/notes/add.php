<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Dodaj nową Notatkę</h2>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="index.php?action=add" method="post">
    <label for="title">Tytuł:</label>
    <input type="text" name="title" id="title" required>

    <label for="content">Treść:</label>
    <textarea name="content" id="content" rows="5" required></textarea>

    <label for="notebook">Zeszyt:</label>
    <select name="notebook" id="notebook" required>
        <option value="">-- Wybierz zeszyt --</option>
        <?php foreach ($notebooks as $notebook): ?>
            <option value="<?= htmlspecialchars($notebook['id']) ?>">
                <?= htmlspecialchars($notebook['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Dodaj Notatkę</button>
</form>

<a href="index.php">Powrót do listy notatek</a>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
