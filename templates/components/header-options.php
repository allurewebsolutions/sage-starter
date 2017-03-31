<!-- Header Image -->
<?php

$image = get_field('header_bg_image');

if (!empty($image)): ?>

  <script>
    function defer(method) {
      if (window.jQuery) {
        method();
      } else {
        setTimeout(function () {
          defer(method);
        }, 50);
      }
    }
    defer(function () {
      jQuery('header').prepend('<div class="row banner-bg" />');
    });
  </script>

  <style>
    .banner-bg {
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background-image: url(<?php echo $image['url']; ?>);
      background-size: cover;
    }
  </style>

<?php endif; ?>


<?php if (get_field('transparent_header')): ?>
  <!-- Header Transparency -->

  <style>
    div.navbar, div.navbar {
      background-color: rgba(0, 0, 0, 0.2);
      border: none;
    }
  </style>

<?php endif; ?>

<?php if (get_field('header_height')): ?>
  <!-- Header Height -->

  <style>
    header, .banner-bg {
      height: <?php echo get_field('header_height') ?>px;
    }
  </style>

<?php endif; ?>

<?php if (get_field('header_full_height')): ?>
  <!-- Full Height -->

  <style>
    header, .banner-bg {
      height: 100vh;
    }
  </style>

<?php endif; ?>


<?php if (get_field('hide_title')): ?>
  <!-- Hide Title -->

  <style>
    .jumbotron {
      display: none;
      visibility: hidden;
    }
  </style>

  <script>
    function defer(method) {
      if (window.jQuery) {
        method();
      } else {
        setTimeout(function () {
          defer(method);
        }, 50);
      }
    }
    defer(function () {
      jQuery('.jumbotron').remove();
    });
  </script>

<?php endif; ?>

<?php if (get_field('header_bg_image_blur')): ?>
  <!-- Header Blur -->

  <script>
    function defer(method) {
      if (window.jQuery) {
        method();
      } else {
        setTimeout(function () {
          defer(method);
        }, 50);
      }
    }
    defer(function () {
      jQuery('.banner-bg').addClass('blur');
    });
  </script>

<?php endif; ?>


