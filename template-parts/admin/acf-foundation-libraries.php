<style>
.foundation-lib-container {
  display: flex;
  flex-wrap: wrap;
}

.foundation-lib-container p,
.foundation-lib-container ul {
  margin: 0 0 1.5rem 0;
}

.foundation-lib-container h4 {
  font-size: 1rem;
  margin: 0 0 1rem 0;
}

.foundation-lib-container h4 span {
  font-weight: normal;
}

.foundation-lib-container h5 {
  border-bottom: 1px solid #eee;
  font-size: 0.85rem;
  margin: 0 0 0.4rem 0;
}

.foundation-lib-block {
  border-bottom: 3px solid #eee;
  border-right: 3px solid #eee;
  box-sizing: border-box;
  padding: 40px;
  width: calc(100% / 2);
}

.foundation-lib-block ul:last-child {
  margin-bottom: 0;
}

.foundation-lib-block li {
  margin-bottom: 1rem;
}

.foundation-lib-block li:last-child {
  margin-bottom: 0;
}

.foundation-lib-block:nth-child(2n) {
  border-right: 0;
}

.foundation-lib-block:nth-last-child(-n+2) {
  border-bottom: 0;
}
</style>
<div class="foundation-lib-container">
  <?php foreach( $libraries as $library => $lib ) {
    ?>
    <div class="foundation-lib-block">
      <h4>
        <?php if ( ! empty( $lib['url'] ) ): ?>
          <a href="<?php echo esc_url( $lib['url'] ); ?>" target="_blank">
        <?php endif; ?>
        <?php echo $lib['name']; ?>
        <?php if ( ! empty( $lib['url'] ) ): ?>
          </a>
        <?php endif; ?> <span>&mdash; <?php echo $library; ?></span></h4>

      <?php if ( ! empty( $lib['css'] ) ): ?>
        <h5><?php _e( 'Registered CSS Scripts', 'foundation' ); ?></h5>
        <ul>
        <?php foreach( $lib['css'] as $css => $deets ): ?>
          <li>
            <strong><?php _e( 'Name', 'foundation' ); ?></strong>: <?php echo $css; ?> (v<?php echo $deets['version']; ?>)<br>
            <strong><?php _e( 'Media', 'foundation' ); ?></strong>: <?php echo $deets['media']; ?><br>
            <strong><?php _e( 'Source', 'foundation' ); ?></strong>: <?php echo $deets['src']; ?><br>
            <?php if ( ! empty( $deets['dep'] ) ): ?>
              <strong><?php _e( 'Dependencies', 'foundation' ); ?></strong>:
              <?php $total = count( $deets['dep'] ); $cnt = 0; foreach( $deets['dep'] as $k => $name ): $cnt++; ?>
                <?php echo $name; ?><?php if ( $cnt < $total ): ?>, <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php if ( ! empty( $lib['js'] ) ): ?>
        <h5><?php _e( 'Registered JS Scripts', 'foundation' ); ?></h5>
        <ul>
        <?php foreach( $lib['js'] as $js => $deets ): ?>
          <li>
            <strong><?php _e( 'Name', 'foundation' ); ?></strong>: <?php echo $js; ?> (v<?php echo $deets['version']; ?>)<br>
            <strong><?php _e( 'Footer', 'foundation' ); ?></strong>: <?php if ( $deets['in_footer'] ): ?>true<?php else: ?>false<?php endif; ?><br>
            <strong><?php _e( 'Source', 'foundation' ); ?></strong>: <?php echo $deets['src']; ?><br>
            <?php if ( ! empty( $deets['dep'] ) ): ?>
              <strong><?php _e( 'Dependencies', 'foundation' ); ?></strong>:
              <?php $total = count( $deets['dep'] ); $cnt = 0; foreach( $deets['dep'] as $k => $name ): $cnt++; ?>
                <?php echo $name; ?><?php if ( $cnt < $total ): ?>, <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
    <?php
  }
?>
</div>
