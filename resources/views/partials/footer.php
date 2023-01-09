</div>
</div>
</div>
<?php
$current_page = explode("/", $_SERVER['REQUEST_URI']);
$current_page = $current_page[1];
?>
<?php if ($current_page != 'login') : ?>
<footer class="d-flex justify-content-center align-items-center" id="footer">
    <p class="m-0">&copy; <?= date('Y') ?> - All rights reserved to HTU</p>
</footer>
<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="../../../resources/js/app.js"></script>
</body>

</html>