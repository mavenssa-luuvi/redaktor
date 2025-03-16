<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Dodaj nowy Zeszyt</h2>

<form action="index.php?action=addNotebook" method="post">
    <label for="name">Nazwa:</label>
    <input type="text" name="name" id="name" required>
    
    <button type="submit">Dodaj Zeszyt</button>
</form>

<a href="index.php?action=notebooks">Powrót do listy zeszytów</a>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
