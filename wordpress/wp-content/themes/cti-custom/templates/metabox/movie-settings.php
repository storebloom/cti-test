<?php
/**
 * Movie setting content.
 *
 * @package CTICustom
 */
?>
<div>
    <label>
        <?php echo esc_html__('Year', 'cti-custom'); ?>
        <input type="text" name="movie-settings[year]" value="<?php echo isset($movie_settings['year']) ? esc_attr($movie_settings['year']) : ''; ?>" />
    </label>
    <label>
        <?php echo esc_html__('Director', 'cti-custom'); ?>
        <input type="text" name="movie-settings[director]" value="<?php echo isset($movie_settings['director']) ? esc_attr($movie_settings['director']) : ''; ?>" />
    </label>
</div>