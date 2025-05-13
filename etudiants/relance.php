<div class="container">
    <h2>Faire une relance</h2>

    <?php if (isset($_SESSION['relance_message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['relance_message'] ?></div>
        <?php unset($_SESSION['relance_message']); ?>
    <?php elseif (isset($_SESSION['relance_erreur'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['relance_erreur'] ?></div>
        <?php unset($_SESSION['relance_erreur']); ?>
    <?php else: ?>
        <p>Si vous n'avez pas encore été affecté à un encadreur, vous pouvez soumettre une demande de relance. Un
            administrateur sera informé de votre requête.</p>
        <form action="../index.php?action=enregistrerRelance" method="post">
            <div class="mb-3">
                <label for="message_relance" class="form-label">Message (facultatif) :</label>
                <textarea class="form-control" id="message_relance" name="message_relance" rows="3"
                    placeholder="Expliquez brièvement la raison de votre relance (facultatif)"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Demander une relance</button>
        </form>
    <?php endif; ?>
</div>