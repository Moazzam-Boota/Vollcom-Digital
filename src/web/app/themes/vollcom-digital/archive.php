<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_vollcomdigital_Starter
 */

/**
 * Load values and assign defaults
 * Loop through post objects (assuming this is a multi-select field) ( don't setup postdata )
 * Using this method, the $post object is never changed so all functions need a seccond parameter of the post ID in question.
 */
$term = get_queried_object();
$category_image = get_field('image', $term);
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else if (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$per_page = get_option('posts_per_page');

$hide_empty = '1';
$type = get_query_var('post_type');
$number_of_series = wp_count_posts($type);
$offset = $per_page * ($paged - 1);
$count_posts = wp_count_posts($type)->publish;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$the_query = new WP_Query(array(
    'cat' => $term->term_id,
    'paged' => $paged,
    'posts_per_page' => $per_page,
    'post_type' => $type,
    'offset' => $offset,
    'number' => $per_page,
    'hide_empty' => $hide_empty,
    'order' => 'DESC'
));

get_header();
$lang = wpml_get_current_language();
$url = get_home_url();
$url_str = trim(strval($url), "jobs/");
$post = get_post_type();

?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<meta name=”viewport” content=”width=device-width, initial-scale=1.0”>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <!--Page header-->
        <?php if ($post == strval('post')) { ?>
            <!--Page header-->
            <header class="page-header">
                <div class="container pt-5">
                    <div class="row">
                        <div class="<?php (!empty($category_image)) ? 'col-md-6 ' : ''; ?>col-12 mb-4">
                            <?php the_archive_title('<h1 class="page-title animated text-center text-md-left animatedFadeInUp fadeInUp mb-5">', '</h1>'); ?>
                            <?php the_archive_description('<p class="archive-description">', '</p>'); ?>
                        </div>
                        <?php if (!empty($category_image)) : ?>
                            <div class="col-md-6 mb-4 d-none d-md-block">
                                <img class="img-fluid" src="<?php echo esc_url($category_image['url']); ?>"
                                     alt="<?php echo esc_attr($category_image['alt']); ?>"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            <!--Page header-->

        <?php } else { ?>
            <header class="entry-header mb-5">
                <div class="container-fluid text-md-center pt-5 h-180 linear-gradient-blue position-relative">
                    <?php the_archive_title('<h1 id="job-head" class="entry-title job-title text-white animated fadeInUp mb-3 text-center">', '</h1>'); ?>
                    <?php if ($lang == strval('de')) { ?>
                        <p id="job-text"
                           class="entry-title  text-white animated fadeInUp mb-3 text-center"><?php echo get_post_type(); ?></p>
                    <?php } else { ?>
                        <p id="job-text" class="entry-title text-white animated fadeInUp mb-3 text-center">We are
                            looking
                            for you!</p>

                    <?php } ?>
                    <!--                            --><?php //the_archive_description( '<p class="archive-description">', '</p>' ); ?>

                    <?php if ($lang == strval('de')) { ?>
                        <div class="see-position">
                            <a id="see-position"
                               style="width: 222px; height: 55px;  padding: 14px 30px 18px; border-radius: 4px; text-transform: unset; font-family: 'Roboto', sans-serif; font-size: 1.05rem;"
                               class="btn btn-vd-teal btn-middle-float waves-effect waves-light" href="#open-jobs"
                               role="button">
                                Offene Stellen<i class="far fa-long-arrow-right pl-1"></i>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="see-position">
                            <a id="see-position"
                               style="width: 222px; height: 55px;  padding: 14px 30px 18px; border-radius: 4px; font-family: 'Roboto', sans-serif; text-transform: unset; font-size: 1.05rem;"
                               class="btn btn-vd-teal btn-middle-float waves-effect waves-light" href="#open-jobs"
                               role="button">
                                See open positions<i class="far fa-long-arrow-right pl-1"></i>
                            </a>
                        </div>

                    <?php } ?>
                    <?php if (!empty($category_image)) : ?>
                        <div class="col-md-6 mb-4 d-none d-md-block">
                            <img class="img-fluid" src="<?php echo esc_url($category_image['url']); ?>"
                                 alt="<?php echo esc_attr($category_image['alt']); ?>"/>
                        </div>
                    <?php endif; ?>
                </div>
            </header>
        <?php } ?>
        <!--Page header-->

        <?php if ($post == strval('post')) { ?>
        <div class="container">
            <?php if ($the_query->have_posts()): ?>
                <div id="card-grids" class="mb-5">
                    <?php
                    $category_class = "";
                    if (is_category()) {
                        $category_class = "row-cols-lg-3 g-4 posts-list";
                    }
                    ?>
                    <div class="row row-cols-1 row-cols-md-2 <?= $category_class ?>">
                        <!--Start the Loop-->
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <?php if (is_category()) {
                                get_template_part('template-parts/content', 'category');
                            } elseif (get_post_type() === 'jobs') {
                                get_template_part('template-parts/blocks/panels/job', 'panel-teaser-card');
                            } else {
                                get_template_part('template-parts/content', get_post_format());
                            }
                            ?>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php
                if (function_exists("pagination_nav")) {
                    pagination_nav();
                }
                ?>
            <?php elseif ($type == 'jobs'): ?>
                <div class="d-flex justify-content-center py-5">
                    <p><?php esc_html_e('No jobs currently available', 'wp-vollcom-digital'); ?></p>
                </div>
            <?php else: ?>
                <div class="d-flex justify-content-center py-5">
                    <p><?php esc_html_e('No blog posts found', 'wp-vollcom-digital'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </main><!-- #main -->
    <?php } else { ?>
        <div class="">

            <!--Benefits Block-->
            <div class="container">
                <?php if ($lang == strval('de')) { ?>
                    <div class="row">
                        <div class="col">
                            <div class="row align-items-center pt-5 pb-3 justify-content-center">

                                <div
                                        class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <h2 class="Working-at-Vollcom-Digital">Working at Vollcom Digital</h2>
                                    <p class="You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia">
                                        Wir arbeiten in unserem wunderschönen Mindspace-Büro direkt am Salvatorplatz.
                                        Für all die
                                        großartigen Menschen, die für uns arbeiten, bieten wir tolle Benefits an.</p>
                                    <div class="Rechteck-594">
                                        <span class="Right-now-our-employees-are-working-from-home-But-we-may-require-physical-relocation-for-employees">Aktuell arbeiten unsere Mitarbeiter größtenteils von zuhause. In den nächsten Monaten soll sich unsere Arbeitskultur aber wieder mehr im Büro abspielen. </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 text-end">
                                    <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/Jobs.png"
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="row">
                        <div class="col">
                            <div class="row align-items-center pt-5 pb-3 justify-content-center">

                                <div
                                        class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4">
                                    <h2 class="Working-at-Vollcom-Digital">Working at Vollcom Digital</h2>
                                    <p class="You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia">
                                        You can find our work space at the beautiful office at Mindspace Salvatorplatz.
                                        To show our
                                        appreciation to all of the great people working for us these are some of the
                                        perks we offer
                                        to
                                        you.</p>
                                    <div class="Rechteck-594">
                                        <span class="Right-now-our-employees-are-working-from-home-But-we-may-require-physical-relocation-for-employees">Most of our employees are currently working from home. In the next few months, however, our work culture should take place more in the office again. </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 text-end">
                                    <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/Jobs.png"
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <!--Services Block-->

            <div class="container">
                <?php if ($lang == strval('de')) { ?>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/baloon.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Team-Events</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Nur als Team können wir großartige Dinge schaffen. Deshalb organisieren wir
                                    regelmäßig Events.
                                </p></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/edu.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Bildung</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Wissen ist Macht. Bei uns erhälst du ein Budget für deine ganz persönliche
                                    Weiterbildung.
                                </p></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/bike.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Fahrrad</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Steig auf und radel entspannt am hektischen Stadtverkehr vorbei. Und ganz nebenbei
                                    bleibst
                                    du so noch fit.
                                </p></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/drink.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Getränke</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Trinken ist wichtig. Deshalb warten Wasser, Kaffee und andere kostenfreie Getränke
                                    auf dich.
                                </p></div>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/baloon.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Team Events</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Stay together! Only as team we can achieve great things. That’s why you can take
                                    part in numerous team events.
                                </p></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/edu.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Education</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Stay smart! Knowledge is power. With us you have an annual personal budget for
                                    further
                                    training.
                                </p></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/bike.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Job Bike</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Stay calm! Hop on your bike and get through the city free of traffic jams. This will
                                    also
                                    help
                                    you to stay fit.
                                </p></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="service"><img
                                        src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/drink.png"
                                        width="80px" class="icon">
                                <span class="Team-Events">Free Drinks</span>
                                <p class="Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te">
                                    Stay hydrated! Drinking is important. To help you do a good job, we offer water,
                                    coffee and
                                    other free drinks.
                                </p></div>
                        </div>
                    </div>


                <?php } ?>
            </div>
            <!--Insights Block-->


            <?php if ($lang == strval('de')) { ?>
                <div class="Rechteck-614">
                    <div class="container">
                        <div class="row">

                            <div class="col-xl-4 col-md-12 col-sm-12">
                                <h2 class="Insights">Insights</h2>
                                <p class="Yes-we-love-tasty-foods-and-the-mountains-Thats-why-we-have-regularly-team-events-for-body-and-sou">
                                    Ja, wir lieben leckeres Essen und die Berge. Deshalb organisieren wir regelmäßig
                                    Team-Events für Körper und Seele.</p>
                                <a class="Follow-us-on-Instagram" target="_blank"
                                   href="https://www.instagram.com/vollcom_digital/?hl=de"
                                   style="margin: 10px 10px 0 -1px;">Folge uns auf Instagram<i
                                            class="far fa-long-arrow-right pl-1"></i></a>
                            </div>

                            <div class="col-xl-8 col-md-12 col-sm-12">

                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights1.png">


                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights2.png">


                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights3.png">


                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights4.png">

                            </div>
                        </div>

                    </div>
                </div>

            <?php } else { ?>
                <div class="Rechteck-614">
                    <div class="container">
                        <div id="" class="row">

                            <div class="col-xl-4 col-md-12 col-sm-12">
                                <h2 class="Insights">Insights</h2>
                                <p class="Yes-we-love-tasty-foods-and-the-mountains-Thats-why-we-have-regularly-team-events-for-body-and-sou">
                                    Yes we love tasty foods and the mountains. That’s why we have regularly team events
                                    for
                                    body
                                    and
                                    soul.</p>
                                <a class="Follow-us-on-Instagram" target="_blank"
                                   href="https://www.instagram.com/vollcom_digital/?hl=en"
                                   style="margin: 13px 10px 0 -1px;">Follow us on
                                    Instagram<i class="far fa-long-arrow-right pl-1"></i></a>
                            </div>

                            <div class="col-xl-8 col-md-12 col-sm-12">

                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights1.png">


                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights2.png">


                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights3.png">


                                <img class="insights6"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/insights4.png">

                            </div>
                        </div>

                    </div>
                </div>


            <?php } ?>


            <!--Process Block-->

            <?php if ($lang == strval('de')) { ?>
                <div class="container">
                    <div class="process">
                        <h2 class="Your-way-to-the-team">
                            Dein Weg zu uns
                        </h2>
                        <p class="Thats-how-our-application-process-looks-like">
                            So sieht unser Bewerbungsprozess aus.
                        </p>

                        <div class="process-blocks">
                            <div id="process-images">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step1.png"
                                     class="step1">
                            </div>
                            <div id="process-text" style="margin-left: 28%; margin-top: -27%">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/1.png"
                                     class="process-icon">
                                <span class="Send-your-application">Deine Bewerbung</span>
                                <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Die perfekte
                                    Rolle bei uns gefunden? Dann schicke uns deine Unterlagen zu.</p>

                            </div>


                        </div>

                        <div class="process-blocks">
                            <div id="process-images">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step2.png"
                                     class="step1">
                            </div>
                            <div id="process-text" style="margin-left: -78%; margin-top: -27%">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/2.png"
                                     class="process-icon">
                                <span class="Send-your-application">Wir checken deine Unterlagen</span>
                                <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Nachdem wir
                                    deine Bewerbung erhalten haben, melden wir uns innerhalb einer Woche bei dir.</p>

                            </div>


                        </div>

                        <div class="process-blocks">
                            <div id="process-images">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step3.png"
                                     class="step1">
                            </div>
                            <div id="process-text" style="margin-left: 28%; margin-top: -27%">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/3.png"
                                     class="process-icon">
                                <span class="Send-your-application">Online-Test</span>
                                <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Du hast uns
                                    begeistert! Jetzt ist es Zeit für einen Online-Test, um herauszufinden welche Skills
                                    du
                                    mitbringst.</p>

                            </div>


                        </div>

                        <div class="process-blocks">
                            <div id="process-images">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step4.png"
                                     class="step1">
                            </div>
                            <div id="process-text" style="margin-left:  -78%; margin-top: -27%">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/4.png"
                                     class="process-icon">
                                <span class="Send-your-application">Interview</span>
                                <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Du hast
                                    unser
                                    Interesse geweckt. Perfekt! Wir freuen uns dich in einem Gespräch näher
                                    kennenzulernen.</p>

                            </div>


                        </div>

                        <div class="process-blocks">
                            <div id="process-images">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step5.png"
                                     class="step1">
                            </div>
                            <div id="process-text" style="margin-left: 28%; margin-top: -27%">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/5.png"
                                     class="process-icon">
                                <span class="Send-your-application">Feedback</span>
                                <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Du hörst
                                    innerhalb einer Woche nach dem Online-Test von uns. Wir freuen uns allerdings auch
                                    über
                                    dein Feedback!</p>

                            </div>


                        </div>

                        <div class="process-blocks">
                            <div id="process-images">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step6.png"
                                     class="step1">
                            </div>
                            <div id="process-text" style="margin-left: -78%; margin-top: -27%">
                                <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/6.png"
                                     class="process-icon">
                                <span class="Send-your-application">Willkommen im Team!</span>
                                <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Herzlichen
                                    Glückwunsch, du bist es! Wir freuen uns, dich in unserem Team begrüßen zu
                                    dürfen.</p>

                            </div>


                        </div>

                        <div class="Pfad-611">

                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="process">
                                <h2 class="Your-way-to-the-team">
                                    Your way to the team
                                </h2>
                                <p class="Thats-how-our-application-process-looks-like">
                                    That’s how our application process looks like.
                                </p>

                                <div class="process-blocks">
                                    <div id="process-images">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step1.png"
                                             class="step1">
                                    </div>
                                    <div id="process-text" style="margin-left: 28%; margin-top: -27%">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/1.png"
                                             class="process-icon">
                                        <span class="Send-your-application">Send your application</span>
                                        <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">Find
                                            the perfect
                                            role? Don’t hesitate and send us your application.</p>

                                    </div>


                                </div>

                                <div class="process-blocks">
                                    <div id="process-images">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step2.png"
                                             class="step1">
                                    </div>
                                    <div id="process-text" style="margin-left: -78%; margin-top: -27%">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/2.png"
                                             class="process-icon">
                                        <span class="Send-your-application">Check your documents</span>
                                        <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">
                                            After receiving
                                            your
                                            application we contact you within a week.</p>

                                    </div>


                                </div>

                                <div class="process-blocks">
                                    <div id="process-images">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step3.png"
                                             class="step1">
                                    </div>
                                    <div id="process-text" style="margin-left: 28%; margin-top: -27%">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/3.png"
                                             class="process-icon">
                                        <span class="Send-your-application">Online Test</span>
                                        <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">You
                                            delighted
                                            us!
                                            Now it’s time for our online test to find out which skills you bring to the
                                            team.</p>

                                    </div>


                                </div>

                                <div class="process-blocks">
                                    <div id="process-images">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step4.png"
                                             class="step1">
                                    </div>
                                    <div id="process-text" style="margin-left:  -78%; margin-top: -27%">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/4.png"
                                             class="process-icon">
                                        <span class="Send-your-application">Interview</span>
                                        <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">You
                                            arouse our
                                            interest. Perfect! We look forward becoming more familiar with you in an
                                            interview.</p>

                                    </div>


                                </div>

                                <div class="process-blocks">
                                    <div id="process-images">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step5.png"
                                             class="step1">
                                    </div>
                                    <div id="process-text" style="margin-left: 28%; margin-top: -27%">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/5.png"
                                             class="process-icon">
                                        <span class="Send-your-application">Feedback</span>
                                        <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">You
                                            get feedback
                                            from us within a week after the online test. But we also want to hear your
                                            feedback!</p>

                                    </div>


                                </div>

                                <div class="process-blocks">
                                    <div id="process-images">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/step6.png"
                                             class="step1">
                                    </div>
                                    <div id="process-text" style="margin-left: -78%; margin-top: -27%">
                                        <img src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/6.png"
                                             class="process-icon">
                                        <span class="Send-your-application">Welcome to the team!</span>
                                        <p class="Find-the-perfect-role-Dont-hesitate-and-send-us-your-application">
                                            Congratulations,
                                            you
                                            are a match! We look forward seeing you as a new part of our team.</p>

                                    </div>


                                </div>

                                <div class="Pfad-611">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>



            <?php if ($the_query->have_posts()): ?>
            <div id="open-jobs" class="has-hellgrau-background-color py-5 Rechteck-593">
                <div class="container">
                    <?php if ($lang == strval('de')) { ?>
                        <h2 class="Open-positions">Offene Stellen</h2>
                        <p class="Join-our-team-on-our-mission">Werde Teil des Teams und unserer Mission. </p>
                    <?php } else { ?>
                        <h2 class="Open-positions">Open positions</h2>
                        <p class="Join-our-team-on-our-mission">Join our team on our mission.</p>
                    <?php } ?>

                    <div id="card-grids" class=" row mb-5">
                        <?php
                        $category_class = "";
                        if (is_category()) {
                            $category_class = "row-cols-lg-3 g-4 posts-list";
                        }
                        ?>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div id="" class="row row-cols-1 row-cols-md-1 <?= $category_class ?>">

                                <!--Start the Loop-->
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <?php if (is_category()) {
                                        get_template_part('template-parts/content', 'category');
                                    } elseif (get_post_type() === 'jobs') {
                                        get_template_part('template-parts/blocks/panels/job', 'panel-teaser-card');
                                    } else {
                                        get_template_part('template-parts/content', get_post_format());
                                    }
                                    ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>

                </div>

                <?php if ($lang == strval('de')) { ?>
                    <div class="container-fluid bg-white px-0">
                        <div class="container py-8">
                            <div class="row justify-content-md-center text-center">
                                <div class="col-lg-9">
                                    <h4 id="more-h"><?php esc_html_e('Mehr über Uns', 'wp-vollcom-digital'); ?></h4>
                                    <p id="more-p"><?php esc_html_e('Erfahre, wie wir arbeiten und welche Mission wir täglich verfolgen.', 'wp-vollcom-digital'); ?></p>
                                    <a style="font-family: Roboto;" class="btn btn-vd-teal"
                                       href="<?php echo $url_str; ?>/de/about-us/" about-us"
                                    role="button">
                                    <?php esc_html_e('Mehr erfahren', 'wp-vollcom-digital'); ?><i
                                            class="far fa-long-arrow-right pl-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="container-fluid bg-white px-0">
                        <div class="container py-8">
                            <div class="row justify-content-md-center text-center">
                                <div class="col-lg-9">
                                    <h4 id="more-h"><?php esc_html_e('More about us', 'wp-vollcom-digital'); ?></h4>
                                    <p id="more-p"><?php esc_html_e('Learn how we work and which mission we follow every day.', 'wp-vollcom-digital'); ?></p>
                                    <a style="text-transform: unset;font-size: 16px; font-family: Roboto;"
                                       class="btn btn-vd-teal"
                                       href="<?php echo $url_str; ?>/about-us/" role="button">
                                        <?php esc_html_e('Learn More', 'wp-vollcom-digital'); ?><i
                                                class="far fa-long-arrow-right pl-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>




                <?php
                if (function_exists("pagination_nav")) {
                    pagination_nav();
                }
                ?>
                <?php elseif ($type == 'jobs'): ?>
                    <div class="d-flex justify-content-center py-5">
                        <p><?php esc_html_e('No jobs currently available', 'wp-vollcom-digital'); ?></p>
                    </div>
                <?php else: ?>
                    <div class="d-flex justify-content-center py-5">
                        <p><?php esc_html_e('No blog posts found', 'wp-vollcom-digital'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        </main><!-- #main -->
    <?php } ?>

    <!--Page footer-->
    <?php if ($lang == strval('de')) { ?>
        <div id="page-footer" class="has-hellgrau-background-color py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-lg-4 text-center text-lg-left">
                        <h3 id="form-h"
                            class="mb-5"><?php esc_html_e('Auf dem Laufenden bleiben!', 'wp-vollcom-digital'); ?></h3>
                        <p id="form-p">
                            <?php esc_html_e('Unser Newsletter „Monthly Monitor“ versorgt dich mit News, aktuellen Job-Ausschreibungen und mehr.', 'wp-vollcom-digital'); ?>
                        </p>
                        <?php if (shortcode_exists('contact-form-7')): ?>
                            <?php echo do_shortcode('[contact-form-7 id="312" title="Newsletter Form"]'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="d-none d-lg-block col-lg-4 mb-lg-4">
                        <img class="img-fluid float-right"
                             src="<?php echo get_template_directory_uri() . '/inc/assets/images/vollcom-digital-newsletter.png'; ?>"
                             alt="Vollcom Digital Newsletter"/>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div id="page-footer" class="has-hellgrau-background-color py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-lg-4 text-center text-lg-left">
                        <h3 id="form-h" class="mb-5"><?php esc_html_e('Stay tuned!', 'wp-vollcom-digital'); ?></h3>
                        <p id="form-p">
                            <?php esc_html_e('Subscribe to our „Monthly Monitor“ newsletter and never miss the latest news and current job offers.', 'wp-vollcom-digital'); ?>
                        </p>
                        <?php if (shortcode_exists('contact-form-7')): ?>
                            <?php echo do_shortcode('[contact-form-7 id="312" title="Newsletter Form"]'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="d-none d-lg-block col-lg-4 mb-lg-4">
                        <img class="img-fluid float-right"
                             src="<?php echo get_template_directory_uri() . '/inc/assets/images/vollcom-digital-newsletter.png'; ?>"
                             alt="Vollcom Digital Newsletter"/>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--/.Page footer-->

</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
<style>

    #more-h {
        font-family: 'Rubik', sans-serif;
    }

    #more-p {
        font-family: Roboto;
    }


    #form-h {
        font-family: 'Rubik', sans-serif;
    }

    #form-p {
        font-family: Roboto;
    }

    #cf7md-form .mdc-button {
        width: 55px;
        height: 55px;
        margin: 1px 19px 18px -14px;
        padding: 20px 19px 21px 20px;
    }

    main {

        margin-right: 0;
    }

    .Munich-Germany-or-remote {
        width: 100% !important;
    }

    .benefits {
        width: 1110px;
        height: 450px;
        margin: 80px 45px 40px;
        display: inline-flex;
    }

    img.vollcom-cube {
        float: left !important;
        margin: 1px 24px 0.8px 0px !important;
    }

    #class-job {
        margin-left: 0rem !important;
        width: 100% !important;
    }

    .process-blocks {
        width: 530px;
        height: 140px;
        margin: 60px 0 120px 390px;
    }

    .Pfad-611 {
        width: 0;
        height: 1188px;
        margin-left: 27.7rem;
        margin-top: -88.5rem;
        border: solid 1px #07a8c4;
    }

    .Rechteck-593 {
        height: auto;
        padding: 70px 0px;
        background-color: #e5eaf4;
    }

    .process {
        width: 920px;
        height: 1575px;
        margin: 120px 121px;
    }

    #jobs-card {
        width: 70%;
        margin-left: 10rem;
    }

    .Open-positions {
        height: 37px;
        font-family: 'Rubik', sans-serif;
        font-size: 24px;
        font-weight: 700;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: center;
        color: #181347;
    }

    .Join-our-team-on-our-mission {
        height: 38px;
        margin: 10px 0 31px 0px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: center;
        color: #181347;
    }

    .Your-way-to-the-team {
        width: 730px;
        height: 37px;
        margin: 0 95px;
        font-family: 'Rubik', sans-serif;
        font-size: 24px;
        font-weight: 700;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: center;
        color: #181347;
    }

    .Thats-how-our-application-process-looks-like {
        width: 730px;
        height: 38px;
        margin: 8px 95px 60px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: center;
        color: #181347;
    }

    .service {
        width: 350px;
        height: 146px;
        margin: 25px 20px 52px 0;
        display: inline-block;
    }

    .arrow-right-short {
        width: 16px;
        height: 14px;
        margin: 4px 0 3px 10px;
        background-color: #07a8c4;
    }

    img.step1 {
        height: 168px;
        margin: 0 40px 0 -28px;
        object-fit: fill;
        border-radius: 70px;
    }

    .Send-your-application {
        width: 303px;
        height: 24px;
        margin: -56px -42px 14px -6px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 700;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.33;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .Find-the-perfect-role-Dont-hesitate-and-send-us-your-application {
        width: 350px;
        height: 51px;
        margin: 10px 0 47px 40px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .Yes-we-love-tasty-foods-and-the-mountains-Thats-why-we-have-regularly-team-events-for-body-and-sou {
        margin: 0px 0px 15px 0px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .Follow-us-on-Instagram {
        width: 212px;
        height: 21px;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        cursor: pointer;
        line-height: 1.88;
        letter-spacing: normal;
        text-align: right;
        color: #07a8c4;
    }

    .insights6 {
        width: 160px;
        height: 160px;
        margin: 0 09px;
        border-radius: 4px;
    }


    .Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te {
        width: 350px;
        height: 81px;
        margin: -3px 0 0;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .Rechteck-614 {
        margin: 120px 0px;
        padding: 70px 45px;
        background-color: #e5eaf4;
    }

    .service-block {
        width: 79rem;
        margin-left: 52px;
    }

    .Insights {
        width: 350px;
        height: 37px;
        margin: 0 30px 0 0;
        font-family: 'Rubik', sans-serif;
        font-size: 24px;
        font-weight: 700;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .Team-Events {
        width: 284px;
        height: 30px;
        margin: 13px 0 22px -5px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 700;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.33;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .Working-at-Vollcom-Digital {
        width: 445px;
        height: 37px;
        margin: 80px 35px 0 0;
        font-family: 'Rubik', sans-serif;
        font-size: 24px;
        font-weight: 700;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    .process-icon {
        width: 56px;
        height: 32px;
        margin: 0 10px 0px 27px;
        object-fit: contain;
    }

    img.icon {
        width: 56px;
        height: 50px;
        margin: 0 10px 15px 0;
        object-fit: contain;
    }

    .You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia {
        width: 467px;
        height: 105px;
        margin: 12px 35px 20px 0;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 300;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    #job-text {
        margin-top: -13px;
    }

    .Rechteck-594 {
        width: 445px;
        height: 109px;
        margin: 20px 35px 145px 0;
        padding: 20px;
        border-radius: 4px;
        background-color: #f8f8f8;
    }

    .Right-now-our-employees-are-working-from-home-But-we-may-require-physical-relocation-for-employees {
        width: 405px;
        height: 69px;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    img.Jobs {
        width: 630px;
        height: 454px;
        margin: 0 0 56px 35px;
        object-fit: contain;
    }

    #job-head {
        font-family: 'Rubik', sans-serif !important;
    }


    #job-text {
        font-family: 'Roboto', sans-serif !important;
    }


    @media screen and (min-device-width: 300px) and (max-device-width: 375px) {
        .insights6 {
            width: 45% !important;
            height: 160px !important;
            margin: 0px 0px 23px 2px !important;
            border-radius: 4px !important;
        }
    }
    @media screen and (min-device-width: 280px) and (max-device-width: 767px) {

        #see-position {
            margin: 0px 0px 0px 5px !important;
        }

        .see-position {
            display: grid;
            align-items: center;
            justify-content: center;
        }

        .btn-middle-float {
            position: relative !important;
            transform: translate(00%) !important;
        }

        .benefits {
            display: contents;
        }

        .Working-at-Vollcom-Digital {
            width: auto !important;
            margin: 0px 35px 0 -5px !important;
            font-size: 22px;
        }

        #job-text {
            margin-top: 8px;
        }

        .You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia {
            width: auto !important;
            font-size: 16px;
        }

        .Rechteck-594 {
            width: auto !important;
            height: auto !important;
            margin: 35px 35px 32px -5px !important;
        }

        img.Jobs {
            width: 363px !important;
            height: 282px !important;
            margin: 0px 0 56px -6px !important;
        }

        .service-block {
            width: 22rem !important;
            margin-left: 9px !important;
        }

        .Rechteck-614 {
            height: 662px !important;
            margin: 60px 0px !important;
            padding: 70px 0px !important;
            background-color: #e5eaf4 !important;
        }

        #insights {
            display: table !important;
            margin-left: -0.5rem !important;
            padding-left: 10px !important;
        }

        .Follow-us-on-Instagram {
            width: 204px !important;
            height: 21px !important;

        }

        #job-head {
            margin-top: -20px;
            font-family: 'Rubik', sans-serif !important;
        }

        .insights6 {
            width: 160px ;
            height: 160px !important;
            margin: 9px 0px 23px 16px ;
            border-radius: 4px !important;
        }

        .process {
            width: auto !important;
            height: 1566px !important;
            margin: 60px 6px !important;
        }

        .Your-way-to-the-team {
            width: auto !important;
            height: 37px !important;
            margin: 0 -8px !important;
        }

        .Thats-how-our-application-process-looks-like {
            width: auto !important;
            height: 38px !important;
            margin: 8px -4px 60px !important;
        }

        .Pfad-611 {
            margin-left: 2.5rem !important;
            margin-top: -91.5rem !important;
            height: 1225px !important;
        }

        #process-images {
            margin-left: -0.5rem !important;
            width: 7rem !important;
        }

        #process-text {
            margin-left: 28% !important;
            margin-top: -46% !important;
            width: 250px !important;
        }

        .process-icon {
            width: 47px !important;
            height: 25px !important;
        }

        img.step1 {
            height: 135px !important;
            margin: 0 40px 0 -16px !important;
            object-fit: fill !important;
            border-radius: 70px !important;
        }

        .Send-your-application {
            width: 303px !important;
            height: 25px !important;
            margin: -56px -42px 14px -14px !important;
            font-size: 15px !important;
        }

        .Find-the-perfect-role-Dont-hesitate-and-send-us-your-application {
            width: 218px !important;
            font-size: 15px !important;
        }

        .Rechteck-593 {
            width: auto !important;
            height: auto !important;
            padding: 70px 0px !important;
        }

        .Open-positions {
            width: auto !important;
            margin-left: -6% !important;
        }

        .Join-our-team-on-our-mission {
            width: auto !important;
            margin: 10px 0 31px -6% !important;
        }

        #jobs-card {
            width: 24rem !important;
            margin-left: -1rem !important;
        }

        #welcom-text {
            margin-top: 101px !important;
        }

        .process-blocks {
            width: 250px !important;
            height: 140px !important;
            margin: 57px 0 120px 0px !important;
        }

        .service {
            width: auto;
            height: 146px;
            margin: 25px 20px 52px 0;
            display: inline-block;
        }

        .Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te {
            width: auto;
        }
    }

    @media screen and (min-width: 375px) and (max-width: 390px) {

        #see-position {
            margin-left: 9px !important;
        }

        .Open-positions {
            width: 360px !important;
            margin-left: -10% !important;
        }

        #jobs-card {
            width: 22rem !important;
            margin-left: -1rem !important;
        }

        .Rechteck-593 {
            height: auto;
            margin: 0px 0px;
        }

        .Join-our-team-on-our-mission {
            width: 376px !important;
            margin: 10px 0 31px -6% !important;
        }

        .insights6 {
            width: 154px !important;
            height: 160px !important;
            margin: 9px 5px 22px 0px !important;
            border-radius: 4px !important;
        }

        .Yes-we-love-tasty-foods-and-the-mountains-Thats-why-we-have-regularly-team-events-for-body-and-sou {
            margin: ;
            height: 104px !important;
            height: 0px;
        }

        .Insights {
            width: 293px !important;
        }

        .Rechteck-614 {
            width: auto !important;
        }

        .process {
            width: auto !important;
        }

        .Your-way-to-the-team {
            width: 357px !important;
        }

        .Thats-how-our-application-process-looks-like {
            width: 350px !important;
            margin: 8px 0px 60px !important;
        }

        #process-text {
            width: 282px !important;
        }

        .service {
            margin: 25px 2px 52px 0 !important;
        }

        .service-block {
            width: 22rem !important;
        }

        .You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia {
            width: 360px !important;
        }
    }

    @media screen and (min-device-width: 600px) and (max-device-width: 767px) {
        img.vollcom-cube {
            float: left;
        }

        #class-job {
            margin-left: 3rem !important;
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 991px) {
        #see-position {
            margin: 0px 0px 0px 4px !important;
        }

        .You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia {
            width: auto !important;
        }

        .benefits {
            display: contents;
        }

        .Working-at-Vollcom-Digital {
            margin: 0px 35px 0 -5px !important;
        }

        .Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te {
            width: 319px !important;
        }

        #job-text {
            margin-top: 8px;
        }

        .You-can-find-our-work-space-at-the-beautiful-office-at-Mindspace-Salvatorplatz-To-show-our-apprecia {

            margin-left: -5px !important;
        }

        .Rechteck-594 {
            width: auto !important;
            height: 124px !important;
            margin: 35px 35px 32px -5px !important;
        }

        img.Jobs {
            width: 690px !important;
            height: 500px !important;
            margin: 0px 0 56px -6px !important;
        }

        .service-block {
            width: 735px !important;
            margin-left: -4px !important;
        }

        .Rechteck-614 {
            height: 450px !important;
            margin: 49px 0px !important;
            padding: 70px 0px !important;
            background-color: #e5eaf4 !important;
        }

        #insights {
            display: table !important;
            margin-left: 1.5rem !important;
        }

        .Follow-us-on-Instagram {
            width: 204px !important;
            height: 21px !important;

        }

        #job-head {
            margin-top: -20px;
            font-family: 'Rubik', sans-serif !important;
        }

        .insights6 {
            width: 130px !important;
            height: 124px !important;
            margin: 0px 10px;
        }

        .process {
            width: 768px !important;
            height: 1566px !important;
            margin: 60px -178px !important;
        }

        .Your-way-to-the-team {
            width: 757px !important;
            height: 37px !important;
            margin: 0 145px !important;
        }

        .Thats-how-our-application-process-looks-like {
            width: 757px !important;
            height: 38px !important;
            margin: 8px 144px 20px !important;
        }

        .Pfad-611 {
            margin-left: 30.5rem !important;
            /*margin-top: -91.5rem !important;*/
            height: 1225px !important;
        }

        #process-images {
            margin-left: 2.5rem !important;
            /*width: 140px !important;*/
        }

        #process-text {
            /*margin-left: 28% !important;*/
            /*margin-top: -16% !important;*/
            /*width: 315px !important;*/
        }

        .process-icon {
            width: 60px !important;
            height: 25px !important;
            margin-left: 60px;
        }

        img.step1 {
            /*height: 135px !important;*/
            /*margin: 0 0px 0 -123px !important;*/
            object-fit: fill !important;
            border-radius: 70px !important;
        }

        .Send-your-application {
            width: 527px !important;
            height: 25px !important;
            margin: -56px -42px 14px -10px !important;
            font-size: 15px !important;
        }

        .Find-the-perfect-role-Dont-hesitate-and-send-us-your-application {
            width: 270px !important;
            font-size: 15px !important;
            margin-left: 79px;
        }

        .Rechteck-593 {
            height: auto !important;
            padding: 70px 0px !important;
        }

        .Open-positions {
            width: auto !important;
            margin-left: -6% !important;
        }

        .Join-our-team-on-our-mission {
            width: auto !important;
            margin: 10px 0 31px -6% !important;
        }

        #jobs-card {
            width: 36rem !important;
            margin-left: 4rem !important;
        }


        #welcom-text {
            margin-top: 101px !important;
        }

        .process-blocks {
            width: 405px;
            height: 140px;
            /*margin: 60px 0 120px 240px;*/
        }

        .service {
            width: 345px;
            height: 146px;
            margin: 25px 20px 52px 0;
            display: inline-block;
        }

        #class-job {
            margin-left: 0rem !important;
        }

    }

    @media only screen and (min-device-width: 992px) and (max-device-width: 1199px) {
        #jobs-card {
            margin-left: 10rem !important;
        }

        img.vollcom-cube {
            margin: 1px 10px 0.8px 20px !important;
        }

        .service {
            width: auto !important;
            margin: 25px 0px 52px 0;
        }

        .mx-3 {
            margin-left: 0px !important;
        }

        .Rechteck-594 {
            margin: 0px 35px 32px -5px !important;
        }

        img.Jobs {
            margin: 0px 0 56px 135px !important;
        }

        .Stay-together-Only-as-team-we-can-achieve-great-things-Thats-why-you-can-take-part-in-numerous-te {
            width: 310px !important;
        }

        .service-block {
            margin-left: 140px !important;
        }

        .Rechteck-614 {
            /*width: 1042px!important;*/
            padding: 70px 127px !important;
        }

        .process {
            margin: 60px 0px !important;
        }

        .Rechteck-593 {
            padding: 70px 0px !important;
        }
    }

    @media only screen and (min-device-width: 1280px) and (max-device-width: 1280px) {
        .service-block {
            width: 70rem;
            margin-left: 52px;
        }

        .insights6 {
            width: 160px;
            height: 160px;
            margin: 0 4px;
            border-radius: 4px;
        }

        .Rechteck-593 {
            height: auto;
            background-color: #e5eaf4;
        }

        .Open-positions {
            margin-left: 23%;
        }

        .Open-positions {
            margin-left: 9%;
        }

        .Join-our-team-on-our-mission {
            margin-left: 73px;
        }

        #jobs-card {
            margin-left: 15.5rem;
        }

        .benefits {
            margin: 80px 30px 1px;
        }

        #insights {
            margin-left: 5rem !important;
        }

        .Rechteck-614 {
            margin: 116px 0px;
            padding: 70px 0px;
            background-color: #e5eaf4;
        }
    }

</style>