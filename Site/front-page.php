<?php get_header(); ?>

    <div class="top-eyecatch"></div>

    <main>
      <div class="flex">
        <div class="container-top">
          <div class="new-articles">
            <h2 class="section-title">NEW ARTICLES</h2>
            <div class="flex">
                <?php if (have_posts()): ?>
                <?php while (have_posts()) : the_post(); ?>   
                <a href="<?php the_permalink(); ?>" class="magazine-colum">
                <?php if( has_post_thumbnail() ): ?>
                <?php the_post_thumbnail(); ?>
                <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/no-images.png" alt="no-img">
                <?php endif; ?>
                    <?php if (!is_category() && has_category()): ?>
                    <p class="category-tag">
                    <?php
                    $postcat = get_the_category();
                    echo $postcat[0]->name;
                    ?>
                    </p>
                <?php endif; ?>

                <div class="text-content">
                    <p class="article__date"><?php echo get_the_date('Y-m-d'); ?></p>
                    <h3 class="article__title">
                      <?php
                        if(mb_strlen($post->post_title, 'UTF-8')>30){
                        $title= mb_substr($post->post_title, 0, 30, 'UTF-8');
                        echo $title.'…';
                        }else{
                        echo $post->post_title;
                        }
                        ?>
                    </h3>
                    
                    <div class="article-tags">
                    <p class="article-tags__inner">
                        <?php $posttags=get_the_tags();if($posttags){foreach($posttags as $tag){echo '<span class="tag">'.$tag->name.'</span>';}} ?>
                    </p>
                    </div>
                </div>
                </a>
                <?php endwhile; ?>
                <?php else: ?>
                <p>投稿が見つかりません。</p>
                <?php endif; ?>
            </div>
          </div>


              <div class="category-sec">
          <h2 class="section-title">INTERVIEW</h2>
          <div class="flex">
          <?php
          $interview_query = new WP_Query(
            array(
              'post_type'      => 'post',
              'category_name' => 'interview',
              'posts_per_page' => 4,
            )
          );
          ?>
          <?php if ( $interview_query->have_posts() ) : ?>
            <?php while ( $interview_query->have_posts() ) : ?>
              <?php $interview_query->the_post(); ?>
               <a href="<?php the_permalink(); ?>" class="magazine-colum top-interview">
              <?php if( has_post_thumbnail() ): ?>
              <?php the_post_thumbnail(); ?>
              <?php else: ?>
              <img src="<?php echo get_template_directory_uri(); ?>/img/no-images.png" alt="no-img">
            <?php endif; ?>
                <?php if (!is_category() && has_category()): ?>
                <p class="category-tag">
                <?php
                  $postcat = get_the_category();
                  echo $postcat[0]->name;
                ?>
                </p>
              <?php endif; ?>

              <div class="text-content">
                <p class="article__date"><?php echo get_the_date('Y-m-d'); ?></p>
                <h3 class="article__title">
                  <?php
                    if(mb_strlen($post->post_title, 'UTF-8')>30){
                      $title= mb_substr($post->post_title, 0, 30, 'UTF-8');
                      echo $title.'…';
                    }else{
                      echo $post->post_title;
                    }
                    ?>
                </h3>
                <div class="article-tags">
                  <p class="article-tags__inner"><?php $posttags=get_the_tags();if($posttags){foreach($posttags as $tag){echo '<span class="tag-span">'.$tag->name.'</span>';}} ?>

</p>
                </div>
              </div>
            </a>
            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
          </div>
          <p class="news-articles_link">
            <?php
    // 指定したカテゴリーの ID を取得
    $category_id = get_cat_ID( 'interview' );

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
?>
                <a href="<?php echo esc_url( $category_link ); ?>" class="news-articles_link_text">インタビューの一覧はこちら→</a>
              </p>
        </div>
        <div id="news" class="wrap">
          <h2 class="section-title">BRAND NEWS</h2>
          <div class="news-contain">


          <ul>
              <?php
                  $posts = new WP_Query( 
                    array(
                          'post_type' => 'news',
                          'posts_per_page' => 4
                      )
                  );
                  if ( have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();
              ?>
                    <li class="news-list">
                      <p class="news-date"><?php echo get_the_date('Y-m-d'); ?></p>
                    <p class="news-category">
                      <?php 
                      $days = 3;
                      $today = date_i18n('U');
                    $entry_day = get_the_time('U');
                    $keika = date('U',($today - $entry_day)) / 86400;
                    if ( $days > $keika ):
                        $limit = 3;
                        $num = $wp_query->current_post;
                        if ( $limit > $num ):
                            echo 'New';
                        endif;  
                    endif;
                    ?>
                    
                    </p>

                      <a href="<?php the_permalink(); ?>" class="news-title">
                        <?php the_title(); ?>
                      </a>
                    </li>      
              <?php endwhile; endif; wp_reset_query(); ?>
              
              </ul>
              <p class="news-articles_link">
                <a href="<?php echo get_post_type_archive_link( 'news' ); ?>" class="news-articles_link_text">ニュース一覧はこちら→</a>
              </p>
              </div>
        </div>

          
        </div>
        <?php get_sidebar(); ?>
      </div>
    </main>
    <?php get_footer(); ?>

