<?php
/**
 * Job Post type Carddeck Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

/**
 * Load values and assign defaults
 * Loop through post objects (assuming this is a multi-select field) ( don't setup postdata )
 * Using this method, the $post object is never changed so all functions need a seccond parameter of the post ID in question.
 */
$terms = get_field('sort_filter');
$order_field = $terms['order'];

// Post order and orderby parameters
if ( $order_field === 'Alt nach Neu' ) {
    $order_by  = 'post_date';
    $order = 'ASC';
}
if ( $order_field === 'Neu nach Alt' ) {
    $order_by  = 'post_date';
    $order = 'DESC';
}
if ( $order_field === 'A bis Z' ) {
    $order_by  = 'title';
    $order = 'ASC';
}
if ( $order_field === 'Z bis A' ) {
    $order_by  = 'title';
    $order = 'DESC';
}

$post_ids = get_field('posts', false, false);

if( !empty( $post_ids ) ) {
    $args = array(
        'post_type' => 'jobs',
        'post__in' => $post_ids,
        'orderby' => $order_by,
        'order' => $order,
        'fields' => 'all',
        'suppress_filters' => 0
    );
    $post_objects = get_posts($args);
} else {
    $post_objects = get_posts(array(
        'post_type' => 'jobs',
        'orderby' => $order_by,
        'order' => $order,
        'fields' => 'all',
        'suppress_filters' => 0
    ));
}
//the_content();
// Print job postings
$hostname = 'vollcom-digital';
$lang = wpml_get_current_language(); // Depending on implementation of multilingual content
//$positions = simplexml_load_file('https://' . $hostname . '.jobs.personio.de/xml?language=' . $lang);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://'.$hostname.'.jobs.personio.de/xml?language='. $lang,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET'
));

$response = curl_exec($curl);
$positions = simplexml_load_string($response);
curl_close($curl);

    ?>
<?php //if(!empty($post_objects)): ?>
<!--Job Panel Deck-->
<div class="row row-cols-1 row-cols-md-2">
    <?php foreach ($positions as $position) {
?>
<!--    --><?php //foreach( $post_objects as $post_object): ?>
    <div class="col mb-4 ">
        <div class="card  border-left border-right border-bottom h-100 z-depth-0 hover-shadow border wow" data-wow-delay="0.6s">
            <div class="card-body d-flex justify-content-between align-items-stretch align-self-center">
                <img src="<?php get_home_url()?>/app/uploads/2020/10/vollcom-digital-logo-cube.svg"  class="vollcom-cube">
                <div class="labels">
                    <span class="Frontend-Developer-fmd">
                        <a class="teal-text" href=<?php
                        if($lang == strval('de')){
                            echo get_home_url().'new-jobs/?id='.$position->id;

                        }else{
                            echo get_home_url().'/new-jobs/?id='.$position->id;

                        } ?>>
                            <?php echo $position->name; ?>
<!--                            --><?php //echo esc_html(get_the_title($post_object->ID)); ?>
                        </a>
                    </span>
                    <p class="Munich-Germany-or-remote"><?= $position->office ?>, <?= $position->employmentType ?></p>

                </div>
<!--                --><?php //if( !empty(get_permalink($post_object->ID)) ):?>
<!--                --><?php //endif; ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <!--    --><?php //endforeach; ?>
</div>
<?php //else : ?>
<!--<p class="text-center">--><?php //echo esc_html_e('No jobs currently available', 'wp-vollcom-digital'); ?><!--</p>-->

<!--/.Job Panel Deck-->
<?php //endif; ?>

<style>
    .Frontend-Developer-fmd {
        width: 540px;
        height: 30px;
        margin: 4.7px 0 0.2px 20px;
        font-family: Roboto;
        font-size: 18px;
        font-weight: bold;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.33;
        letter-spacing: normal;
        text-align: left;
        color: var(--dark-blue-grey);
    }
    .Munich-Germany-or-remote {
        width: 540px;
        height: 31px;
        margin: 0.2px 0 0 20px;
        font-family: Roboto;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: slategray;
    }
    img.vollcom-cube {
        width: 55px;
        height: 63px;
        margin: 1px 0px 0.8px 139px;
        object-fit: contain;
    }

    @media only screen and (max-width: 600px) {
        .labels{
            padding-left: 65px;
        }
        img.vollcom-cube {
            margin: 1px -11px 0.8px 4px;
        }

        .Munich-Germany-or-remote {
            width: 224px !important;
            margin: 3.2px 0 0 7px;
        }

        .Frontend-Developer-fmd {
            margin: 4.7px 0 0.2px 0px;
        }
    }
</style>