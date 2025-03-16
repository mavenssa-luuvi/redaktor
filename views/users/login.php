<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Logowanie</h2>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="index.php?action=login" method="post">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Zaloguj się</button>
</form>

<p>Nie masz jeszcze konta? <a href="index.php?action=register">Zarejestruj się tutaj</a></p>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
