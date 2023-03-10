  <footer class="main-footer">
      <div class="footer-left">
      Copyright &copy; 2022 Mayasari</div>
      </div>
      <div class="footer-right">
          0.5 Version
      </div>
  </footer>
  </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <?php if (isset($js)) : ?>
      <?php foreach ($js as $key => $value) : ?>
          <script src="<?= "../assets/" . $value; ?>"></script>
      <?php endforeach; ?>
  <?php endif; ?>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <?php if (isset($js_page)) : ?>
      <?php foreach ($js_page as $key => $value) : ?>
          <script src="<?= "../assets/js/" . $value; ?>"></script>
      <?php endforeach; ?>
  <?php endif; ?>

  <?php
    if (isset($script_page)) {
        echo $script_page;
    }
    ?>

  </body>

  </html>