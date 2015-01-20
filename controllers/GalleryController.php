<?php

namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use app\models\PhotoForm;
use Yii;
use app\models\Photo;
use app\models\PhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryController implements the CRUD actions for Photo model.
 */
class GalleryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Photo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Photo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $authorized = (bool)Yii::$app->user->identity;
        $commentForm = new CommentForm();
        $commentForm->scenario = 'user';

        if(!$authorized) {
            $commentForm->scenario = 'guest';
        }

        if ($commentForm->load(Yii::$app->request->post()) && $commentForm->validate()) {
            $comment = new Comment();

            if($authorized) {
                $comment->user_id = Yii::$app->user->identity->getId();
            } else {
                $comment->username = $commentForm->username;
                $comment->email = $commentForm->email;
            }
            $comment->photo_id = $id;
            $comment->text = $commentForm->text;
            $comment->rating = $commentForm->rating;
            $comment->save();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'commentForm' => $commentForm,
        ]);
    }

    /**
     * Creates a new Photo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->identity) {
            return $this->redirect(['auth/default/login']);
        }

        $form = new PhotoForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $photo = new Photo();
            $photo->file_location   = $form->getPath();
            $photo->description     = $form->getDescription();
            $photo->user_id         = Yii::$app->user->identity->getId();
            $photo->save();
            return $this->redirect(['view', 'id' => $photo->id]);
        } else {
            return $this->render('create', [
                'model' => $form,
            ]);
        }
    }

    /**
     * Deletes an existing Photo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->identity) {
            return $this->redirect(['auth/default/login']);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionError($message)
    {
        return $this->render('error', ['name' => Yii::t('pg.main', 'Error'), 'message' => $message]);
    }

    /**
     * Finds the Photo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
