<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Banco') }}
            {{ Form::select('banco_id', $bancos, $cuentasbancaria->banco_id, ['class' => 'form-control' . ($errors->has('banco_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el banco']) }}
            {!! $errors->first('banco_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucion_id', $instituciones, $cuentasbancaria->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la institucion']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Apertura') }}
            {{ Form::date('fechaapertura', $cuentasbancaria->fechaapertura, ['class' => 'form-control' . ($errors->has('fechaapertura') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('fechaapertura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Monto apertura') }}
            {{ Form::text('montoapertura', $cuentasbancaria->montoapertura, ['class' => 'form-control' . ($errors->has('montoapertura') ? ' is-invalid' : ''), 'placeholder' => 'Montoapertura']) }}
            {!! $errors->first('montoapertura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Monto saldo') }}
            {{ Form::text('montosaldo', $cuentasbancaria->montosaldo, ['class' => 'form-control' . ($errors->has('montosaldo') ? ' is-invalid' : ''), 'placeholder' => 'Montosaldo']) }}
            {!! $errors->first('montosaldo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Cuenta') }}
            {{ Form::text('cuenta', $cuentasbancaria->cuenta, ['class' => 'form-control' . ($errors->has('cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Cuenta']) }}
            {!! $errors->first('cuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $cuentasbancaria->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        

        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>