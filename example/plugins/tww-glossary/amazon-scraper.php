<?php
/**
 * 
 * 
 * I want to scrape Amazon and get a list of the best selling books in the category of "Murder Mystery". I want to save the title, and update a post with the title. I want to create a cron job that does this once an hour.
 * 
 */

 class AmazonScraper {
    const WEBPAGE_TO_SCRAPE = 'https://www.amazon.com/Best-Sellers-Books-Mystery-Thriller-Suspense/zgbs/books/18/ref=zg_bs_nav_books_1';

    public function __construct() {
        add_action('init', [$this, 'register_post_type_of_books']);
    }

    public function do_cron_job() {}

    public function register_post_type_of_books() {
        register_post_type();
    }
    
    public function send_get_request() {
        // Request the Amazon url 
        $url = self::WEBPAGE_TO_SCRAPE;

    }

    public function update_books() {}

 }