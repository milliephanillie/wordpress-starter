<?php
/**
 * The gate component
 *
 * @package TheWellnessWay
 */
?>

<?php
add_action('wp_enqueue_scripts', 'tww_glossary_enqueue_styles');
function tww_glossary_enqueue_styles() {
    wp_add_inline_style('tww-gate', tww_glossary_get_gate_styles());
}

function tww_glossary_get_gate_styles() {
    ob_start();
    ?>
    .gate-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
    }
    .gate-content {
        background-color: blue; /* Corrected color value */
        height: 420px;
    }
    <?php
    return ob_get_clean();
}
?>
<div class="gate-overlay"></div>
<div class="gate--cta"> 
    <div class="gate--cta--content">
        <h2>Unlock the full database</h2>
        <p>Access all of our research and studies by becoming a member.</p>
        <a href="/membership" class="tww--gate-cta btn btn-primary">Get Access</a>
    </div>
</div>