<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "esercizio".
 *
 * @property int $id
 * @property string $titolo
 * @property string|null $descrizione
 * @property resource|null $immagine
 * @property resource|null $audio
 * @property string|null $immagine_filepath
 * @property string|null $audio_filepath
 * @property int|null $id_logopedista
 */
class Esercizio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esercizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titolo','descrizione'], 'required'],
            [['immagine'], 'file', 'extensions' => 'jpg,jpeg, png', 'mimeTypes' => 'image/jpeg, image/png',],
            [['descrizione', 'immagine', 'audio'], 'string'],
            [['descrizione', 'immagine'], 'string'],
            [['id_logopedista'], 'integer'],
            [['titolo', 'immagine_filepath', 'audio_filepath'], 'string', 'max' => 255],
            [['titolo', 'immagine_filepath'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titolo' => 'Titolo',
            'descrizione' => 'Descrizione',
            'immagine' => 'Immagine',
            'audio' => 'Audio',
            'immagine_filepath' => 'Immagine Filepath',
            'audio_filepath' => 'Audio Filepath',
            'id_logopedista' => 'Id Logopedista',
        ];
    }
}
