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

global $wp;
$params = $_GET['id'];


$job_position_id = $params;
if (empty($job_position_id))
    return;

$hostname = 'vollcom-digital';
$lang = wpml_get_current_language(); // Depending on implementation of multilingual content
//$positions = simplexml_load_file('https://' . $hostname . '.jobs.personio.de/xml?language=' . $lang);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://' . $hostname . '.jobs.personio.de/xml?language=' . $lang,
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
    if ($position->id != $job_position_id)
        continue;
    ?>
    <article>

        <header class="entry-header mb-5">
            <div class="container-fluid text-md-center pt-5 h-180 linear-gradient-blue position-relative">
                <h1 class="entry-title job-title text-white animated fadeInUp mb-3 text-center">
                    <?php echo $position->name; ?></h1>

                <?php if ($lang == strval('de')) { ?>
                <div class="apply-now">
                    <a class="btn btn-vd-teal btn-middle-float" href="#application-form" role="button">
                        <?php esc_html_e('Jetzt bewerben', 'wp-vollcom-digital'); ?><i
                                class="far fa-long-arrow-right pl-1"></i>
                    </a>
                </div>
                <?php }else{ ?>
                    <div class="apply-now">
                        <a class="btn btn-vd-teal btn-middle-float" href="#application-form" role="button">
                            <?php esc_html_e('Apply now', 'wp-vollcom-digital'); ?><i
                                    class="far fa-long-arrow-right pl-1"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </header>


        <!--Page content-->
        <div class="container">
            <?php if (shortcode_exists('shariff')): ?>
                <!--Post meta-->
                <div style="position:sticky; margin-left:1%;" id="social-sharing" class="col-xl-3 col-lg-12 col-md-12">
                    <!--Social Sharing-->
                    <div class="col-xl-3 col-lg-12 col-md-12">
                        <?php
                        if ($lang == strval('de')) { ?>
                            <h6 class="vd-gray font-weight-500"><?php esc_html_e('Teilen', 'wp-vollcom-digital/') ?></h6>
                        <?php } else { ?>
                            <h6 class="vd-gray font-weight-500"><?php esc_html_e('Share', 'wp-vollcom-digital/') ?></h6>
                        <?php } ?>
                        <?php echo do_shortcode('[shariff]'); ?>
                    </div>
                    <!--/.Social Sharing-->
                </div>
                <!--Post meta-->
            <?php endif; ?>

            <div id="job-content" class="row justify-content-md-center">
                <!--Post content-->
                <div class="col-lg-9">

                    <div class="personio-job" style="padding-bottom: 2rem">
                        <div class="container mb-5" style="background-color: #e5eaf4">
                            <div class="row p-3 job-info-box">
                                <div class="col-lg-6 col-sm-6">
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
                            foreach ($position->jobDescriptions->jobDescription as $description) {

                                if ($description->name == strval('Nice to have') && strlen($description->value) <= 72) {

                                    $description->name = '';

                                }

                                echo '<h4>' . $description->name . '</h4>';
                                echo $description->value;
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!--Post content-->
            </div>
        </div>

        <div style="position:sticky;" id="social-sharing-tablet" class="col-xl-3 col-lg-12 col-md-12">
            <!--Social Sharing-->
            <div class="col-xl-3 col-lg-12 col-md-12">
                <?php
                if ($lang == strval('de')) { ?>
                    <h6 class="vd-gray font-weight-500"><?php esc_html_e('Teilen', 'wp-vollcom-digital/') ?></h6>
                <?php } else { ?>
                    <h6 class="vd-gray font-weight-500"><?php esc_html_e('Share', 'wp-vollcom-digital/') ?></h6>
                <?php } ?>
                <?php echo do_shortcode('[shariff]'); ?>
            </div>
            <!--/.Social Sharing-->
        </div>

        <!--/.Page content-->
        <div id="application-form" class="container-fluid has-hellgrau-background-color-with-deco">
            <div class="container">
                <div class="row pt-5 justify-content-md-center text-center">
                    <div class="col-lg-9 px-0">
                        <?php if ($lang == strval('de')) { ?>
                            <h3><?php esc_html_e('Bist du der/die Richtige?', 'wp-vollcom-digital'); ?></h3>
                            <p><?php esc_html_e('Wir freuen uns dich kennenzulernen. Bitte fülle einfach das untenstehende Formular aus. Wir wünschen bitte keine Bewerbungen von Recruitern.', 'wp-vollcom-digital'); ?></p>
                        <?php } else { ?>
                            <h3><?php esc_html_e('Are you the one?', 'wp-vollcom-digital'); ?></h3>
                            <p><?php esc_html_e('We look forward to meeting you. Please fill out the following form. We only wish to receive applications from principal job seekers – no recruiters, please.', 'wp-vollcom-digital'); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="row pt-4 justify-content-md-center">
                    <div class="col-md-9 bg-white py-4">
                        <div class="row">
                            <div class="col-4 col-md-2 text-center px-4">

                                <img class="img-fluid"
                                     src="<?php get_home_url() ?>/app/themes/vollcom-digital/inc/assets/images/icon.png"
                                     width="80px"
                                     alt="<?php esc_html_e('Vollcam Digital - Help', 'wp-vollcom-digital'); ?>"/>
                            </div>
                            <div class="col-8 col-md-10 pl-0">

                                <?php if ($lang == strval('de')) { ?>
                                    <h5><?php esc_html_e('Fragen oder Probleme?', 'wp-vollcom-digital'); ?></h5>
                                    <p><?php esc_html_e('Unser HR-Team ist für dich da', 'wp-vollcom-digital'); ?>: <a
                                                class="teal-text" href="mailto:jobs@vollcom-digital.com">jobs@vollcom-digital.com</a>
                                    </p>
                                <?php } else { ?>
                                    <h5><?php esc_html_e('Questions or problems?', 'wp-vollcom-digital'); ?></h5>
                                    <p><?php esc_html_e('Our HR team is here for you', 'wp-vollcom-digital'); ?>: <a
                                                class="teal-text" href="mailto:jobs@vollcom-digital.com">jobs@vollcom-digital.com</a>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-5 py-md-4 justify-content-md-center">
                    <div class="col-md-9 bg-white p-4">
                        <?php if (shortcode_exists('contact-form-7')): ?>
                            <?php if ($lang == strval('de')) { ?>
                                <h3 class="pb-4"><?php esc_html_e('Jetzt bewerben', 'wp-vollcom-digital'); ?></h3>
                            <?php } else { ?>
                                <h3 class="pb-4"><?php esc_html_e('Apply now', 'wp-vollcom-digital'); ?></h3>
                            <?php } ?>
                            <?php echo do_shortcode('[contact-form-7 id="310"]'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-white px-0">
            <div class="container py-8">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-9">
                        <?php if ($lang == strval('de')) { ?>
                            <h4><?php esc_html_e('Arbeiten bei Vollcom Digital', 'wp-vollcom-digital'); ?></h4>
                            <p><?php esc_html_e('Unsere Mitarbeiter sind das Herzstück des Unternehmens. Und so behandeln wir sie auch.', 'wp-vollcom-digital'); ?></p>

                        <?php } else { ?>
                            <h4><?php esc_html_e('Working at Vollcom Digital', 'wp-vollcom-digital'); ?></h4>
                            <p><?php esc_html_e('Our employees are the core of the company. That’s why we offer some great perks to them.', 'wp-vollcom-digital'); ?></p>
                        <?php } ?>
                        <?php
                        $jobs_page = get_post_type_archive_link('jobs');
                        ?>
                        <?php if ($lang == strval('de')) { ?>
                            <a class="btn btn-vd-teal" href="<?= $jobs_page ?>" role="button">
                                <?php esc_html_e('Mehr erfahren', 'wp-vollcom-digital'); ?><i
                                        class="far fa-long-arrow-right pl-1"></i>
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-vd-teal" href="<?= $jobs_page ?>" role="button">
                                <?php esc_html_e('Learn More', 'wp-vollcom-digital'); ?><i
                                        class="far fa-long-arrow-right pl-1"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Page footer-->
        <div id="page-footer" class="has-hellgrau-background-color-with-deco py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-4 text-lg-left">
                        <?php if ($lang == strval('de')) { ?>
                            <h3 class="mb-5 d-inline-block"><?php esc_html_e('Auf dem Laufenden bleiben!', 'wp-vollcom-digital'); ?></h3>

                            <p>
                                <?php esc_html_e('Unser Newsletter „Monthly Monitor“ versorgt dich mit News, aktuellen Job-Ausschreibungen und mehr.', 'wp-vollcom-digital'); ?>
                            </p>
                        <?php } else { ?>
                            <h3 class="mb-5 d-inline-block"><?php esc_html_e('Stay tuned!', 'wp-vollcom-digital'); ?></h3>
                            <p>
                                <?php esc_html_e('Subscribe to our „Monthly Monitor“ newsletter and never miss the latest news and current job offers.', 'wp-vollcom-digital'); ?>
                            </p>
                        <?php } ?>
                        <div class="application-form-container">
                            <?php if (shortcode_exists('contact-form-7')): ?>
                                <?php echo do_shortcode('[contact-form-7 id="3396" title="Blogs Newsletter Form"]'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-lg-block col-lg-4 mb-4">
                        <img class="img-fluid float-right"
                             src="<?php echo get_template_directory_uri() . '/inc/assets/images/vollcom-digital-newsletter.png'; ?>"
                             alt="Vollcom Digital Newsletter"/>
                    </div>
                </div>
            </div>
        </div>
        <!--/.Page footer-->
    </article>

<?php } ?>


<style>
    .py-8 {
        padding-top: 120px !important;
        padding-bottom: 120px !important;
    }

    #job-content {
        margin-top: -15%;
    }

    .shariff.shariff-align-center ul {
        margin-left: 0% !important;
    }

    #social-sharing-tablet {
        display: none;
    }

    @media only screen and (max-width: 1024px) {
        #social-sharing-tablet {
            display: block;
        }

        .apply-now {
            display: grid;
            align-items: center;
            justify-content: center;
        }

        .btn-middle-float {
            position: relative !important;
            transform: translate(00%) !important;
        }

        .font-weight-500 {
            text-align: center !important;
        }

        #job-content {
            margin-top: 0% !important;
        }

        #social-sharing {
            display: none;
        }

        .shariff ul {
            flex-flow: row wrap !important;
        }

        .shariff.shariff-align-center ul {
            justify-content: center;
            align-items: center;
        }

        #social-sharing {
            margin-bottom: 30px !important;
            top: 224rem;
            padding: 180px 8px 8px 8px !important
        }
    }

    @media only screen and (max-width: 600px) {

        .font-weight-500 {
            text-align: center !important;
        }

        .apply-now {
            display: grid;
            align-items: center;
            justify-content: center;
        }

        .btn-middle-float {
            position: relative !important;
            transform: translate(00%) !important;
        }

        #social-sharing {
            margin-bottom: 30px !important;
            top: 224rem;
            padding: 8px !important;
        }
    }


</style>

