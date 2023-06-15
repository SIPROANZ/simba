<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $unidade->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('representante') }}
            {{ Form::text('representante', $unidade->representante, ['class' => 'form-control' . ($errors->has('representante') ? ' is-invalid' : ''), 'placeholder' => 'Representante']) }}
            {!! $errors->first('representante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('gabinete') }}
            {{ Form::select('gabinete_id', $gabinetes, $unidade->gabinete_id, ['class' => 'form-control' . ($errors->has('gabinete_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('gabinete_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>