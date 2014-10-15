<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class NotnilDashboardHatebu {
    
    private static $instance;
    
    public static function instance()
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new NotnilDashboardHatebu;
            self::$instance->run_init();
        }
        return self::$instance;
    }
    
    public function run_init()
    {
        add_action( 'init', array( $this, 'add_actions' ) );
        add_action( 'init', array( $this, 'add_filters' ) );
    }
    
    public function add_actions()
    {
        add_action( 'manage_posts_custom_column', array( $this, 'action_manage_posts_custom_column'), 10, 2 );
        add_action( 'admin_footer-edit.php', array( $this, 'action_admin_footer' ) );
    }
    
    public function action_manage_posts_custom_column($column_name, $post_id)
    {
        if ($column_name == 'hatebu') {
            $permalink = get_the_permalink($post_id);
            echo sprintf(
                '<div class="hatebu_count" data-url="%s"></div>',
                esc_attr($permalink)
            );
        }
    }
    
    public function action_admin_footer()
    {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.hatebu_count').each(function(){
                var self = $(this);
                $.ajax({
                    dataType: "jsonp",
                    url: 'http://api.b.st-hatena.com/entry.count',
                    data: { url: self.data('url') }
                }).done(function(data){
                    self.text(data);
                });
            });
        });
        </script>
        <?php
    }

    public function add_filters()
    {
        add_filter( 'manage_posts_columns', array( $this, 'filter_manage_posts_columns' ), 10, 2);
    }
    
    public function filter_manage_posts_columns($posts_columns, $post_type)
    {
        return array_merge( $posts_columns, array('hatebu' => __('Hatena')) );
    }
}
