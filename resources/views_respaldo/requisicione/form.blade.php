<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
        <div class="col-md-4">    
        <div class="form-group">
            {{ Form::label('Ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $requisicione->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el ejercicio']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucion_id', $instituciones, $requisicione->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la institucion']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Unidad administrativa') }}
            {{ Form::select('unidadadministrativa_id', $unidadadministrativas, $requisicione->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => ' Seleccione unidad administrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
       
            {{ Form::hidden('correlativo', $requisicione->correlativo, ['class' => 'form-control' . ($errors->has('correlativo') ? ' is-invalid' : ''), 'placeholder' => 'Correlativo']) }}
            {!! $errors->first('correlativo', '<div class="invalid-feedback">:message</div>') !!}
       
       
        </div>
        </div>
       
        <div class="col-md-4">  
        <div class="form-group">
            {{ Form::label('concepto') }}
            {{ Form::text('concepto', $requisicione->concepto, ['class' => 'form-control' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => 'Concepto']) }}
            {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">      
        <div class="form-group">
            {{ Form::label('uso') }}
            {{ Form::text('uso', $requisicione->uso, ['class' => 'form-control' . ($errors->has('uso') ? ' is-invalid' : ''), 'placeholder' => 'Uso']) }}
            {!! $errors->first('uso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>  
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Tipo requisicion') }}
            {{ Form::select('tiposgp_id', $tipossgps, $requisicione->tiposgp_id, ['class' => 'form-control' . ($errors->has('tiposgp_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione tipo requisicion']) }}
            {!! $errors->first('tiposgp_id', '<div class="invalid-feedback">:message</div>') !!}
            {{ Form::hidden('estatus', $requisicione->estatus, ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
       
       
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $requisicione->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
           
       
        </div>
        </div>
       
        
       
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>