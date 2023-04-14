<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property int $id
 * @property int $status
 * @property string $title
 * @property string $description
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 55],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
