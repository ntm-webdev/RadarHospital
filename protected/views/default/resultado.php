<body style="background-color: #f2f2f2">
    <div id="main">
        <div class="container">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div id="sidenav-content">
                    <?php $form=$this->beginWidget("CActiveForm", array(
                            'htmlOptions'=> [
                                'id' => 'form-result'
                            ],
                            'method' => 'POST'
                        )) ;?>
                        
                        <?=CHtml::activeHiddenField($model, 'latitude')?>
                        <?=CHtml::activeHiddenField($model, 'longitude')?>

                        <div class="form-group">
                            <?=CHtml::button("Limpar filtros", ['class'=>'btn btn-default', 'id'=>'cleanFilter'])?>
                            <?php
                                echo CHtml::ajaxSubmitButton('Refazer filtros',Yii::app()->createUrl('default/rebuildFilter'),
                                array(
                                    'type'=>'POST',
                                    'dataType'=> 'json',                       
                                    'success'=>'js:function(data){
                                        $("#hospital__regiao").val(data.regiao);
                                        $("#hospital__bairro").val(data.bairro);
                                        $("#hospital__plano_saude").val(data.planoSaude);
                                    }'           
                                ),array('class'=>'btn btn-primary',));
                            ?>
                        </div>

                        <div class="form-group">
                            <?php (!empty($model->latitude)) ? $attr = true : $attr = false ?>
                            <?=CHtml::checkBox('radioLocation', $attr, ['class'=>'form-check-input'])?>
                            <?=CHtml::label('Buscar hospitais através de minha posição atual?','lblPosition',['class'=>'text-beauty form-check-label'])?>
                        </div>

                        <div class="form-group">
                            <?=CHtml::activeLabel($model, '_regiao', ['class'=>'text-beauty'])?>
                            <?=CHtml::activeDropDownList($model, '_regiao', CHtml::ListData(regiao::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?><br>
                            <?=CHtml::label("Para fazer a pesquisa de região, desative o filtro de localização mais abaixo","",['style'=>'display: none', 'id'=>"regiao", 'class'=>'text-warning'])?>
                        </div>
                        
                        <div class="form-group">
                            <?=CHtml::activeLabel($model, '_bairro', ['class'=>'text-beauty'])?>
                            <?=CHtml::activeDropDownList($model, '_bairro', CHtml::ListData(bairro::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?><br>
                            <?=CHtml::label("Para fazer a pesquisa de bairro, desative o filtro de localização mais abaixo","",['style'=>'display: none', 'id'=>"bairro", 'class'=>'text-warning'])?>
                        </div>

                        <div class="form-group">
                            <?=CHtml::activeLabel($model, '_plano_saude', ['class'=>'text-beauty'])?>
                            <?=CHtml::activeDropDownList($model, '_plano_saude', CHtml::ListData(plano_saude::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
                        </div>

                        <div class="form-group">
                            <?=CHtml::activeLabel($model, '_especialidade', ['class'=>'text-beauty'])?>
                            <?=CHtml::activeDropDownList($model, '_especialidade', CHtml::ListData(especialidades::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
                        </div>


                        <div class="form-group">
                            <?=CHtml::activeLabel($model, '_distancia', ['class'=>'text-beauty'])?>
                            <div class="slidecontainer">
                                <?=CHtml::activeRangeField($model, '_distancia', ['class'=>'form-control-range'])?>
                                <p><span id="demo"></span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <?=CHtml::submitButton('Pesquisar', ['class'=>'btn btn-success', 'id'=>'btnResultado'])?>
                        </div>

                    <?php $this->endWidget() ?>
                </div>
            </div>

            <div class="row resultado">
                <p></p>

                <div class="col-xs-3">
                    <button type="button" class="btn btn-default btn-sm" onclick="openNav()">
                        <i class="fa fa-filter text-beauty"></i> Filtro
                    </button>
                </div>

                <div class="col-xs-3">
                    <?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/map', 'class'=> 'no-link'], '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-map text-beauty"></i> Mapa</button>')?>
                </div>

                <div class="col-xs-3">
                    <?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/userArea', 'class'=> 'no-link'], '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-user text-beauty"></i> Minha Conta</button>')?>
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

<?php

    Yii::app()->clientScript->registerScript('askGeolocation2', '
        
        if($("#form-result #radioLocation").is(":checked")) {
            $("#form-result #hospital__regiao").prop("disabled", true);
            $("#regiao, #bairro").css("display","");
            $("#form-result #hospital__bairro").prop("disabled", true);
            
        }

        var options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0
        };

        function success(pos) {
            var crd = pos.coords;

            $("#form-index #hospital_latitude").val(crd.latitude);  
            $("#form-index #hospital_longitude").val(crd.longitude);

            $("#form-result #hospital_latitude").val(crd.latitude);
            $("#form-result #hospital_longitude").val(crd.longitude);    
        };

        function error(err) {
          console.warn(err.message);
        };

        $("#form-result #radioLocation").on("change", function() {
            if(this.checked) {
                $("#form-result #hospital__regiao").prop("disabled", true);
                $("#form-result #hospital__bairro").prop("disabled", true);
                $("#regiao, #bairro").css("display","");
                navigator.geolocation.getCurrentPosition(success, error, options);
            } else {
                $("#form-result #hospital__regiao").prop("disabled", false);
                $("#form-result #hospital__bairro").prop("disabled", false);

                $("#form-index #hospital_latitude").val("");    
                $("#form-index #hospital_longitude").val("");

                $("#form-result #hospital_latitude").val("");
                $("#form-result #hospital_longitude").val("");
                $("#regiao, #bairro").css("display","none");
            }
            
        });

        $("#btnResultado").on("click", function() {
            val = $("#hospital__distancia").val();
            if(val > 0 && $("#form-result #hospital_latitude").val() == "") {
                alert("Para utilizar o filtro de distância, favor ativar a localização do dispositivo");
            } else {
                $.post("'.Yii::app()->createUrl("default/Resultado").'");
            }
        });

        $("#cleanFilter").on("click", function(){
            $("#form-result").find("select").val("");
        });
    ');
?>  