<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\base\ErrorException;

/* Models */
use app\models\AppUser;
use app\models\CreateArticleForm;
use app\models\Like;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Picture;

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
                    ->select([
                      'articles.id', 
                      'articles.title', 
                      'articles.content', 
                      'users.photo', 
                      'uid' => 'users.id', 
                      'users.username'])
                    ->leftJoin('users', 'users.id=articles.uid')
                    ->with('user')
                    ->orderBy('id DESC')
                    ->all();

    $like     = new Like();
    $pictures = new Picture();

    return $this->render('index', [
      'model'   => $model, 
      'like'    => $like, 
      'picture' => $pictures,
      'user'    => new AppUser 
      ]
    );
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
 
    $model = new AppUser();
    if ($model->load(Yii::$app->request->post())) {
      $transaction = Yii::$app->db->beginTransaction();
      
      try {
        $model->username     = Yii::$app->request->post('AppUser')['username'];
        $model->firstname    = Yii::$app->request->post('AppUser')['firstname'];
        $model->lastname     = Yii::$app->request->post('AppUser')['lastname'];
        $model->email        = Yii::$app->request->post('AppUser')['email'];  
        $model->description  = Yii::$app->request->post('AppUser')['description'];
        $model->setPassword(Yii::$app->request->post('AppUser')['password']);
        $model->generateAuthKey();
        $model->save();

        $transaction->commit();
      } catch (Exception $e) {
        $transaction->rollBack();
        throw $e;
      }

      return $this->redirect('site/login');
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
