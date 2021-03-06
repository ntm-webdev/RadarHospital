<?php

/**
 * This is the model class for table "hospital".
 *
 * The followings are the available columns in table 'hospital':
 * @property integer $id
 * @property string $nome
 * @property string $endereco
 * @property double $latitude
 * @property double $longitude
 * @property integer $id_plano_saude
 * @property integer $id_regiao
 * @property integer $id_bairro
 * @property string $telefone
 *
 * The followings are the available model relations:
 * @property Regiao $idRegiao
 * @property Bairro $idBairro
 * @property PlanoSaude[] $planoSaudes
 */
class hospital extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'hospital';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, endereco, latitude, longitude', 'required'),
            array('id_plano_saude, id_regiao, id_bairro', 'numerical', 'integerOnly'=>true),
            array('latitude, longitude', 'numerical'),
            array('nome', 'length', 'max'=>60),
            array('endereco', 'length', 'max'=>80),
            array('telefone', 'length', 'max'=>15),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, endereco, latitude, longitude, id_plano_saude, id_regiao, id_bairro, telefone', 'safe', 'on'=>'search'),
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
            'fkespecialidade' => array(self::MANY_MANY, 'especialidades', 'especialidade_hospital(codhospital, codespecialidade)'),
            'fkregiao' => array(self::BELONGS_TO, 'regiao', 'id_regiao'),
            'fkbairro' => array(self::BELONGS_TO, 'bairro', 'id_bairro'),
            'fkplanosaude' => array(self::MANY_MANY, 'plano_saude', 'plano_hospital(codhospital, codplano)')
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
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'id_plano_saude' => 'Id Plano Saude',
            'id_regiao' => 'Id Regiao',
            'id_bairro' => 'Id Bairro',
            'telefone' => 'Telefone',
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
        $criteria->compare('latitude',$this->latitude);
        $criteria->compare('longitude',$this->longitude);
        $criteria->compare('id_plano_saude',$this->id_plano_saude);
        $criteria->compare('id_regiao',$this->id_regiao);
        $criteria->compare('id_bairro',$this->id_bairro);
        $criteria->compare('telefone',$this->telefone,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Hospital the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
