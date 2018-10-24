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
                            <?=CHtml::resetButton("Limpar filtros", ['class'=>'btn btn-default', 'id'=>'cleanFilter'])?>
                            <?php
                                if (Yii::app()->user->hasState("id")) {
                                    echo CHtml::ajaxSubmitButton('Refazer filtros',Yii::app()->createUrl('default/rebuildFilter'),
                                    array(
                                        'type'=>'POST',
                                        'dataType'=> 'json',                       
                                        'success'=>'js:function(data) {
                                            $("#form-result #hospital__regiao").prop("selectedIndex", data.indiceRegiao);
                                            $("#form-result #hospital__regiao").trigger("change");
                                            setTimeout(function(){
                                                $("#form-result #hospital__bairro option[value=\'"+data.bairro+"\']").prop("selected", "true")
                                            }, 100);
                                            $("#form-result #hospital__plano_saude").prop("selectedIndex", data.indicePlanoSaude);
                                            
                                        }'            
                                    ),array('class'=>'btn btn-primary'));
                                }
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
                            <?=CHtml::label("Para fazer a pesquisa de região, desative o filtro de localização","",['style'=>'display: none', 'id'=>"regiao", 'class'=>'text-warning'])?>
                        </div>
                        
                        <div class="form-group">
                            <?=CHtml::activeLabel($model, '_bairro', ['class'=>'text-beauty'])?>
                            <?=CHtml::activeDropDownList($model, '_bairro', (Yii::app()->user->hasState("nome")) ? CHtml::ListData(bairro::model()->findAllByAttributes(['id_regiao'=>$usuario->id_regiao]), 'nome', 'nome') : CHtml::ListData(bairro::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?><br>
                            <?=CHtml::label("Para fazer a pesquisa de bairro, desative o filtro de localização","",['style'=>'display: none', 'id'=>"bairro", 'class'=>'text-warning'])?>
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
                                <?=CHtml::activeRangeField($model, '_distancia', ['class'=>'form-control-range','max'=>'20', 'disabled'=>'true'])?>
                                <?=CHtml::label("Para fazer a pesquisa de distânica, ative o filtro de localização","",['id'=>"distancia", 'class'=>'text-warning'])?>
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

                <div class="col-xs-3">
                    <span class="text-beauty pull-right">
                        <?=(Yii::app()->user->hasState("id") ? "<i class='fa fa-fw fa-lg fa-user'></i>Olá, ".Yii::app()->user->getState("nome") : "") ?>
                    </span>
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
            $("#distancia").css("display","none");
            $("#form-result #hospital__bairro").prop("disabled", true);
            $("#hospital__distancia").attr("disabled", false);
        }

        var options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0
        };

        function success(pos) {
            var crd = pos.coords;

            $("#form-result #hospital_latitude").val(crd.latitude);  
            $("#form-result #hospital_longitude").val(crd.longitude);

            $("#form-result #hospital_latitude").val(crd.latitude);
            $("#form-result #hospital_longitude").val(crd.longitude);    
        };

        function error(err) {
            if (error.code == error.PERMISSION_DENIED) {
                alert("Não será possível realizar operações com a Geolocalização, para desfazer essa ação, favor acessar o navegador e desabilitar a desautorização");
            } else {
                console.warn(err.message);
            }
        };

        $("#form-result #radioLocation").on("change", function() {
            if(this.checked) {
                $("#form-result #hospital__regiao").prop("disabled", true);
                $("#form-result #hospital__regiao").val("");
                $("#form-result #hospital__bairro").prop("disabled", true);
                $("#form-result #hospital__bairro").val("");
                $("#regiao, #bairro").css("display","");
                $("#distancia").css("display","none");
                $("#hospital__distancia").attr("disabled", false);
                navigator.geolocation.getCurrentPosition(success, error, options);
            } else {
                $("#form-result #hospital__regiao").prop("disabled", false);
                $("#form-result #hospital__bairro").prop("disabled", false);

                $("#form-result #hospital_latitude").val("");    
                $("#form-result #hospital_longitude").val("");

                $("#form-result #hospital_latitude").val("");
                $("#form-result #hospital_longitude").val("");
                $("#regiao, #bairro, #distancia").css("display","none");
                $("#distancia").css("display","");
                $("#hospital__distancia").attr("disabled", true);

            }
        });

        $("#btnResultado").on("click", function() {
            $.post("'.Yii::app()->createUrl("default/Resultado").'");
        });

        $("#form-result #cleanFilter").on("click", function(){
            $("#form-result").find(":checkbox").prop("checked", false);
            $("#form-result #radioLocation").trigger("change");
            $("#form-result option:selected").attr("selected", false);
            $("#form-result")[0].reset();
            $("#form-result #hospital__regiao").val("").trigger("change");
        });

        $("#form-result #hospital__regiao").on("change", function() {
            var descricao = $(this).val();
            $.post("'.Yii::app()->createUrl("default/associaBairroRegiao").'", {regiao:descricao}, function(data) {
                $("#form-result #hospital__bairro").empty();
                var bairros = data.bairros;
                bairros = bairros.substring(0, (bairros.length-1));
                arrayBairros = bairros.split(",");

                var strOpcoesBairros = "";
                strOpcoesBairros += "<option value=\"\">Selecione ---</option>";

                for (var i=0;i<=arrayBairros.length;i++) {
                    if(arrayBairros[i] != undefined && arrayBairros != "") {
                        strOpcoesBairros += "<option value="+arrayBairros[i]+">"+arrayBairros[i]+"</option>";
                    }
                }
                $("#form-result #hospital__bairro").append(strOpcoesBairros);

            }, "json");
        });
    ');
?>  