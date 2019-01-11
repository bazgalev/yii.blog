<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find();

        $data = Article::getMainSectionData($query);

        $popularPosts = Article::getPopularPosts();
        $categories = Category::getAll();

        return $this->render('index', [
            'articles' => $data['models'],
            'pages' => $data['pages'],
            'popularPosts' => $popularPosts,
            'categories' => $categories,
        ]);
    }


    /**
     * Displays singe article.
     *
     * @param int $id id of app\models\Article model
     * @return string
     */
    public function actionView($id)
    {
        $article = Article::findOne($id);

        $popularPosts = Article::getPopularPosts();

        $categories = Category::getAll();

        $tags = $article->getAllTags();

        return $this->render('single-article', [
            'article' => $article,
            'popularPosts' => $popularPosts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Displays articles by category.
     *
     * @param $id id of app\models\Category model
     * @return string
     */
    public function actionCategory($id)
    {
        $query = Article::find()->where(['category_id' => $id]);

        $data = Article::getMainSectionData($query);

        $popularPosts=Article::getPopularPosts();

        $categories=Category::getAll();

        return $this->render('category', [
            'articles' => $data['models'],
            'pages' => $data['pages'],
            'popularPosts'=>$popularPosts,
            'categories'=>$categories,

        ]);
    }
}
