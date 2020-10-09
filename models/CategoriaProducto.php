<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_producto".
 *
 * @property int $idCategoria_producto
 * @property int $idCategoria
 * @property int $idProducto
 */
class CategoriaProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCategoria', 'idProducto'], 'required'],
            [['idCategoria', 'idProducto'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCategoria_producto' => 'Id Categoria Producto',
            'idCategoria' => 'Id Categoria',
            'idProducto' => 'Id Producto',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'idCategoria']);
    }

}
