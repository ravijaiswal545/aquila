<?php
/*
*Footer File
*@package Aquila
*/ ?>
</div>
<footer>
      <h3>footer</h3>
      <?php if (is_active_sidebar('sidebar-2')) { ?>
            <aside><?php dynamic_sidebar('sidebar-2'); ?></aside>
      <?php  } ?>
</footer>

</div>
<!-- End Footer -->
<!--JavaScript -->
<?php wp_footer(); ?>


</body>

</html>