<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Ejecucion') }}
            {{ Form::text('ejecucion_id', $ejecuciondetalle->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una ejecucion']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('periodofiscal') }}
            {{ Form::text('periodofiscal', $ejecuciondetalle->periodofiscal, ['class' => 'form-control' . ($errors->has('periodofiscal') ? ' is-invalid' : ''), 'placeholder' => 'Periodofiscal']) }}
            {!! $errors->first('periodofiscal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::text('institucion_id', $ejecuciondetalle->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una institucion']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('sector') }}
            {{ Form::text('sector', $ejecuciondetalle->sector, ['class' => 'form-control' . ($errors->has('sector') ? ' is-invalid' : ''), 'placeholder' => 'Sector']) }}
            {!! $errors->first('sector', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('programa') }}
            {{ Form::text('programa', $ejecuciondetalle->programa, ['class' => 'form-control' . ($errors->has('programa') ? ' is-invalid' : ''), 'placeholder' => 'Programa']) }}
            {!! $errors->first('programa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('subprograma') }}
            {{ Form::text('subprograma', $ejecuciondetalle->subprograma, ['class' => 'form-control' . ($errors->has('subprograma') ? ' is-invalid' : ''), 'placeholder' => 'Subprograma']) }}
            {!! $errors->first('subprograma', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('proyecto') }}
            {{ Form::text('proyecto', $ejecuciondetalle->proyecto, ['class' => 'form-control' . ($errors->has('proyecto') ? ' is-invalid' : ''), 'placeholder' => 'Proyecto']) }}
            {!! $errors->first('proyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('actividad') }}
            {{ Form::text('actividad', $ejecuciondetalle->actividad, ['class' => 'form-control' . ($errors->has('actividad') ? ' is-invalid' : ''), 'placeholder' => 'Actividad']) }}
            {!! $errors->first('actividad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cuenta') }}
            {{ Form::text('cuenta', $ejecuciondetalle->cuenta, ['class' => 'form-control' . ($errors->has('cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Cuenta']) }}
            {!! $errors->first('cuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('financiamiento') }}
            {{ Form::select('financiamiento_id', $financiamientos, $ejecuciondetalle->financiamiento_id, ['class' => 'form-control' . ($errors->has('financiamiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Tipo de Financiamiento']) }}
            {!! $errors->first('financiamiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto_inicial') }}
            {{ Form::text('monto_inicial', $ejecuciondetalle->monto_inicial, ['class' => 'form-control' . ($errors->has('monto_inicial') ? ' is-invalid' : ''), 'placeholder' => 'Monto Inicial']) }}
            {!! $errors->first('monto_inicial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto_aumento') }}
            {{ Form::text('monto_aumento', $ejecuciondetalle->monto_aumento, ['class' => 'form-control' . ($errors->has('monto_aumento') ? ' is-invalid' : ''), 'placeholder' => 'Monto Aumento']) }}
            {!! $errors->first('monto_aumento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto_disminucion') }}
            {{ Form::text('monto_disminucion', $ejecuciondetalle->monto_disminucion, ['class' => 'form-control' . ($errors->has('monto_disminucion') ? ' is-invalid' : ''), 'placeholder' => 'Monto Disminucion']) }}
            {!! $errors->first('monto_disminucion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto_compromisos') }}
            {{ Form::text('monto_compromisos', $ejecuciondetalle->monto_compromisos, ['class' => 'form-control' . ($errors->has('monto_compromisos') ? ' is-invalid' : ''), 'placeholder' => 'Monto Compromisos']) }}
            {!! $errors->first('monto_compromisos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto_causados') }}
            {{ Form::text('monto_causados', $ejecuciondetalle->monto_causados, ['class' => 'form-control' . ($errors->has('monto_causados') ? ' is-invalid' : ''), 'placeholder' => 'Monto Causados']) }}
            {!! $errors->first('monto_causados', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto_pagados') }}
            {{ Form::text('monto_pagados', $ejecuciondetalle->monto_pagados, ['class' => 'form-control' . ($errors->has('monto_pagados') ? ' is-invalid' : ''), 'placeholder' => 'Monto Pagados']) }}
            {!! $errors->first('monto_pagados', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>
        
        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Usuario') }}
            {{ Form::text('logins', $ejecuciondetalle->logins, ['class' => 'form-control' . ($errors->has('logins') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('logins', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadejecutora') }}
            {{ Form::text('unidadejecutora', $ejecuciondetalle->unidadejecutora, ['class' => 'form-control' . ($errors->has('unidadejecutora') ? ' is-invalid' : ''), 'placeholder' => 'Unidadejecutora']) }}
            {!! $errors->first('unidadejecutora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>