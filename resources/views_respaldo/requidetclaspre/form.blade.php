<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('requisicion_id') }}
            {{ Form::text('requisicion_id', $requidetclaspre->requisicion_id, ['class' => 'form-control' . ($errors->has('requisicion_id') ? ' is-invalid' : ''), 'placeholder' => 'Requisicion Id']) }}
            {!! $errors->first('requisicion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('poa_id') }}
            {{ Form::text('poa_id', $requidetclaspre->poa_id, ['class' => 'form-control' . ($errors->has('poa_id') ? ' is-invalid' : ''), 'placeholder' => 'Poa Id']) }}
            {!! $errors->first('poa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('meta_id') }}
            {{ Form::text('meta_id', $requidetclaspre->meta_id, ['class' => 'form-control' . ($errors->has('meta_id') ? ' is-invalid' : ''), 'placeholder' => 'Meta Id']) }}
            {!! $errors->first('meta_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('financiamiento_id') }}
            {{ Form::text('financiamiento_id', $requidetclaspre->financiamiento_id, ['class' => 'form-control' . ($errors->has('financiamiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Financiamiento Id']) }}
            {!! $errors->first('financiamiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('disponible') }}
            {{ Form::text('disponible', $requidetclaspre->disponible, ['class' => 'form-control' . ($errors->has('disponible') ? ' is-invalid' : ''), 'placeholder' => 'Disponible']) }}
            {!! $errors->first('disponible', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('claspres') }}
            {{ Form::text('claspres', $requidetclaspre->claspres, ['class' => 'form-control' . ($errors->has('claspres') ? ' is-invalid' : ''), 'placeholder' => 'Claspres']) }}
            {!! $errors->first('claspres', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ejecucion_id') }}
            {{ Form::text('ejecucion_id', $requidetclaspre->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejecucion Id']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>