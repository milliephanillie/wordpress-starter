<?php
/**
 * 
 * 
 */
?>
 <div id="tww-current-membership-shortcode" class="current-membership">
    <div class="current-membership--inner">
        <div class="current-membership--header">
            <?php echo $this->print_title($subscription); ?>
            <?php echo $this->print_status_tag($subscription); ?>
        </div>

            <div class="membership">
                <p>No active subscriptions.</p>
            
                <div class="current-membership--actions">
                    <?php echo $this->print_actions($subscription); ?>
                </div>
            </div>
        </div>
    </div>
</div>