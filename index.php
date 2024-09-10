<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMLFans Aggregator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
  </head>
  <body>
    
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="arrow-right-circle" viewBox="0 0 16 16">
    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
  </symbol>
</svg>

<div class="col-lg-8 mx-auto p-4 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
      <span class="fs-4">TMLFans Aggregator</span>
    </a>
  </header>

  <main>
    <h1 class="text-body-emphasis">This is a concept site</h1>
    <p class="fs-5 col-md-8">Concept site still very much under construction and a placeholder to show Rick. Has most sites now being pulled in properly, just need a proper layout on a site of your choosing and set up the PHP scripts and crons</p>

    <!--<div class="mb-5">
      <a href="../examples/" class="btn btn-primary btn-lg px-4">Download examples</a>
    </div>-->

    <hr class="col-3 col-md-2 mb-5">

    <div class="row g-5">
      <div class="col-md-6">
        <h2 class="text-body-emphasis">Latest Authors</h2>
        <p>Articles listed by the latest authors to write them</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/icons-font" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap npm starter
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/parcel" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Parcel starter
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/vite" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Vite starter
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/webpack" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Webpack starter
            </a>
          </li>
        </ul>
      </div>

      <div class="col-md-6">
        <h2 class="text-body-emphasis">Latest Sites</h2>
        <p>Articles listed by the latest sites to write them</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="../getting-started/introduction/">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap quick start guide
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="../getting-started/webpack/">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Webpack guide
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="../getting-started/parcel/">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Parcel guide
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="../getting-started/vite/">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Vite guide
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="../getting-started/contribute/">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Contributing to Bootstrap
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row g-5">
      <div class="col-md-12">
        <h2 class="text-body-emphasis">Latest Articles</h2>
        <p>Articles listed by the latest</p>
        <ul class="list-unstyled ps-0">
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/icons-font" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap npm starter
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/parcel" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Parcel starter
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/vite" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Vite starter
            </a>
          </li>
          <li>
            <a class="icon-link mb-1" href="https://github.com/twbs/examples/tree/main/webpack" rel="noopener" target="_blank">
              <svg class="bi" width="16" height="16"><use xlink:href="#arrow-right-circle"/></svg>
              Bootstrap Webpack starter
            </a>
          </li>
        </ul>
      </div>
    </div>
  </main>
  <footer class="pt-5 my-5 text-body-secondary border-top">
    Created by the Bootstrap team &middot; &copy; 2023
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>
</html>