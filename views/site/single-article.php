<?php

use yii\helpers\Url;

/* @var $article app\models\Article */
/* @var $tags array of app\models\Tag models */
/* @var $categories array of app\models\Category models */
/* @var $this yii\web\View */
/* @var $comments array of app\models\Comment models */
/* @var $commentForm app\models\CommentForm */

$this->title = $article->title;
?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <article class="post">

                    <div class="post-thumb">
                        <a href="#">
                            <img src="<?= $article->getImage(); ?>" alt="">
                        </a>
                    </div>

                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6>
                                <a href="<?= Url::toRoute(['site/category', 'id' => $article->category_id]); ?>">
                                    <?= $article->category->title; ?>
                                </a>
                            </h6>

                            <h1 class="entry-title">
                                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]); ?>">
                                    <?= $article->title; ?>
                                </a>
                            </h1>
                        </header>

                        <div class="entry-content">
                            <?= $article->content; ?>
                        </div>

                        <div class="decoration">
                            <?php foreach ($tags as $tag): ?>
                                <a href="<?= Url::toRoute(['site/category', 'id' => $tag->id]); ?>"
                                   class="btn btn-default"><?= $tag->title; ?></a>
                            <?php endforeach; ?>
                        </div>

                        <div class="social-share">

                            <span class="social-share-title pull-left text-capitalize">
                                By <?= $article->user->name; ?> On <?= $article->getDate(); ?>
                            </span>

                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>

                <!--            start of comment section-->

                <?= $this->render('/partials/comment', [
                    'comments' => $comments,
                    'commentForm' => $commentForm,
                    'article' => $article,
                ]) ?>
                <!--            end of comment section-->

                <!--Start of sidebar-->
                <?= $this->render('/partials/sidebar', [
                    'popularPosts' => $popularPosts,
                    'categories' => $categories,
                ]) ?>
                <!--End of sidebar-->

            </div>
        </div>
    </div>
    <!-- end main content-->