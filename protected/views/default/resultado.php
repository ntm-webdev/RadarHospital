<body style="background-color: #f2f2f2">
    <div id="main">
        <div class="container">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                
                <?php $form=$this->beginWidget("CActiveForm", array(
                        'action' => Yii::app()->createUrl("Default/resultado"),
                        'htmlOptions'=> [
                            'id' => 'form-result'
                        ],
                        'method' => 'POST'
                    )) ;?>
                    <div class="form-group">
                        <?=CHtml::activeLabel($model, '_bairro', ['class'=>'text-beauty'])?>
                        <?=CHtml::activeDropDownList($model, '_bairro', CHtml::ListData(bairro::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
                    </div>

                    <div class="form-group">
                        <?=CHtml::activeLabel($model, '_especialidade', ['class'=>'text-beauty'])?>
                        <?=CHtml::activeDropDownList($model, '_especialidade', CHtml::ListData(especialidades::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
                    </div>

                    <div class="form-group">
                        <?=CHtml::activeLabel($model, '_regiao', ['class'=>'text-beauty'])?>
                        <?=CHtml::activeDropDownList($model, '_regiao', CHtml::ListData(regiao::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
                    </div>

                    <div class="form-group">
                        <?=CHtml::activeLabel($model, '_plano_saude', ['class'=>'text-beauty'])?>
                        <?=CHtml::activeDropDownList($model, '_plano_saude', CHtml::ListData(plano_saude::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
                    </div>

                    <div class="form-group">
                        <label class="text-beauty" for="regiao">Distância</label>
                        <div class="slidecontainer">
                            <input type="range" min="1" max="100" value="1" class="slider" id="myRange">
                            <p><span id="demo"></span></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <?=CHtml::submitButton('Pesquisar', ['class'=>'btn btn-success'])?>
                    </div>

                <?php $this->endWidget() ?>
            </div>

            <div class="row resultado">
                <p></p>

                <div class="col-xs-4">
                    <i class="fa fa-filter pointer text-beauty" onclick="openNav()"></i>
                </div>

                <div class="col-xs-4">
                    <?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/map', 'class'=> 'no-link'], '<i class="fa fa-map pointer text-beauty"></i>')?>
                </div>

                <div class="col-xs-4">
                    <?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/userArea', 'class'=> 'no-link'], '<i class="fa fa-user pointer text-beauty"></i>')?>
                </div>

                <br>
            </div>
            
            <br>
    
            <?php

                $this->widget('zii.widgets.CListView', array(
                   'dataProvider'=>$dataProvider,
                   'itemView'=> 'list',
                )); 

            ?>

            <p></p>
            
        </div>
    </div>
</body>