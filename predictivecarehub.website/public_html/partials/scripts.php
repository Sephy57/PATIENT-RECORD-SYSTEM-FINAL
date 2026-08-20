<?php
if ($_SESSION['user_type'] == 'patient') {
?>
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script src="../js/post.js?v=<?php echo time(); ?>"></script>
    <script src="../js/update.js?v=<?php echo time(); ?>"></script>
    <script src="../js/delete.js?v=<?php echo time(); ?>"></script>
    <script src="../js/modals.js?v=<?php echo time(); ?>"></script>

<?php
} else {
?>
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script src="../../js/post.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/update.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/delete.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/modals.js?v=<?php echo time(); ?>"></script>
    <script src="../../js/main.js?v=<?php echo time(); ?>"></script>
<?php
}
?>