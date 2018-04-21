
<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id
 * @property string $nome
 * @property string $endereco
 * @property integer $id_bairro
 * @property integer $id_planosaude
 *
 * The followings are the available model relations:
 * @property Feedback[] $feedbacks
 * @property PlanoSaude $idPlanosaude
 * @property Bairro $idBairro
 */
class Usuario extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, nome, endereco, id_bairro, id_planosaude', 'required'),
            array('id, id_bairro, id_planosaude', 'numerical', 'integerOnly'=>true),
            array('nome', 'length', 'max'=>150),
            array('endereco', 'length', 'max'=>200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, endereco, id_bairro, id_planosaude', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fkfeedback' => array(self::MANY_MANY, 'Feedback', 'feedback_usuario(codusuario, codfeedback)'),
            'fkplanosaude' => array(self::BELONGS_TO, 'PlanoSaude', 'id_planosaude'),
            'fkbairro' => array(self::BELONGS_TO, 'Bairro', 'id_bairro'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'endereco' => 'Endereco',
            'id_bairro' => 'Id Bairro',
            'id_planosaude' => 'Id Planosaude',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('nome',$this->nome,true);
        $criteria->compare('endereco',$this->endereco,true);
        $criteria->compare('id_bairro',$this->id_bairro);
        $criteria->compare('id_planosaude',$this->id_planosaude);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Usuario the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}