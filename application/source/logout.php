
<?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
</div>


<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success']= 'You are disconnected';
header('Location : login.php');
?>