<?php
?>
<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
  <meta charset="<?php bloginfo('charaset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>kumihan.com(仮)</title>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/fonts.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/modaal.min.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/jquery.bxslider.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/ss-style.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/ss-style-pages-org.css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/ss-style-borad.css" />

  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/modaal.min.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.bxslider.min.js" defer></script>
  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/behavior.js" defer></script>
  <script>
    $(document).ready(function() {
      $('.slider').bxSlider();
    });
  </script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
    <div class="hp-only">
      <div class="hamburger-menu-container">
        <h1 class="logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_white.png" alt="logo">
          <span>kumihan.com</span>
        </h1>
        <div class="hamburger-menu">
          <input type="checkbox" id="menu-btn-check">
          <label for="menu-btn-check" class="menu-btn"><span></span></label>
          <label for="menu-btn-check" id="nav-black"></label>
          <div class="menu-content">
            <ul>
              <li class="menu-bar-item"><a href="<?php echo home_url(); ?>">ホーム</a></li>
              <li class="menu-bar-item"><a href="/book">本</a></li>
              <li class="menu-bar-item"><a href="/typesetting">組版</a></li>
              <li class="menu-bar-item"><a href="/programming">プログラミング</a></li>
              <li class="menu-bar-item"><a href="/photo">写真</a></li>
              <li class="menu-bar-item"><a href="/member">メンバーページ</a>
                <ul class="sub-menu">
                  <li class="menu-bar-item"><a href="/register">sign up</a></li>
                  <li class="menu-bar-item"><a href="/login">log in</a></li>
                  <li class="menu-bar-item"><a href="/contact">contact</a></li>
                  <li class="menu-bar-item"><a href="/board">bbs</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="pc-only">
      <div class="menu-bar">
        <h1 class="logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_white.png" alt="logo">
          <span>kumihan.com</span>
        </h1>
        <ul class="menu-bar-lists">
          <li class="menu-bar-item"><a href="<?php echo home_url(); ?>">ホーム</a></li>
          <li class="menu-bar-item"><a href="/book">本</a></li>
          <li class="menu-bar-item"><a href="/typesetting">組版</a></li>
          <li class="menu-bar-item"><a href="/programming">プログラミング</a></li>
          <li class="menu-bar-item"><a href="/photo">写真</a></li>
          <li class="menu-bar-item"><a href="/member">メンバーページ</a>
            <ul class="sub-menu">
              <li class="menu-bar-item"><a href="/register">sign up</a></li>
              <li class="menu-bar-item"><a href="/login">log in</a></li>
              <li class="menu-bar-item"><a href="/contact">contact</a></li>
              <li class="menu-bar-item"><a href="/board">bbs</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <?php wp_head(); ?>
  </header>