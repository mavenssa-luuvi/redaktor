<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Rejestracja</h2>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="index.php?action=register" method="post">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Adres email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Zarejestruj się</button>
</form>

<p>Masz już konto? <a href="index.php?action=login">Zaloguj się tutaj</a></p>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
