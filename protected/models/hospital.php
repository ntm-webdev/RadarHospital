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
 * @property integer $id_regiao
 * @property integer $id_bairro
 * @property string $telefone
 *
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

    protected $filtros;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, endereco, latitude, longitude', 'required'),
            array('id_regiao, id_bairro', 'numerical', 'integerOnly'=>true),
            array('latitude, longitude', 'numerical'),
            array('nome', 'length', 'max'=>60),
            array('endereco', 'length', 'max'=>80),
            array('telefone', 'length', 'max'=>15),
            array('filtros', 'safe'),
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
            'fkimagens' => array(self::MANY_MANY, 'imagens', 'imagem_hospital(codhospital, codimagem)'),
            'fkregiao' => array(self::BELONGS_TO, 'Regiao', 'id_regiao'),
            'fkbairro' => array(self::BELONGS_TO, 'Bairro', 'id_bairro'),
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
            'nome' => 'Hospital',
            'endereco' => 'Endereco',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'id_regiao' => 'Id Regiao',
            'id_bairro' => 'Id Bairro',
            'filtros[plano_saude]' => 'Plano de Saude',
            'filtros[regiao]' => 'Região',
            'filtros[bairro]' => 'Bairro',
            'filtros[especialidade]' => 'Especialidade',
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

        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.nome',$this->nome,true);
        $criteria->compare('t.endereco',$this->endereco,true);
        $criteria->compare('t.latitude',$this->latitude);
        $criteria->compare('t.longitude',$this->longitude);
        $criteria->compare('t.id_regiao',$this->id_regiao);
        $criteria->compare('t.id_bairro',$this->id_bairro);
        $criteria->compare('t.telefone',$this->telefone,true);
        $criteria->compare('fkplanosaude.nome', $this->filtros['plano_saude']??0);
        $criteria->compare('fkregiao.nome', $this->filtros['regiao']??0);
        //$criteria->compare('fkbairro.nome', $this->filtros['bairro']??0);
        //$criteria->compare('fkespecialidade.nome', $this->filtros['especialidade']??0);

        $criteria->together = true;
        //$criteria->with = ['fkplanosaude','fkregiao','fkbairro','fkespecialidade'];
        $criteria->with = ['fkplanosaude','fkregiao'];

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

    public function getHospitais()
    {
        $hospitais = hospital::model()->findAll();

        return $hospitais;
    }

    public function getFiltros()
    {
        return $this->filtros;
    }

    public function setFiltros($val)
    {
        $this->filtros = $val;
    }
}
