<?php get_header(); ?> <main>
<div class="eyecatch single-eyecatch page-eyecatch">
<img src="<?php echo get_template_directory_uri(); ?>/img/news-eyecatch.jpg" alt="no-img">
<div class="page-title">
<h1 class="page-title__h1"><?php
single_tag_title(); ?></h1>
<p class="page-title__p">カテゴリー記事一覧</p>
       </div>
   </div>
<div class="flex">
<div class="container-top">
<div class="new-articles">
<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
         <?php endwhile; endif; ?>
         <div class="flex">
<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?> <a href="<?php the_permalink(); ?>"
class="magazine-colum">
<?php if( has_post_thumbnail() ): ?>
<?php the_post_thumbnail(); ?> <?php else: ?>
<img src="<?php echo
get_template_directory_uri(); ?>/img/no-images.png" alt="no-img">
<?php endif; ?>
<?php if (!is_category() &&
has_category()): ?>
<p class="category-tag">
<?php
$postcat = get_the_category();
echo $postcat[0]->name; ?>
               </p>
             <?php endif; ?>
             <div class="text-content">
             <p class="article__date"><?php echo
get_the_date('Y-m-d'); ?></p>
<h3 class="article__title">
<?php
if(mb_strlen($post->post_title,
'UTF-8')>30) {
$title= 
mb_substr($post->post_title, 0, 30, 'UTF-8');
echo $title.'...'; }else{
echo $post->post_title; }
?> 
</h3>
<div class="article-tags">
<p class="article-tags__inner"><?php
$posttags=get_the_tags();if($posttags){foreach($posttags as $tag){echo '<span class="tag">'.$tag->name.'</span>';}} ?></p>
'); ?>
      </div>
    </div>
</a>
<?php endwhile; ?>
<?php else: ?>
<!-- 投稿が無い場合の処理--> <p>投稿が見つかりません。</p>
<?php endif; ?>
       </div>
     </div>
<?php get_sidebar(); ?> </div>
</main>
<?php get_footer(); ?>