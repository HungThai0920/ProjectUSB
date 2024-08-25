<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>

<head>
    <link rel="stylesheet" href="library/toast_message/style.css" />
</head>
<body>
    <ul class="toast-list"></ul>
    <script src="library/toast_message/script.js"></script>
    <script>
          window.onload = function() {
            <?php if (isset($_SESSION['toast_message'])): ?>
                createToast("<?php echo $_SESSION['toast_message']; ?>", "<?php echo $_SESSION['toast_type']; ?>");
                <?php unset($_SESSION['toast_message'], $_SESSION['toast_type']); ?>
            <?php endif; ?>
        };
    </script>
</body>