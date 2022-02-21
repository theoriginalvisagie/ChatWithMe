<!DOCTYPE html>
    <title></title>
        <link rel="stylesheet" href="../../../Libraries/Bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css"/>
        <script src="../../../Libraries/Bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
        <link href="../../../Libraries/FontAwesome/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
        <script src="../../../script/jquery.js?v=3"></script>
        <script src="script/js.js?v=4"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>
    <?php
        include_once("Home_class.php");

        $class = new Home();

        $class->init();

        if(isset($_POST['logout'])){
            session_unset();
            session_destroy();
            header("Location: ../../../login.php");
        }
    ?>
    <body>
</html>