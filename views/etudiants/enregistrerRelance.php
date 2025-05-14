<?php
$title = 'Faire une relance';
$headerTitle = 'Relance pour encadreur';

ob_start();
?>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 100%;
    max-width: 400px;
}

h1 {
    color: #007bff;
    margin-bottom: 1rem;
}

form {
    margin-top: 1rem;
}

textarea {
    width: 100%;
    padding: 0.8rem;
    margin: 0.5rem 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    resize: none;
    height: 100px;
}

button {
    width: 100%;
    padding: 0.8rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 1rem;
}

button:hover {
    background-color: #0056b3;
}
</style>
<div class="container">
    <h1>Faire une relance</h1>
    <form method="POST" action="?action=faire_relance">
        <textarea name="message" placeholder="Expliquez pourquoi vous faites une relance..." required></textarea>
        <button type="submit">Envoyer la relance</button>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>