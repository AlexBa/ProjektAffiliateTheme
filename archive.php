<?php get_header(); ?>

<main role="main">
    <?php if (affilicious_theme_is_loose_layout()): ?><div class="container"><?php endif; ?>
        <div class="row">
            <div class="col-md-8">
                <section class="post-collection">
                    <header class="post-collection-header">
                        <div class="row">
                            <div class="col-xs-12">
                                <h1 class="post-collection-title">
                                    <?php
                                    if (is_category()) :
                                        single_cat_title();
                                    elseif (is_tag()) :
                                        single_tag_title();
                                    elseif (is_author()) :
                                        printf(__('Author: %s', 'affilicious-theme'), '<span class="vcard">' . get_the_author() . '</span>');
                                    elseif (is_day()) :
                                        printf(__('Day: %s', 'affilicious-theme'), '<span>' . get_the_date() . '</span>');
                                    elseif (is_month()) :
                                        printf(__('Month: %s', 'affilicious-theme'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'affilicious-theme')) . '</span>');
                                    elseif (is_year()) :
                                        printf(__('Year: %s', 'affilicious-theme'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'affilicious-theme')) . '</span>');
                                    elseif (is_tax('post_format', 'post-format-aside')) :
                                        _e('Asides', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-gallery')) :
                                        _e('Galleries', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-image')) :
                                        _e('Images', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-video')) :
                                        _e('Videos', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-quote')) :
                                        _e('Quotes', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-link')) :
                                        _e('Links', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-status')) :
                                        _e('Statuses', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-audio')) :
                                        _e('Audios', 'affilicious-theme');
                                    elseif (is_tax('post_format', 'post-format-chat')) :
                                        _e('Chats', 'affilicious-theme');
                                    else :
                                        _e('Archives', 'affilicious-theme');
                                    endif;
                                    ?>
                                </h1>
                                <?php $description = term_description(); ?>
                                <?php if (!empty($description)): ?>
                                    <div class="post-collection-description">
                                        <button type="button"
                                                class="btn btn-info btn-circle"
                                                rel="tooltip"
                                                data-toggle="tooltip"
                                                data-placement="left"
                                                title="<?php echo esc_attr(strip_tags($description)); ?>">
                                            <i class="fa fa-question"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </header>
                    <div class="post-collection-body">
                        <div class="row">
                            <?php $count = 0; ?>
                            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                                <?php $count++; ?>
                                <div class="col-md-6">
                                    <?php get_template_part('content', get_post_format()); ?>
                                </div>
                                <?php if($count % 2 == 0): ?>
                                    <div class="clearfix"></div>
                                <?php endif; ?>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </section>
            </div>
            <?php get_sidebar(); ?>
        </div>
    <?php if (affilicious_theme_is_loose_layout()): ?></div><?php endif; ?>
</main>

<?php get_footer(); ?>