<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto ajuste') }}
            {{ Form::text('montoajuste', $detallesajuste->montoajuste, ['class' => 'form-control' . ($errors->has('montoajuste') ? ' is-invalid' : ''), 'placeholder' => 'Montoajuste']) }}
            {!! $errors->first('montoajuste', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('ajustes') }}
            {{ Form::text('ajustes_id', session('ajustecompromiso'), ['class' => 'form-control' . ($errors->has('ajustes_id') ? ' is-invalid' : ''), 'placeholder' => 'Ajustes Id']) }}
            {!! $errors->first('ajustes_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadadministrativa') }}
            {{ Form::text('unidadadministrativa_id', $detallesajuste->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('ejecucion') }}
            {{ Form::text('ejecucion_id', $detallesajuste->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejecucion Id']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>