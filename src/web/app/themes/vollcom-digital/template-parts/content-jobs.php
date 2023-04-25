<?php
/**
 * Template part for displaying a post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_vollcomdigital_Starter
 */
/**
 * Load values and assign defaults
 */
$job_position_id = get_field('position_id');
if(empty($job_position_id))
    return;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$enable_vc = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true);
	if(!$enable_vc ) {
		?>
        <header class="entry-header mb-5">
            <div class="container-fluid text-md-center pt-5 h-180 linear-gradient-blue position-relative">
                <?php the_title( '<h1 class="entry-title job-title text-white animated fadeInUp mb-3 text-center">', '</h1>' ); ?>
                <a class="btn btn-vd-teal btn-middle-float" href="#application-form" role="button">
                    <?php esc_html_e('Apply now','wp-vollcom-digital'); ?><i class="far fa-long-arrow-right pl-1"></i>
                </a>
            </div>
        </header>
	<?php } ?>

    <!--Page content-->
    <div class="container">
        <div class="row justify-content-md-center">
            <!--Post content-->
            <div class="col-lg-9">
                <div class="personio-job">
                    <?php
                    the_content();
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

                    foreach ($positions as $position) {
                        if($position->id != $job_position_id)
                            continue;
                        ?>
                        <div class="container mb-5" style="background-color: #e5eaf4">
                            <div class="row p-3 job-info-box">
                                <div class="col-lg-6">
                                    <h5><?= esc_html_e('Location', 'wp-vollcom-digital'); ?></h5>
                                    <p><?= $position->office ?></p>

                                    <h5><?= esc_html_e('Work Type', 'wp-vollcom-digital'); ?></h5>
                                    <p><?= $position->schedule ?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h5><?= esc_html_e('Employment Type', 'wp-vollcom-digital'); ?></h5>
                                    <p><?= $position->employmentType ?></p>

                                    <h5><?= esc_html_e('Department', 'wp-vollcom-digital'); ?></h5>
                                    <p><?= $position->department ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="job_descriptions_entries">
                            <?php
                            foreach ($position->jobDescriptions->jobDescription as $description){
                                echo '<h4>'.$description->name. '</h4>';
                                echo $description->value;
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--Post content-->
        </div>
    </div>
    <!--Page content-->
    <?php if ( shortcode_exists('shariff') ): ?>
        <!--Post meta-->
        <div id="social-sharing" class="mb-4 text-center">
            <!--Social Sharing-->
            <div class="my-3 mb-lg-0">
                <h6 class="vd-gray font-weight-500"><?php esc_html_e('Share!', 'wp-vollcom-digital'); ?></h6>
                <?php echo do_shortcode('[shariff]'); ?>
            </div>
            <!--/.Social Sharing-->
        </div>
        <!--Post meta-->
    <?php endif; ?>
    <!--/.Page content-->
    <div id="application-form" class="container-fluid has-hellgrau-background-color-with-deco">
        <div class="container">
            <div class="row pt-5 justify-content-md-center text-center">
                <div class="col-lg-9 px-0">
                    <h3><?php esc_html_e('Are you the one?', 'wp-vollcom-digital'); ?></h3>
                    <p><?php esc_html_e('We look forward to meeting you. Please fill out the following form. We only wish to receive applications from principal job seekers – no recruiters, please.', 'wp-vollcom-digital'); ?></p>
                </div>
            </div>
            <div class="row pt-4 justify-content-md-center">
                <div class="col-md-9 bg-white py-4">
                    <div class="row">
                        <div class="col-4 col-md-2 text-center px-4">
                            <img class="img-fluid" src="<?php echo get_template_directory_uri() . '/inc/assets/images/vollcom-digital-anna.png' ;?>" width="80px" alt="<?php esc_html_e('Vollcam Digital - Help', 'wp-vollcom-digital'); ?>" />
                        </div>
                        <div class="col-8 col-md-10 pl-0">
                            <h5><?php esc_html_e('Questions or problems?', 'wp-vollcom-digital'); ?></h5>
                            <p><?php esc_html_e('Anna is here for you', 'wp-vollcom-digital'); ?>: <span class="teal-text">jobs[at]vollcom-digital.com</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-5 py-md-4 justify-content-md-center">
                <div class="col-md-9 bg-white p-4">
                    <?php if ( shortcode_exists('contact-form-7') ): ?>
                        <h3 class="pb-4"><?php esc_html_e('Apply now', 'wp-vollcom-digital'); ?></h3>
                        <?php echo do_shortcode( '[contact-form-7 id="310"]' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white px-0">
        <div class="container py-8">
            <div class="row justify-content-md-center text-center">
                <div class="col-lg-9">
                    <h4><?php esc_html_e('Working at Vollcom Digital', 'wp-vollcom-digital'); ?></h4>
                    <p><?php esc_html_e('Our employees are the core of the company. That’s why we offer some great perks to them.', 'wp-vollcom-digital'); ?></p>
                    <?php
                        $jobs_page = get_post_type_archive_link('jobs');
                    ?>
                    <a class="btn btn-vd-teal" href="<?= $jobs_page ?>" role="button">
                        <?php esc_html_e('Learn More','wp-vollcom-digital'); ?><i class="far fa-long-arrow-right pl-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--Page footer-->
    <div id="page-footer" class="has-hellgrau-background-color-with-deco py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mb-4 text-lg-left">
                    <h3 class="mb-5 d-inline-block"><?php esc_html_e('Stay tuned!', 'wp-vollcom-digital'); ?></h3>
                    <span class="yellow-badge">
                        <?php esc_html_e('Once a month', 'wp-vollcom-digital'); ?>
                    </span>
                    <p>
                        <?php esc_html_e('Subscribe to our „Monthly Monitor“ newsletter and never miss the latest news and current job offers.', 'wp-vollcom-digital'); ?>
                    </p>
                    <div class="application-form-container">
                        <?php if( shortcode_exists('contact-form-7') ): ?>
                            <?php echo do_shortcode('[contact-form-7 id="3396" title="Newsletter Form"]'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-lg-block col-lg-4 mb-4">
                    <img class="img-fluid float-right" src="<?php echo get_template_directory_uri() . '/inc/assets/images/vollcom-digital-newsletter.png' ;?>" alt="Vollcom Digital Newsletter" />
                </div>
            </div>
        </div>
    </div>
    <!--/.Page footer-->

</article><!-- #post-## -->