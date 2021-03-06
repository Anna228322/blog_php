<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string|null $image
 * @property int|null $viewed
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            [['date'], 'date', 'format'=>'php:Y.m.d'],
            [['date'], 'default', 'value'=>date('Y.m.d')],
            [['title'], 'string', 'max'=>255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    public function saveImage($filename){
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage(){
        return ($this->image) ? '/uploads/' . $this->image : '/no-image.png';
    }

    public function deleteImage(){
        $imageModel = new ImageUpload();
        $imageModel -> deleteCurrentFile($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function getDate(){
        return Yii::$app->formatter->asDate($this->date);
    }

    public static function getAll($pageSize = 5){
        $query = Article::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return ['articles'=>$articles, 'pagination'=>$pagination];
    }

    public static function getRecent(){
        return Article::find()->orderBy('date desc')->limit(4)->all();
    }

    public function saveArticle(){
        $this->user_id = Yii::$app->user->id;
        return $this->save(false);
    }

    public function getAuthor(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function viewedCount(){
        $this->viewed++;
        return $this->save(false);
    }
}
