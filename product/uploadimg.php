<?php
    move_uploaded_file($_FILES["image"]["tmp_name"], "C:/xampp/htdocs/admin/src/component/img/" . $_FILES["image"]["name"]);
?>