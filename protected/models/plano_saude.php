<?php

/**
 * This is the model class for table "plano_saude".
 *
 * The followings are the available columns in table 'plano_saude':
 * @property integer $id
 * @property string $nome
 * @property integer $id_hospital
 *
 * The followings are the available model relations:
 * @property Hospital[] $hospitals
 */
class plano_saude extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'plano_saude';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome', 'required'),
            array('id_hospital', 'numerical', 'integerOnly'=>true),
            array('nome', 'length', 'max'=>60),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, id_hospital', 'safe', 'on'=>'search'),
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
            'fkhospital' => array(self::MANY_MANY, 'hospital', 'plano_hospital(codplano, codhospital)'),
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
            'id_hospital' => 'Id Hospital',
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
        $criteria->compare('id_hospital',$this->id_hospital);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PlanoSaude the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}