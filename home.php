<?php include_once 'includes/header.php'; ?>
<?php
$session = $users->login();
?>
    <div class="home">
        <h3>Thank you <?php echo $_SESSION['user_name']; ?> for applying! We will contact you soon!</h3>
    </div>

<?php include_once 'includes/footer.php'; ?>