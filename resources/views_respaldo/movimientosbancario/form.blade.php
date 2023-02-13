<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">

        <div class="col-md-4">   
        <div class="form-group">
            {{ Form::label('Ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $movimientosbancario->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio Id']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucion_id', $instituciones, $movimientosbancario->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucion Id']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('cuentas bancaria') }}
            {{ Form::select('cuentasbancaria_id', $cuentasbancarias, $movimientosbancario->cuentasbancaria_id, ['class' => 'form-control' . ($errors->has('cuentasbancaria_id') ? ' is-invalid' : ''), 'placeholder' => 'Cuentasbancaria Id']) }}
            {!! $errors->first('cuentasbancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::select('beneficiario_id', $beneficiarios, $movimientosbancario->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Tipo movimiento') }}
            {{ Form::select('tipomovimiento_id', $tipomovimientos, $movimientosbancario->tipomovimiento_id, ['class' => 'form-control' . ($errors->has('tipomovimiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipomovimiento Id']) }}
            {!! $errors->first('tipomovimiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Referencia') }}
            {{ Form::text('referencia', $movimientosbancario->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $movimientosbancario->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('fecha', $movimientosbancario->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
       
       <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Monto') }}
            {{ Form::text('monto', $movimientosbancario->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>