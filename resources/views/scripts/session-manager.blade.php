<?php

    if (session_status() === PHP_SESSION_NONE){
        session_start();
        echo "<script>console.log('start sesi')</script>";
    }

    if (empty(Session::get("email"))){
        echo "<script>console.log('belum login')</script>";
        // echo "<script>window.location = '/login';</script>";
        header("Location: /login");
        exit;

    }

    elseif(Session::get("email")) {
        echo "<script>console.log('udah login')</script>";
    }

?>
