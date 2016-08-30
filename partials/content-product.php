<?php do_action('affilicious_theme_product_above_post'); ?>

<?php $product = affilicious_get_product(); ?>
<article id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>
         itemscope itemtype="http://schema.org/Product">

    <header class="product-header">
        <div class="panel">
            <div class="panel-heading">
                <h1 class="product-title" itemprop="name">
                    <?php the_title(); ?>
                </h1>

                <p class="product-review" itemprop="aggregateRating"
                   itemscope itemtype="http://schema.org/AggregateRating">
                    <?php $starRating = affilicious_get_product_star_rating($product); ?>

                    <span class="product-review-rating" itemprop="reviewRating"
                          itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="0">
                        <meta itemprop="bestRating" content="5">
                        <meta itemprop="ratingValue" content="<?php echo $starRating; ?>">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <?php if ($starRating >= ($i + 1)): ?>
                                <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                            <?php elseif($starRating >= ($i + 0.5)): ?>
                                <i class="fa fa-star-half-o fa-lg" aria-hidden="true"></i>
                            <?php else: ?>
                                    <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </span>

                    <?php if($numberOfRatings = affilicious_get_product_number_of_ratings($product)): ?>
                        <span class="product-review-number-rating" itemprop="aggregateRating"
                              itemscope itemtype="http://schema.org/AggregateRating">
                            <?php echo sprintf(_n(
                                'based on <span itemprop="reviewCount">%s</span> review',
                                'based on <span itemprop="reviewCount">%s</span> reviews',
                                $numberOfRatings, 'affilicious-theme'),
                                $numberOfRatings); ?>
                        </span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if($imageGallery = affilicious_get_product_image_gallery($product)): ?>
                            <div class="product-image-gallery">
                                <div class="portfolio-slider">
                                    <div class="slick-slider">
                                        <?php foreach ($product->getImageGallery() as $image): ?>
                                            <div class="slick-slider-item" itemprop="image">
                                                <?php echo wp_get_attachment_image($image, array(250, 250)); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="thumb-slider">
                                    <div class="slick-slider">
                                        <?php foreach ($product->getImageGallery() as $image): ?>
                                            <div class="slick-slider-item">
                                                <?php echo wp_get_attachment_image($image, array(50, 50)); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="product-thumbnail">
                                <?php if(has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else: ?>
                                    <i class="fa fa-question-circle-o fa-2x"></i>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <?php if(has_excerpt()): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="product-excerpt" itemprop="description">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="product-details table table-striped">
                                    <tbody>
                                        <?php $affiliateLink = affilicious_get_product_affiliate_link($product); ?>
                                        <?php $price = affilicious_get_product_price($product); ?>
                                        <?php if(!empty($price)): ?>
                                            <tr>
                                                <td><?php _e('Price', 'affilicious-theme'); ?></td>
                                                <td>
                                                    <?php if(!empty($affiliateLink)): ?>
                                                    <a class="price" href="<?php echo $affiliateLink; ?>" itemprop="price">
                                                        <?php echo $price; ?>
                                                    </a>
                                                    <?php else: ?>
                                                    <span class="price" itemprop="price">
                                                        <?php echo $price; ?>
                                                    </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php $fields = affilicious_get_product_details(); ?>
                                        <?php if(!empty($fields)): ?>
                                            <?php foreach ($fields as $field): ?>
                                                <tr>
                                                    <td><?php echo $field['name']; ?></td>
                                                    <?php if($field['type'] === 'file'): ?>
                                                        <td><?php echo wp_get_attachment_link($field['value'], 'medium', false, false, __('Download', 'affiliate-theme')); ?></td>
                                                    <?php else: ?>
                                                        <td><?php echo esc_html($field['value']); ?> <?php echo esc_html($field['unit']); ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if($content = get_the_content()): ?>
        <section class="product-body" itemprop="text">
            <?php echo $content; ?>
        </section>
    <?php endif; ?>

    <footer class="product-footer">
        <?php get_template_part('partials/content-product-relations'); ?>
    </footer>
</article>

<?php do_action('affilicious_theme_product_below_post'); ?>
