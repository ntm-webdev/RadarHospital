<?php

/**
 * This is the model class for table "periodo".
 *
 * The followings are the available columns in table 'periodo':
 * @property integer $id
 * @property string $horario_inicial
 * @property string $horario_final
 * @property integer $id_dia_da_semana
 *
 * The followings are the available model relations:
 * @property DiaDaSemana $idDiaDaSemana
 */
class periodo extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'periodo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_dia_da_semana', 'numerical', 'integerOnly'=>true),
            array('horario_inicial, horario_final', 'length', 'max'=>15),
            array('id_hospital', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, horario_inicial, horario_final, id_dia_da_semana', 'safe', 'on'=>'search'),
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
            'idDiaDaSemana' => array(self::BELONGS_TO, 'dia_da_semana', 'id_dia_da_semana'),
            'idHospital' => array(self::BELONGS_TO, 'Hospital', 'id_hospital'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'horario_inicial' => 'Horario Inicial',
            'horario_final' => 'Horario Final',
            'id_dia_da_semana' => 'Id Dia Da Semana',
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
        $criteria->compare('horario_inicial',$this->horario_inicial,true);
        $criteria->compare('horario_final',$this->horario_final,true);
        $criteria->compare('id_dia_da_semana',$this->id_dia_da_semana);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Periodo the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function deletePeriodo($idHospital)
    {
        $this::model()->deleteAllByAttributes(['id_hospital'=>$idHospital]);
    }

    public function insertHorarioFuncionamento($idHospital, $hora_inicio_semana, $hora_fim_semana, $hora_inicio_finalsemana, $hora_fim_finalsemana)
    {
        $modelDomingo = new periodo();
        $modelDomingo->horario_inicial = $hora_inicio_finalsemana;
        $modelDomingo->horario_final = $hora_fim_finalsemana;
        $modelDomingo->id_dia_da_semana = 1;
        $modelDomingo->id_hospital = $idHospital;
        $modelDomingo->save();

        for ($i=2; $i <=6 ; $i++) {
            $modelSemana = new periodo();
            $modelSemana->horario_inicial = $hora_inicio_semana;
            $modelSemana->horario_final = $hora_fim_semana;
            $modelSemana->id_dia_da_semana = $i;
            $modelSemana->id_hospital = $idHospital;
            $modelSemana->save(); 
        }

        $modelSabado = new periodo();
        $modelSabado->horario_inicial = $hora_inicio_finalsemana;
        $modelSabado->horario_final = $hora_fim_finalsemana;
        $modelSabado->id_dia_da_semana = 7;
        $modelSabado->id_hospital = $idHospital;
        $modelSabado->save();
    }
}