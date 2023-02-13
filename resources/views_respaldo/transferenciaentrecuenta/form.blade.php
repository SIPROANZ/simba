<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
        <div class="col-md-3">
        
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $transferenciaentrecuenta->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $transferenciaentrecuenta->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('referencia') }}
            {{ Form::text('referencia', $transferenciaentrecuenta->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $transferenciaentrecuenta->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('banco origen') }}
            {{ Form::text('bancoorigen_id', $transferenciaentrecuenta->bancoorigen_id, ['class' => 'form-control' . ($errors->has('bancoorigen_id') ? ' is-invalid' : ''), 'placeholder' => 'Bancoorigen Id']) }}
            {!! $errors->first('bancoorigen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cuenta origen') }}
            {{ Form::text('cuentaorigen_id', $transferenciaentrecuenta->cuentaorigen_id, ['class' => 'form-control' . ($errors->has('cuentaorigen_id') ? ' is-invalid' : ''), 'placeholder' => 'Cuentaorigen Id']) }}
            {!! $errors->first('cuentaorigen_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('banco destino') }}
            {{ Form::text('bancodestino_id', $transferenciaentrecuenta->bancodestino_id, ['class' => 'form-control' . ($errors->has('bancodestino_id') ? ' is-invalid' : ''), 'placeholder' => 'Bancodestino Id']) }}
            {!! $errors->first('bancodestino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cuenta destino') }}
            {{ Form::text('cuentadestino_id', $transferenciaentrecuenta->cuentadestino_id, ['class' => 'form-control' . ($errors->has('cuentadestino_id') ? ' is-invalid' : ''), 'placeholder' => 'Cuentadestino Id']) }}
            {!! $errors->first('cuentadestino_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>