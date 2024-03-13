<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UploadedFiles]].
 *
 * @see UploadedFiles
 */
class UploadedFilesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UploadedFiles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UploadedFiles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
