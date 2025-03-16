<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Edytuj notatkę</h2>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="index.php?action=edit&id=<?= htmlspecialchars($note['id']) ?>" method="post">
    <label for="title">Tytuł:</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($note['title']) ?>" required>

    <label for="content">Treść:</label>
    <textarea name="content" id="content" rows="5" required><?= htmlspecialchars($note['content']) ?></textarea>

    <button type="submit">Zapisz zmiany</button>
</form>

<a href="index.php">Powrót do listy notatek</a>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
