<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

        

        <div class="col-md-8">            
        <div class="form-group">
            {{ Form::label('Cuentas Bancaria') }}
            {{ Form::select('cuentasbancaria_id', $cuentasbancarias, $transferencia->cuentasbancaria_id, ['class' => 'form-control' . ($errors->has('cuentasbancaria_id') ? ' is-invalid' : ''), 'placeholder' => 'Cuentasbancaria Id']) }}
            {!! $errors->first('cuentasbancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
      <div class="col-md-4"> 
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::text('beneficiario_name', $pagados->beneficiario->nombre,['class' => 'form-control' . ($errors->has('beneficiario_name') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario']) }}
            {!! $errors->first('beneficiario_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Pagado ID') }}
            {{ Form::text('pagado_id', $pagados->id, ['class' => 'form-control' . ($errors->has('pagado_id') ? ' is-invalid' : ''), 'placeholder' => 'Pagado Id']) }}
            {!! $errors->first('pagado_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Monto transferencia') }}
            {{ Form::text('montotransferencia', $transferencia->montotransferencia, ['class' => 'form-control' . ($errors->has('montotransferencia') ? ' is-invalid' : ''), 'placeholder' => 'Montotransferencia']) }}
            {!! $errors->first('montotransferencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Concepto') }}
            {{ Form::text('concepto', $transferencia->concepto, ['class' => 'form-control' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => 'Concepto']) }}
            {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Monto orden') }}
            {{ Form::number('montoorden', $pagados->ordenpago->montoneto, ['class' => 'form-control' . ($errors->has('montoorden') ? ' is-invalid' : ''), 'placeholder' => 'Montoorden']) }}
            {!! $errors->first('montoorden', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Referencia') }}
            {{ Form::text('referenciabancaria', $transferencia->referenciabancaria, ['class' => 'form-control' . ($errors->has('referenciabancaria') ? ' is-invalid' : ''), 'placeholder' => 'Referenciabancaria']) }}
            {!! $errors->first('referenciabancaria', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="form-group">
             {{ Form::hidden('conceptoanulacion', 'sin conceptoanulacion', ['class' => 'form-control' . ($errors->has('conceptoanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Conceptoanulacion']) }}
            {!! $errors->first('conceptoanulacion', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('status', 'EP', ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'status']) }}
            {{ Form::hidden('egreso', 0, ['class' => 'form-control' . ($errors->has('egreso') ? ' is-invalid' : ''), 'placeholder' => 'egreso']) }}
         

        </div>

        <div class="form-group">
            {{ Form::hidden('beneficiario_id', $pagados->beneficiario->id, ['class' => 'form-control', 'readonly' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::hidden('fechaanulacion', $pagados->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de anulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::hidden('egreso', 0, ['class' => 'form-control' . ($errors->has('egreso') ? ' is-invalid' : ''), 'placeholder' => 'egreso']) }}
            {!! $errors->first('egreso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::hidden('status', 'EP', ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
        </div>
  </div>


    </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>