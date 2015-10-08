<?php

$locations = array();

while ( have_posts() ) : the_post();

    $distance = facetwp_get_distance( $post->ID );
    $distance = ( false !== $distance ) ? '<br />' . round( $distance, 1 ) . ' miles away' : '';

    $locations[] = array(
        'title' => get_the_title( $post->ID ),
        'coords' => get_post_meta( $post->ID, 'coordinates', true ),
        'distance' => $distance,
    );

endwhile;

?><script>window.map_data = <?php echo json_encode( $locations ); ?>;</script>
