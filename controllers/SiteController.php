<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\Article;

use yii\base\ErrorException;

use app\models\EntryForm;
use app\models\AppUser;
use app\models\CreateArticleForm;
use app\models\Like;

class SiteController extends Controller {
  /**
   * {@inheritdoc}
   */
  public function behaviors() {
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
  public function actions() {
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
  public function actionIndex() {
    if (Yii::$app->user->isGuest) {
      return $this->redirect(['site/login']);
    }

    /* Model for fetch articles */
    $model = Article::find()
                    ->select(['articles.id', 'articles.title', 'articles.content', 'uid' => 'users.id', 'users.username'])
                    ->leftJoin('users', 'users.id=articles.uid')
                    ->with('user')
                    ->orderBy('id DESC')
                    ->all();

    $like = new Like();

    return $this->render('index', ['model' => $model, 'like' => $like]);
  }

  /**
   * Login action.
   *
   * @return Response|string
   */
  public function actionLogin() {
    $this->layout = 'clean';

    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }

    $model->password = '';
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  /**
   * Register action.
   * 
   * 
   */
  public function actionRegister() {
    $this->layout = 'clean';
 
    $model = new RegisterForm();
    if ($model->load(Yii::$app->request->post())) {
      if ($user = $model->signup()) {
        if (Yii::$app->getUser()->login($user)) {
          return $this->goHome();
        }
      }
    }

    return $this->render('register', [
      'model' => $model,
    ]);
  }

  /**
   * Logout action.
   *
   * @return Response
   */
  public function actionLogout() {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  /**
   * Displays contact page.
   *
   * @return Response|string
   */
  public function actionContact() {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  /**
   * Displays about page.
   *
   * @return string
   */
  public function actionAbout() {
    return $this->render('about');
  }

  public function actionError() {
    $exception = Yii::$app->errorHandler->exception;

    if ($exception !== null) {
      return $this->render('error', ['exception' => $exception]);
    }
  }

  public function actionCreateArticle() {
    /* Model for new article */
    $model = new CreateArticleForm();
    if ($model->load(Yii::$app->request->post())) {
      $model->uid = Yii::$app->user->identity->id;
      
      if ($model->create()) {
        return $this->goHome();
      }
    }

    return $this->render('create-article', ['model' => $model]);
  }
}
