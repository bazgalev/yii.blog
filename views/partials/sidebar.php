<?php

/* @var $this yii\web\View */
/* @var $article app\models\Article */

/** @var \app\models\Category[] $categories */

/** @var \app\models\Article[] $popularPosts */

use yii\helpers\Url;

?>

<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>

            <?php foreach ($popularPosts as $article): ?>
                <div class="popular-post">
                    <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]) ?>" class="popular-img">
                        <img src="<?= $article->getImage(); ?>" alt="">
                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="<?= Url::toRoute(['article/view', 'id' => $article->id]) ?>"
                           class="text-uppercase"><?= $article->title; ?></a>
                        <span class="p-date"><?= $article->getDate(); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="<?= Url::toRoute(['article/category', 'categoryId' => $category->id]) ?>"><?= $category->title; ?></a>
                        <span class="post-count pull-right">(<?= $category->getArticleCount(); ?>)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>
