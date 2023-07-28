<?php
/*
Template Name: Projects

*/

$projects_per_page = 6;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'projects',
    'posts_per_page' => $projects_per_page,
    'paged' => $paged
);

$query = new WP_Query($args);
?>

<main id="main" class="site-main">
    <div class="container">
        <div class="row">

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-md-4">

                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No Projects found.</p>
            <?php endif; ?>

        </div>

        <?php
        // Pagination
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'));

            echo '<div class="pagination">';
            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
            ));
            echo '</div>';
        }
        ?>

    </div>
</main>


<!-- Display Kanye West Quotes -->

<?php echo do_shortcode('[kanye_quotes]')  ?>

<!-- Display Kanye West Quotes -->

<?php
get_footer();
