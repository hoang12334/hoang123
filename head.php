<?php include('config.php');?>
<html lang="vi">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta property="og:image" content="<?=$site_img;?>"/>
  <meta name="description" content="<?=$site_mota;?>" />
  <meta name="keywords" content="<?=$site_tukhoa;?>">
  <link rel="shortcut icon" href="<?=$site_favicon;?>" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- plugins:css -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
  <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
  <script src="/assets/js/sweetalert.min.js"></script>


  <style type="text/css">
.pageloader {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('/img/loading.gif') 50% 50% no-repeat rgb(249, 249, 249);
  opacity: .8;
}
  .scroll-cards {
  width: 370px;
  height: 100%;
  overflow: auto;

  padding: 20px 0px 5px 0px;
}

.mail-names {
  color: grey;
  font-weight: bold;
  font-size: 15px;
  margin-left: 10px;
}

.mails {
  display: flex;
  align-items: center;
}
.mails > img {
  width: 35px;
  border-radius: 10px;
}
.mail-info {
  margin: 10px 65px;
  margin-left: 0px;
  line-height: 1.7;
  font-weight: 600;
}
.btn-primary {
  color: #fff;
  background-color: <?=$site_color;?>;
  border-color: #5e72e4;
  box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
}
.btn-primary:hover {
  color: #fff;
  background-color:  <?=$site_color;?>;
  border-color: <?=$site_color;?>;
}
.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
  color: #fff;
  background-color: <?=$site_color;?>;
}
.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
  color: #fff;
  background-color: <?=$site_color;?>;
}
.alert-primary {
  color: #fff;
  background-color: <?=$site_color;?>;
  border-color: <?=$site_color;?>;
}
  </style>
</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
