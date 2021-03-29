<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voto::Vereador</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.css" integrity="sha512-UWqafCfAKZVD24WgqPnyBy7BM3hZ5UWRDZt7tE36saC7zu1wLUDNoafWVBhzUzP9wVQLhebfmJcnXVjkern/fQ==" crossorigin="anonymous" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <style>
    .pulse-button {
      box-shadow: 0 0 0 0 rgba(232, 76, 61, 0.7);
      background-color: #e84c3d;
      background-size: cover;
      -webkit-animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
      -moz-animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
      -ms-animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
      animation: pulse 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
    }

    .pulse-button:hover {
      -webkit-animation: none;
      -moz-animation: none;
      -ms-animation: none;
      animation: none;
    }

    @-webkit-keyframes pulse {
      to {
        box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
      }
    }

    @-moz-keyframes pulse {
      to {
        box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
      }
    }

    @-ms-keyframes pulse {
      to {
        box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
      }
    }

    @keyframes pulse {
      to {
        box-shadow: 0 0 0 45px rgba(232, 76, 61, 0);
      }
    }
  </style>
  <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite;
      /* Safari */
      animation: spin 2s linear infinite;
      margin-left: 35%;
      z-index: 10000;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% {
        -webkit-transform: rotate(0deg);
      }

      100% {
        -webkit-transform: rotate(360deg);
      }
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    #banner {
      position: absolute;
      top: 50px;
      left: 0;
      float: left;
      width: 180px;
      /* largura */
      height: 180px;
      /* altura */
      background-color: #0066CC;
      /* cor de fundo */
      -webkit-border-radius: 8px;
      /* canto arredondado */
      -moz-border-radius: 8px;
      /* canto arredondado */
      border-radius: 8px;
      /* canto arredondado */
      z-index: 999999;
      /* posicionando sobre os demais */
      display: none;
      color: #FFFFFF;
    }

    #banner a {
      color: #FFFFFF;
      text-decoration: none
    }

    #banner p {
      padding: 5px 10px 0;
    }

    p.link {
      text-align: center;
      clear: both
    }

    #fechar {
      position: relative;
      float: right;
      width: 20px;
      height: 20px;
      background-color: #000000;
      color: #FFFFFF;
      text-align: center;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">