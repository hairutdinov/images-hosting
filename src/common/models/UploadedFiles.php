<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uploaded_files".
 *
 * @property int $id
 * @property string $filename
 * @property string $uploaded_at
 */
class UploadedFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploaded_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename', 'uploaded_at'], 'required'],
            [['uploaded_at'], 'safe'],
            [['filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Название файла',
            'uploaded_at' => 'Дата и время загрузки',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UploadedFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadedFilesQuery(get_called_class());
    }
}
